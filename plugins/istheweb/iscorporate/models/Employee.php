<?php namespace Istheweb\IsCorporate\Models;


/**
 * Employee Model
 */
class Employee extends Base
{

    const MODEL_NAME = 'Employee';
    const USER_GROUP_CODE = 'connect';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_employees';

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
        'user'  => 'Backend\Models\User'
    ];
    public $belongsToMany = [
        'roles' => [
            'Istheweb\IsCorporate\Models\Role',
            'table' => 'istheweb_iscorporate_pivots',
        ],
        'projects' => [
            'Istheweb\IsCorporate\Models\Project',
            'table' => 'istheweb_iscorporate_pivots',
        ]/*,
        'variants'  => [
            'Istheweb\IsCorporate\Models\Variants',
            'table' => 'istheweb_iscorporate_pivots',
        ]*/,
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [

    ];
    public $attachOne = [
        'avatar' => ['System\Models\File']
    ];
    public $attachMany = [];

}