<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category', 'parent_id'];

    /**
     * One sub-category belongs to a main or parent category
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    /**
     * A parent category has many sub categories
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    /**
     * A category can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany('App\Product', 'id');
    }
}
