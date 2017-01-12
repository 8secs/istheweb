<?php namespace Istheweb\IsCorporate\Models;

/**
 * OptionValue Model
 */
class OptionValue extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_option_values';

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['code', 'value', 'price'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'project_option'       => 'Istheweb\IsCorporate\Models\ProjectOption'
    ];
    public $belongsToMany = [
        'variants' => ['Istheweb\IsCorporate\Models\Variant',
            'table' => 'istheweb_iscorporate_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];



}