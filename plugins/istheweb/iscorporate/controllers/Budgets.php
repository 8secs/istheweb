<?php namespace Istheweb\IsCorporate\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Carbon\Carbon;
use Istheweb\IsCorporate\Models\Budget;
use Istheweb\IsCorporate\Models\OptionValue;
use Istheweb\IsCorporate\Models\Project;
use Istheweb\IsCorporate\Models\Variant;

/**
 * Budgets Back-end Controller
 */
class Budgets extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        'Istheweb.Connect.Behaviors.DeleteList'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.IsCorporate', 'iscorporate', 'budgets');
    }

    public function onGenerateProject()
    {
        $budget = Budget::where('id',$this->params)->first();
        $client = $budget->client;
        $project_types = $budget->project_types;
        $options = $budget->options;
        $variants = $budget->variants;


        $c = $client->company->name."_".$budget->motivo;
        $code = strtolower(str_replace(" ", "_",$c));
        $slug = str_replace("_", '-', $code);

        $project = Project::getProjectBySlug($slug);

        if($project == null){
            $project = new Project();
        }

        $project->name = $budget->motivo;
        $project->client  = $client;
        $project->code = $code;
        $project->slug = $slug;
        $project->available_on = Carbon::now();
        $project->available_until = $budget->fecha_entrega;
        $project->enabled = 0;

        $project->project_types = $project_types;
        $project->options = $options;

        $project->save();
        if(!$variants->isEmpty()){
            foreach($variants as $variant){
                $project_variant = new Variant();
                $project_variant->imageable_id = $project->id;
                $project_variant->imageable_type = get_class($project);
                $project_variant->code = $variant->code."_project";
                $project_variant->name = $variant->name;
                $project_variant->price = $variant->price;
                $project_variant->availableOn = $variant->availableOn;
                $project_variant->availableUntil = $variant->availableUntil;
                $project_variant->pricing_calculator = $variant->pricing_calculator;
                $options = $variant->optionsValues;
                //dd($options);
                $project_variant->save();
                foreach ($options as $option){
                    $project_variant->optionsValues()->add($option);
                }
                $project->variants()->add($project_variant);
            }
        }
        dd($project->variants);

    }
}