<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed category
 * @property mixed market
 */
class Product extends Model
{
    use Notifiable;
    protected $fillable = ['market', 'category', 'name', 'date', 'price', 'discount', 'unit', 'new_price', 'image'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public function getCategoryName()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return Category::findOrFail($this->category)->name;
    }

    public function getMarketName()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return Market::findOrFail($this->market)->name;
    }
}
