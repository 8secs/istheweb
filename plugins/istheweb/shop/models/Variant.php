<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * Variant Model
 */
class Variant extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_variants';

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
    public $belongsTo = [
        'product'       => 'Istheweb/Shop/Models/Product'
    ];
    public $belongsToMany = [
        'optionsValues' => ['Istheweb\Shop\Models\OptionValue',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}