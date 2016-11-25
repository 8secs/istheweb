<?php namespace Istheweb\Corporate\Models;


/**
 * Employee Model
 */
class Employee extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_corporate_employees';

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'roles' => [
            'Istheweb\Corporate\Models\Role',
            'table' => 'istheweb_corporate_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];
    protected $appends = ['name', 'duties'];

    public function getRolesOptions()
    {
        return Role::all()->lists('name', 'id');
    }

    public function afterDelete()
    {
        if($this->picture) $this->picture->delete();
        if($this->roles()) $this->roles()->detach();
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getDutiesAttribute()
    {
        return implode(', ', $this->roles()->orderBy('name', 'asc')->lists('name', 'id'));
    }

}