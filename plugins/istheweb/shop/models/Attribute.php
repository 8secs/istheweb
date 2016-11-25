<?php namespace Istheweb\Shop\Models;


/**
 * Attribute Model
 */
class Attribute extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_attributes';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'attribute_items'     => 'Istheweb\Shop\Models\AttributeItem'
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'products' => ['Istheweb\Shop\Models\Product',
            'table' => 'istheweb_shop_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}