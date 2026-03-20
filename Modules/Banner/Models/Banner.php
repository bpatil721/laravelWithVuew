<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Banner\Database\Factories\BannerFactory;

class Banner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title','image','description','product_id','status'];

    // protected static function newFactory(): BannerFactory
    // {
    //     // return BannerFactory::new();
    // }
}
