<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * OrderStatus Model
 */
class OrderStatus extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_order_statuses';

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
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}