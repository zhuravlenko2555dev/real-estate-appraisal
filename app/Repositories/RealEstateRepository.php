<?php


namespace App\Repositories;


use App\Models\Photo;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Storage;

class RealEstateRepository extends BaseRepository
{
    public function index(Request $request) {
        $request->validate([
            'action_type' => 'integer',
        ]);

        $query = RealEstate::with('photos', 'worker');
        $query->orderBy('id', 'desc');

        if ($request->get('action_type')) {
            $query->where('action_type', $request->get('action_type'));
        }

        return $this->response($query->get(), self::SUCCESS_STATUS_CODE);
    }

    public function store(Request $request) {
        $request->validate([
            'action_type' => 'required|integer',
            'area_type' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'area' => 'required|integer',

            'photos' => 'required'
        ]);

        $realEstate = new RealEstate;
        $realEstate->fill(array_merge($request->except('photos'), ['worker_id' => $request->user()->id]));
        $realEstate->save();

        $photos_db_items = [];

        $photos = $request->file('photos');
        foreach ($photos as $k => $photo) {
            $name = 'photo_' . $realEstate->id . '_' . ($k + 1) . '.' . $photo->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'photos',
                $photo,
                $name
            );


            $photo = new Photo;
            $photo->fill(['real_estate_id' => $realEstate->id, 'path' => $name]);
            array_push($photos_db_items, $photo);
        }

        $realEstate->photos()->saveMany($photos_db_items);
        $realEstate->load('photos');

        return $this->response($realEstate, self::CREATED_STATUS_CODE);
    }

    public function show(RealEstate $realEstate) {
        $realEstate->load('photos', 'worker');

        return $this->response($realEstate, self::CREATED_STATUS_CODE);
    }

    public function appraise(Request $request, RealEstate $realEstate) {
        $request->validate([
            'price_per_square_meter' => 'required|numeric',
        ]);

        $realEstate->appraised = true;
        $realEstate->price_per_square_meter = $request->price_per_square_meter;
        $realEstate->save();
        $realEstate->load('photos');

        return $this->response($realEstate, self::CREATED_STATUS_CODE);
    }
}
