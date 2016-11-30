<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = array(
        'user_id',
        'product_id',
        'quantity',
        'total',
        );

    /**
     * A product belong to a cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Products()
    {
        return $this->BelongsTo('App\Product', 'product_id');
    }

    /**
     * A cart belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User', 'user_id');

    }


}
