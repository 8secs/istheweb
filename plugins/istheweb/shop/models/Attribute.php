<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * Attribute Model
 */
class Attribute extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_attributes';

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
    public $hasMany = [
        'attributeValues'       => 'Istheweb\Shop\Models\AttributeValue'
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}