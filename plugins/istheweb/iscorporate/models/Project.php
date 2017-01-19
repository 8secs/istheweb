<?php namespace Istheweb\IsCorporate\Models;

use Illuminate\Support\Facades\Lang;

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
    public $hasMany = [
        'reports'       => 'Istheweb\IsCorporate\Models\Report',
    ];
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

    /*
    public $hasManyThrough = [
        'reports' => [
            'Istheweb\IsCorporate\Models\Report',
            'through' => 'Istheweb\IsCorporate\Models\Variant'
        ],
    ];*/

    public $attachOne = [];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
        'documents' => ['System\Models\File'],
    ];


    public function getProjectTypesOptions()
    {
        return ProjectType::all()->lists('name', 'id');
    }

    public function getBudgetsOptions()
    {
        return Budget::all()->lists('name', 'id');
    }

    public function getStatusOptions()
    {
        return [
            '1' => 'istheweb.iscorporate::lang.project_state.active',
            '2' => 'istheweb.iscorporate::lang.project_state.discontinued',
            '3' => 'istheweb.iscorporate::lang.project_state.completed'
        ];
    }

    public function getNowOptions()
    {
        return [
            '1'   => 'istheweb.iscorporate::lang.project_now.waiting_material',
            '2'   => 'istheweb.iscorporate::lang.project_now.waiting_answers',
            '3'   => 'istheweb.iscorporate::lang.project_now.in_production',
            '4'   => 'istheweb.iscorporate::lang.project_now.in_test',
            '5'   => 'istheweb.iscorporate::lang.project_now.waiting_payment',
            '6'   => 'istheweb.iscorporate::lang.project_now.wating_to_public_client_server',
            '7'   => 'istheweb.iscorporate::lang.project_now.terminated'
        ];
    }


    public static function getSelectedColumn($k, $column){

        $project = new Project();
        if($column == 'status'){
            $array = $project->getStatusOptions();
        } else {
            $array = $project->getNowOptions();
        }

        foreach($array as $key => $value){
            if($k == $key) {
                return Lang::get($value);
            }
        }
    }

    public static function getProjectBySlug($slug){
        $project = Project::where('slug', $slug)->first();
        return $project;
    }

}