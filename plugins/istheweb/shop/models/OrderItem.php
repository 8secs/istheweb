<?php namespace Istheweb\Shop\Models;


use Model;
use October\Rain\Database\Traits\Validation;

/**
 * OrderItem Model
 */
class OrderItem extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_order_items';

    /**
     * @var array Validation rules
     */
    protected $rules = [
        'quantity' => 'required',
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'quantity',
        'unit_price',
        'unit_total',
        'total',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'order'     => 'Istheweb\Shop\Models\Order',
        //'variant'   => 'Istheweb\Shop\Models\Variant',
    ];

    public $morphTo = [
         'productable' => []
    ];

    public function beforeSave()
    {
        $post_variant = post('OrderItem[variant]');
        $quantity = post('OrderItem[quantity]');
        $variant = Variant::find($post_variant)->first();
        $this->unit_price = $variant->price;
        $this->unit_total = $variant->price * $quantity;
        $this->total = $this->unit_total;
    }
}