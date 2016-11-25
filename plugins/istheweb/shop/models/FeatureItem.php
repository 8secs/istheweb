<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * FeatureItem Model
 */
class FeatureItem extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_feature_items';

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
        'feature'       => 'Istheweb\Shop\Models\Feature'
    ];
    public $belongsToMany = [
        'products'           => [ 'Istheweb\Shop\Models\Product',
            'table'         =>  'istheweb_shop_pivots'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}