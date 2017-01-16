<?php namespace Istheweb\IsCorporate\Models;

/**
 * Project Model
 */
class Project extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_projects';

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
        'client'            => 'Istheweb\IsCorporate\Models\Client'
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
    public $attachMany = [
        'pictures' => ['System\Models\File'],
    ];

    public function getProjectTypesOptions()
    {
        return ProjectType::all()->lists('name', 'id');
    }

    public function getBudgetsOptions()
    {
        return Budget::all()->lists('name', 'id');
    }

    public static function getProjectBySlug($slug){
        $project = Project::where('slug', $slug)->first();
        return $project;
    }

}