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
            $reference = $last->reference + 1;
        }
        return $reference;
    }

    public function calculateTotal()
    {

    }


    public function updateTotals()
    {
        //$order = Order::with('order_items')->find($recordId)->first();
        $base = 0;
        if($this->model->order_items){
            foreach($this->model->order_items as $item){
                $base += $item->total;
            }
        }
        $this->model->subtotal = $base;


        dd($this->model);
        //$this->model->save();

    }
}