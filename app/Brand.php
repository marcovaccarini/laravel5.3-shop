<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'Brands';

    protected $fillable = array('brand_name');
}
