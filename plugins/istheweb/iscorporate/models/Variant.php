<?php namespace Istheweb\IsCorporate\Models;

use Backend\Facades\BackendAuth;
use Illuminate\Support\Facades\Request;

/**
 * Variant Model
 */
class Variant extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_variants';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'code',
        'name',
        'availableOn',
        'pricing_calculator',
    ];

    protected $jsonable = ['data', 'urls'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'reports'       => 'Istheweb\IsCorporate\Models\Report',
    ];
    public $belongsTo = [
        'employee'      => 'Istheweb\IsCorporate\Models\Employee',
    ];
    public $belongsToMany = [
        'optionsValues' => ['Istheweb\IsCorporate\Models\OptionValue',
            'table' => 'istheweb_iscorporate_pivots',
        ],
    ];
    public $morphTo = [
        'imageable' => []
    ];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getPricingCalculatorOptions(){
        return [
            'standard'                          => 'istheweb.iscorporate::lang.labels.standard',
            'channel_and_currency_based'        => 'istheweb.iscorporate::lang.labels.channel_and_currency_based'
        ];
    }

    public function getProjectsOptions(){
        $projects = Project::all()->lists('name', 'id');
        return $projects;
    }

    public function getBugetsOptions()
    {
        $budgets = Budget::all()->lists('name', 'id');
        return $budgets;
    }

    public function getStatusOptions()
    {
        return [
            '1' => 'Nueva',
            '2' => 'En progreso',
            '3' => 'Suspendida',
            '4' => 'Finalizada',

        ];
    }

    public function getSelectedStatus($status)
    {
        $statuses = $this->getStatusOptions();
        foreach($statuses as $key => $value){
            if($key == $status){
                return $value;
            }
        }

    }

    public function scopeProject($query)
    {
        $path = explode('/', Request::path());
        $id = last($path);
        return $query->where('imageable_id', '=', $id)
            ->where('imageable_type', 'Istheweb\IsCorporate\Models\Project');
    }

    public function isBackendUser(){
        //return $this->employee->user->id = BackendAuth::getUser()->id ? true : false;
        $isbackend = false;
        if($this->employee->user->id == BackendAuth::getUser()->id){
            $isbackend = true;
        }
        return $isbackend;
    }

    public function beforeSave()
    {
        $manage_id = post('_relation_field');

        if(isset($manage_id)){
            $path = explode('/', Request::path());
            $id = last($path);
            if($path[3] == 'budgets'){
                $imageable = Budget::find($id);
            }else{
                $imageable = Project::find($id);
            }

            $variant = post('Variant');

            $this->imageable_id = $imageable->id;
            $this->imageable_type = get_class($imageable);

            $this->employee = $variant['employees'];

            /*
            if(post('is_report')){
                $report = new Report($variant['Report']);
                $report->employee = $this->employee;
                $report->variant_id = $this->id;
                $this->reports()->add($report);
            }*/


            $options = $variant['optionsValues'];
            foreach ($options as $k => $v){
                $ov = OptionValue::find($v);
                $this->optionsValues()->add($ov);
            }
        }
    }

}