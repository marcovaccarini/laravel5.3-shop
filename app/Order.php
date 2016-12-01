<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';


    /**
     * Only if the delivery address is different from the user address
     *
     * @var array
     */
    protected $fillable = array(
        'user_id',
        'delivery_first_name',
        'delivery_last_name',
        'delivery_address',
        'delivery_address_2',
        'delivery_city',
        'delivery_state',
        'delivery_zip',
        'total',
    );

    /**
     * An order can have many products
     *
     * @return $this
     */
    public function orderItems()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity', 'price', 'total');

    }
}
