<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed address
 * @property mixed phone
 * @property mixed latitude
 * @property mixed longitude
 */
class Market extends Model
{
    protected $fillable = ['login', 'password', 'name', 'address', 'phone', 'latitude', 'longitude', 'image'];
}
