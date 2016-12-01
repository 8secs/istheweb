<?php namespace Istheweb\Shop\Models;


/**
 * Variant Model
 */
class Variant extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_variants';

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
}