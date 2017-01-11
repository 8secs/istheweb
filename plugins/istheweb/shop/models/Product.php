<?php namespace Istheweb\Shop\Models;
use Sylius\Component\Inventory\Model\StockableInterface;


/**
 * Product Model
 */
class Product extends Base implements StockableInterface
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
        ],
        'categories' => ['Istheweb\Shop\Models\Category',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
    ];


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

    /**
     * @inheritDoc
     */
    public function getInventoryName()
    {
        // TODO: Implement getInventoryName() method.
    }

    /**
     * @inheritDoc
     */
    public function isInStock()
    {
        // TODO: Implement isInStock() method.
    }

    /**
     * @inheritDoc
     */
    public function isAvailableOnDemand()
    {
        // TODO: Implement isAvailableOnDemand() method.
    }

    /**
     * @inheritDoc
     */
    public function getOnHold()
    {
        // TODO: Implement getOnHold() method.
    }

    /**
     * @inheritDoc
     */
    public function setOnHold($onHold)
    {
        // TODO: Implement setOnHold() method.
    }

    /**
     * @inheritDoc
     */
    public function getOnHand()
    {
        // TODO: Implement getOnHand() method.
    }

    /**
     * @inheritDoc
     */
    public function setOnHand($onHand)
    {
        // TODO: Implement setOnHand() method.
    }

    public function setTracked($tracked)
    {
        // TODO: Implement setTracked() method.
    }

    public function isTracked()
    {
        // TODO: Implement isTracked() method.
    }


}