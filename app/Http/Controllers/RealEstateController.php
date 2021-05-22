<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use App\Repositories\RealEstateRepository;
use Illuminate\Http\Request;

class RealEstateController extends Controller
{
    private $realEstateRepository;

    public function __construct(RealEstateRepository $realEstateRepository)
    {
        $this->realEstateRepository = $realEstateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->realEstateRepository->index($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->realEstateRepository->store($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function show(RealEstate $realEstate)
    {
        $response = $this->realEstateRepository->show($realEstate);
        return response()->json($response["data"], $response["statusCode"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function edit(RealEstate $realEstate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RealEstate $realEstate)
    {
//        $response = $this->realEstateRepository->update($request, $realEstate);
//        return response()->json($response["data"], $response["statusCode"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function destroy(RealEstate $realEstate)
    {
//        $response = $this->realEstateRepository->destroy($realEstate);
//        return response()->json($response["data"], $response["statusCode"]);
    }

    /**
     * Appraise the real estate.
     *
     * @param  \App\Models\RealEstate  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function appraise(Request $request, RealEstate $realEstate)
    {
        $response = $this->realEstateRepository->appraise($request, $realEstate);
        return response()->json($response["data"], $response["statusCode"]);
    }
}
