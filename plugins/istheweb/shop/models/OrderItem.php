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
        'unit_price' => 'required|numeric',
        'unit_total' => 'required|numeric',
        'total' => 'required|numeric',
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
        'variant'   => 'Istheweb\Shop\Models\Variant',
    ];
}