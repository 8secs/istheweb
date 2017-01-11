<?php namespace Istheweb\Corporate\Models;

use Backend\Models\User as BackendUser;

use Backend\Models\User;
use Backend\Models\UserGroup;
use Model;

/**
 * Empleado Model
 */
class Empleado extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_corporate_empleados';

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'user'  => 'Backend\Models\User'
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'avatar' => ['System\Models\File']
    ];
    public $attachMany = [];

}