<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Order Model
 */
class Order extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_orders';

    /**
     * @var array Implements bevaviors
     */
    public $implement = [
        'Istheweb.Shop.Behaviors.OrderModel'
    ];

    /**
     * @var array Guarded fields
     */
    protected $rules = [
        'reference' => 'unique:istheweb_shop_orders'
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'reference',
    ];

    /**
     * @var array Relations
     */

    public $belongsTo = [
        'order_status'      => 'Istheweb\Shop\Models\OrderStatus',
        'customer'          => ['Istheweb\Shop\Models\Customer'],
        'shipping_address'  => ['Istheweb\Shop\Models\Address'],
        'billing_address'   => ['Istheweb\Shop\Models\Address'],
    ];

    public $hasMany = [
        'order_items'           => [ 'Istheweb\Shop\Models\OrderItem'],
        'adjustments'           => ['Istheweb\Shop\Models\Adjustment']
    ];

    public $morphMany = [
        'adjustments'      => ['Istheweb\Shop\Models\Adjustment', 'name' => 'orderable']
    ];

    public function getPaymentMethodOptions(){
        $shop = ShopSettings::instance();
        $payment_methods = $shop->getPaymentMethodOptions();
        return $payment_methods;
    }

    public function beforeSave()
    {
        $this->reference = self::formatReference();
    }

    public function scopeLastReference($query){
        $query->select('reference')->orderBy('id', 'desc');
    }

}