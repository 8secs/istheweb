<?php namespace Istheweb\Shop\Models;


/**
 * AttributeValue Model
 */
class AttributeValue extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_attribute_values';

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
        'product'       => 'Istheweb\Shop\Models\Product',
        'attribute'     => 'Istheweb\Shop\Models\Attribute',
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}