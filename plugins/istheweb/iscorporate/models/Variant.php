<?php namespace Istheweb\IsCorporate\Models;

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

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        /*'project'       => 'Istheweb\IsCorporate\Models\Project',
        'budget'        => 'Istheweb\IsCorporate\Models\Budget',*/

    ];
    public $belongsToMany = [
        'optionsValues' => ['Istheweb\IsCorporate\Models\OptionValue',
            'table' => 'istheweb_iscorporate_pivots',
        ]
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
            'standard'                          => 'Standard',
            'channel_and_currency_based'        => 'Channel and Currency based'
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

            $options = $variant['optionsValues'];
            foreach ($options as $k => $v){
                $ov = OptionValue::find($v);
                $this->optionsValues()->add($ov);
            }
        }
    }
}