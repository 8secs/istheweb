<?php namespace Istheweb\Shop\Models;

use istheweb\shop\classes\StockableInterface;
use Model;


/**
 * InventoryUnit Model
 */
class InventoryUnit extends Model
{

    /**
     * Default states.
     */
    const STATE_CHECKOUT = 'checkout';
    const STATE_ONHOLD = 'onhold';
    const STATE_SOLD = 'sold';
    const STATE_BACKORDERED = 'backordered';
    const STATE_RETURNED = 'returned';

    /**
     * @var array Implements bevaviors
     */
    public $implement = [
        'Istheweb.Shop.Behaviors.InventoryModel'
    ];

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var StockableInterface
     */
    protected $stockable;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getStockable()
    {
        return $this->stockable;
    }

    /**
     * @param StockableInterface $stockable
     */
    public function setStockable(StockableInterface $stockable)
    {
        $this->stockable = $stockable;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryName()
    {
        return $this->stockable->getInventoryName();
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryState()
    {
        return $this->inventoryState;
    }

    /**
     * {@inheritdoc}
     */
    public function setInventoryState($state)
    {
        $this->inventoryState = $state;
    }

    /**
     * {@inheritdoc}
     */
    public function isSold()
    {
        return InventoryUnit::STATE_SOLD === $this->inventoryState;
    }
}