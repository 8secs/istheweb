<?php namespace Istheweb\IsCorporate\Models;

/**
 * ProjectOption Model
 */
class ProjectOption extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_project_options';


    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name', 'code'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'values'        => 'Istheweb\IsCorporate\Models\OptionValue'
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'projects' => ['Istheweb\IsCorporate\Models\Product',
            'table' => 'istheweb_iscorporate_pivots',
        ],
        'budgets' => ['Istheweb\IsCorporate\Models\Budget',
            'table' => 'istheweb_iscorporate_pivots',
        ]/*,
        'roles' => [
            'Istheweb\IsCorporate\Models\Role',
            'table' => 'istheweb_iscorporate_pivots',
        ],*/

    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}