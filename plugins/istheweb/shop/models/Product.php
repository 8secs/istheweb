<?php namespace Istheweb\Shop\Models;

use Sylius\Component\Product\Model\DateRange;
use Sylius\Component\Resource\Model\ToggleableTrait;


/**
 * Product Model
 */
class Product extends Model
{
    use ToggleableTrait;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_products';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['att_values'];

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

    public function __construct()
    {
        $this->available_on = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return (new DateRange($this->available_on, $this->available_until))->isInRange();
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