<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 8/02/17
 * Time: 13:55
 */

namespace istheweb\shop\behaviors;


use Sylius\Component\Inventory\Model\StockableInterface;
use Sylius\Component\Inventory\SyliusStockableEvents;
use System\Classes\ModelBehavior;
use Webmozart\Assert\Assert;
use Event;

class InventoryModel extends ModelBehavior
{

    public function __construct($model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function hold(StockableInterface $stockable, $quantity)
    {
        Assert::greaterThan($quantity, 0, 'Quantity of units must be greater than 0.');

        $this->dispatchEvent(SyliusStockableEvents::PRE_HOLD, $stockable);

        $stockable->setOnHold($stockable->getOnHold() + $quantity);

        $this->dispatchEvent(SyliusStockableEvents::POST_HOLD, $stockable);
    }

    /**
     * {@inheritdoc}
     */
    public function release(StockableInterface $stockable, $quantity)
    {
        Assert::greaterThan($quantity, 0, 'Quantity of units must be greater than 0.');

        $this->dispatchEvent(SyliusStockableEvents::PRE_RELEASE, $stockable);

        $stockable->setOnHold($stockable->getOnHold() - $quantity);

        $this->dispatchEvent(SyliusStockableEvents::POST_RELEASE, $stockable);
    }

    /**
     * @param string $event
     * @param StockableInterface $stockable
     */
    private function dispatchEvent($event, StockableInterface $stockable)
    {
        $this->eventDispatcher->dispatch($event, new GenericEvent($stockable));
    }
}