<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * Adjustment Model
 */
class Adjustment extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_adjustments';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $morphTo = [
        'orderable' => []
    ];


}