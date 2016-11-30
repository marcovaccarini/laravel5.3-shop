<?php
namespace App;
use App\Brand;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = array(
        'product_name',
        'price',
        'description',
        'category_id',
        'brand_id',
        );

    /**
     * A Product Belongs To a Brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function brand()
    {
        return$this->belongsTo('Brand');
    }

    /**
     * One Product can have one Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Category', 'id');
    }
}
