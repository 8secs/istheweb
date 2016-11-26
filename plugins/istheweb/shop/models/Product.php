<?php namespace Istheweb\Shop\Models;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Archetype\Model\ArchetypeInterface;
use Sylius\Component\Archetype\Model\ArchetypeSubjectInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Product\Model\DateRange;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Variation\Model\OptionInterface;
use Sylius\Component\Variation\Model\VariantInterface;

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

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'attributes'        => 'Istheweb/Shop/Models/AttributeValue',
        'variants'          => 'Istheweb/Shop/Models/Variant'
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
        $this->availableOn = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return (new DateRange($this->availableOn, $this->availableUntil))->isInRange();
    }



}