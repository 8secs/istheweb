<?php namespace Istheweb\IsCorporate\Models;

use Model;

/**
 * Budget Model
 */
class Budget extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_budgets';

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
        //'variants'                  => 'Istheweb\IsCorporate\Models\Variant'
    ];
    public $belongsTo = [
        'client'           => 'Istheweb\IsCorporate\Models\Client'
    ];
    public $belongsToMany = [
        'options' => ['Istheweb\IsCorporate\Models\ProjectOption',
            'table' => 'istheweb_iscorporate_pivots',
        ],
        'project_types' => ['Istheweb\IsCorporate\Models\ProjectType',
            'table' => 'istheweb_iscorporate_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [
        'variants'      => ['Istheweb\IsCorporate\Models\Variant', 'name' => 'imageable']
    ];
    public $attachOne = [];
    public $attachMany = [];

}