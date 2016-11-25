<?php namespace Istheweb\Shop\Models;
use Backend\FormWidgets\Repeater;

/**
 * ProductVariant Model
 */
class ProductVariant extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_product_variants';


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
        'product'       => 'Istheweb\Shop\Models\Product'
    ];
    public $belongsToMany = [
        'attribute_items' => ['Istheweb\Shop\Models\AttributeItem',
            'table' => 'istheweb_shop_pivots',
        ],
        'attribute' => ['Istheweb\Shop\Models\Attribute',
            'table' => 'istheweb_shop_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
    ];

    public function getAttributeIdOptions(){

        return Attribute::all()->lists('name', 'id');
    }

    public function getItemsOptions()
    {
        //print_r($this->attributes);
        if(isset($this->attributes['attribute_id'])){
            $items = AttributeItem::where('attribute_id',$this->attributes['attribute_id'])->lists('name', 'id');
        }else{
            $items = AttributeItem::where('attribute_id', 1)->lists('name', 'id');
        }

        return $items;
        //return AttributeItem::where('attribute_id',$this->attributes)->get();
    }

    public function filterFields($fields, $context = null)
    {
        //dd($fields);

    }

}