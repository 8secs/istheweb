<?php namespace Istheweb\Corporate\Models;



/**
 * Service Model
 */
class Service extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_corporate_services';

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'projects' => [
            'Istheweb\Corporate\Models\Project',
            'table' => 'istheweb_corporate_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
        'files'    => ['System\Models\File'],
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public function afterDelete()
    {
        if($this->projects()) $this->projects()->detach();
    }

    public function getProjectsOptions()
    {
        return Project::all()->lists('name', 'id');
    }

}