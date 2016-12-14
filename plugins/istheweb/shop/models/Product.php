<?php namespace Istheweb\Shop\Models;



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
    public $belongsTo = [];
    public $belongsToMany = [
        'options' => ['Istheweb\Shop\Models\Option',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        //return (new DateRange($this->available_on, $this->available_until))->isInRange();
    }

    public static function getAttributeIdOptions()
    {
        $attributes = Attribute::getAllAtributes();
        //dd($attributes);
        return $attributes;
    }

    public function beforeSave()
    {
        //dd(post());
    }

}