<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * TaxRate Model
 */
class TaxRate extends Base
{

    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_tax_rates';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation Rules
     */
    protected $rules = [
        'rate' => 'required|number'
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'zone' => 'Istheweb\Shop\Models\Zone',
        'tax_category' => 'Istheweb\Shop\Models\TaxCategory'
    ];

}