<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    const ACTION_TYPE_RENT = 1;
    const ACTION_TYPE_SALE = 2;

    const AREA_TYPE_HOUSE = 1;
    const AREA_TYPE_APARTMENT = 2;
    const AREA_TYPE_LAND = 3;
    const AREA_TYPE_ROOM = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'worker_id',
        'action_type',
        'area_type',
        'title',
        'description',
        'area',
        'appraised',
        'price_per_square_meter'
    ];
}
