<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/02/17
 * Time: 12:59
 */

namespace istheweb\shop\behaviors;


use Istheweb\Shop\Models\Order;
use Istheweb\Shop\Models\ShopSettings;
use System\Classes\ModelBehavior;

class OrderModel extends ModelBehavior
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function formatReference(){
        $shopSettings = ShopSettings::instance();
        $count = Order::all()->count();

        if($count == 0){
            $reference = $shopSettings->order_reference;
        }else{
            $last = Order::lastReference()->first();
            $reference = $last + 1;
        }
        return $reference;
    }

    public function getBaseTotals($recordId)
    {
        $order = Order::with('order_items')->find($recordId)->first();

        if($order->order_items){
            $base = 0;
            foreach($order->order_items as $item){
                $base += $item->total;
            }
        }
        $this->subtotal = $base;
        return $base;
    }
}