<?php namespace Istheweb\Shop\Models;

use Illuminate\Support\Facades\Lang;
use Sylius\Component\Inventory\Model\StockableInterface;

/**
 * Product Model
 */
class Product extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_products';

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name'];

    //protected $jsonable = ['att_values'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'attributeValues'           => 'Istheweb\Shop\Models\AttributeValue',
        'variants'                  => 'Istheweb\Shop\Models\Variant'
    ];
    public $belongsTo = [
        'tax_category'          => 'Istheweb\Shop\Models\TaxCategory',
        'shipping_category'     => 'Istheweb\Shop\Models\ShippingCategory',
    ];
    public $belongsToMany = [
        'options' => ['Istheweb\Shop\Models\Option',
            'table' => 'istheweb_shop_pivots',
        ],
        'categories' => ['Istheweb\Shop\Models\Category',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [
        'order_items'      => ['Istheweb\Shop\Models\OrderItem', 'name' => 'productable']
    ];
    public $attachOne = [];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
    ];

    public function getProductTypeOptions(){
        return [
            1 => Lang::get('istheweb.shop::lang.product.simple'),
            2 => Lang::get('istheweb.shop::lang.product.compound'),
            3 => Lang::get('istheweb.shop::lang.product.virtual'),
        ];
    }

    public function filterFields($fields, $context = null){
        if($fields->product_type->value == 2){
            $fields->options_section->hidden = false;
            $fields->options->hidden = false;
            $fields->variants_section->hidden = false;
            if($context == 'update') {
                $fields->variants->hidden = false;
            }
        }else{
            $fields->options_section->hidden = true;
            $fields->options->hidden = true;
            $fields->variants_section->hidden = true;
            if($context == 'update'){
                $fields->variants->hidden = true;
            }
        }
    }

    public static function getAttributeIdOptions()
    {
        $attributes = Attribute::getAllAtributes();
        return $attributes;
    }

    public function isStockable()
    {
        return $this->tracked;
    }

    public function getTaxRate()
    {
        $tax_rate = TaxRate::rate($this->tax_category_id)->first();
        return $tax_rate;
    }


}