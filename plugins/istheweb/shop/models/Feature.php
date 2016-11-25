<?php namespace Istheweb\Shop\Models;



/**
 * Feature Model
 */
class Feature extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_features';



    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'feature_items'          => 'Istheweb\Shop\Models\FeatureItem',
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}