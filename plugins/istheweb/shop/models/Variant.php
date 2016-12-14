<?php namespace Istheweb\Shop\Models;

use Request;


/**
 * Variant Model
 */
class Variant extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_variants';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'code',
        'name',
        'availableOn',
        'pricing_calculator',
        'price',
        'on_hand',
        'tracked',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'product'       => 'Istheweb\Shop\Models\Product'
    ];
    public $belongsToMany = [
        'optionsValues' => ['Istheweb\Shop\Models\OptionValue',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getPricingCalculatorOptions(){
        return [
            'standard'                          => 'Standard',
            'channel_and_currency_based'        => 'Channel and Currency based'
        ];
    }

    public function getProductsOptions(){
        $products = Product::all()->lists('name', 'id');
        return $products;
    }

    public function beforeSave()
    {
        $manage_id = post('manage_id');
        if(!isset($manage_id)){
            $path = explode('/', Request::path());
            $id = last($path);
            $product = Product::find($id);
            $this->product = $product;
            $name = $product->name;
            $variant = post('Variant');
            $options = $variant['optionsValues'];
            foreach ($options as $k => $v){
                $ov = OptionValue::find($v);
                $name .= ' - ' . $ov->value;
                $this->optionsValues()->add($ov);
            }
            $this->name = $name;
        }
    }
}