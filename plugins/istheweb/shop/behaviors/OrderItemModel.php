<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/02/17
 * Time: 10:01
 */

namespace istheweb\shop\behaviors;


use istheweb\shop\classes\AvailabilityChecker;
use Istheweb\Shop\Models\InventoryUnit;
use System\Classes\ModelBehavior;

class OrderItemModel extends ModelBehavior
{
    public function __construct( $model )
    {
        parent::__construct($model);
    }

    public function calculateTotal()
    {

    }

    public function getTotalItem()
    {
        $className = $this->model->productable_type;
        $instance = new $className;
        $id = post('OrderItem[productable]');
        $quantity = post('OrderItem[quantity]');
        $item = $instance->find($id)->first();

        //dd($tax_rate);

        $availabilityChecker = new AvailabilityChecker(false);

        if($item->isTracked()){
            if($availabilityChecker->isStockSufficient($item, $quantity)){
                $inventoryUnit = new InventoryUnit();
                $inventoryUnit->hold($item, $quantity);
            }
        }

        $this->model->unit_price = $item->price;
        $this->model->unit_total = $item->price * $quantity;
        $this->model->total = $this->model->unit_total;
        $tax_rate = $item->getTaxRate();
        $rate = $tax_rate->calculate($this->model->total);
        dd($this->model->total . " rate " . $rate);
    }
}