<?php namespace Istheweb\Shop\Models;

use Carbon\Carbon;


/**
 * AttributeItem Model
 */
class AttributeItem extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_attribute_items';



    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'attribute'     => 'Istheweb\Shop\Models\Attribute'
    ];
    public $belongsToMany = [
        'product_variants' => ['Istheweb\Shop\Models\ProductVariant',
            'table' => 'istheweb_shop_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function beforeSave()
    {
        $postFilter = post('Filter');
        if(strlen($postFilter['published_at']) == 0) $this->published_at = Carbon::now();
    }

    public function afterDelete()
    {
        if($this->products()) $this->products()->detach();
    }

    public function getProductsOptions()
    {
        return Product::all()->lists('name', 'id');
    }

}