<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/02/17
 * Time: 10:01
 */

namespace istheweb\shop\behaviors;


use Sylius\Component\Inventory\Checker\AvailabilityChecker;
use Sylius\Component\Inventory\Operator\BackordersHandler;
use Sylius\Component\Inventory\Operator\InventoryOperator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use System\Classes\ModelBehavior;

class OrderItemModel extends ModelBehavior
{
    public function __construct( $model )
    {
        parent::__construct($model);
    }

    public function getTotalItem()
    {
        $className = $this->model->productable_type;
        $instance = new $className;
        $id = post('OrderItem[productable]');
        $quantity = post('OrderItem[quantity]');
        //$item = $instance->getItemForOrder($id);
        $item = $instance->find($id)->first();
        $tax_rate = $item->getTaxRate();

        $availabilityChecker = new AvailabilityChecker(false);
        $eventDispatcher = new EventDispatcher();


        if($item->isTracked()){
            if($availabilityChecker->isStockSufficient($item, $quantity)){
                //$inventoryOperator->hold($item, $quantity);
                dd($item->getOnHold());
            }
        }

        dd('no pasa');


        $this->model->unit_price = $item->price;
        $this->model->unit_total = $item->price * $quantity;
        $this->model->total = $this->model->unit_total;
    }
}