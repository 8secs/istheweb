<?php namespace Istheweb\IsCorporate\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Carbon\Carbon;
use Istheweb\Connect\Models\CompanySettings;
use Istheweb\IsCorporate\Models\Budget;
use Istheweb\IsCorporate\Models\OptionValue;
use Istheweb\IsCorporate\Models\Project;
use Istheweb\IsCorporate\Models\Variant;
use Renatio\DynamicPDF\Classes\PDF;
use Renatio\DynamicPDF\Models\PDFTemplate;
use October\Rain\Exception\ApplicationException;
use Flash;

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

    public function onGeneratePdf()
    {
        $budget = Budget::where('id',$this->params)->first();

        $data = $this->getData($budget);

        $pdf = $this->createPdf($data);
        $pdfName = date('Y'). '-'.$this->getOrdersYearCount();

        $budget->invoice = $pdfName;
        $budget->save();

        Flash::success('Se ha creado y guardado correctamente el pdf');

        return Redirect::refresh();
    }

    public function preview($id){
        $templateCode = 'budget-template';

        $budget = Budget::where('id',$this->params)->first();

        $data = $this->getData($budget);

        try {

            return PDF::loadTemplate($templateCode, $data)->stream();
        } catch (ApplicationException $e) {
            $this->pageTitle = trans('renatio.dynamicpdf::lang.templates.preview');
            $this->vars['error'] = $e->getMessage();
        }
    }

    protected function createPdf($data)
    {
        try
        {
            $templateCode = 'budget-template';
            return PDF::loadTemplate($templateCode, $data)->save('storage/app/media/presupuestos/'.$data['pdf']);
        } catch (Exception $e)
        {
            Flash::error($e->getMessage());
        }
    }

    protected function getData($budget)
    {
        $client = $budget->client;
        $company = CompanySettings::instance();

        $pdf = date('Y'). '-'.$this->getOrdersYearCount().'.pdf';
        $pdfNumber = date('Y'). '-'.$this->getOrdersYearCount();

        return $data = [
            'company'   => $company,
            'address'   => $company->address,
            'client'    => $client,
            'pdf'    => $pdf,
            'pdfNumber' => $pdfNumber,

        ];
    }

    protected function getOrdersYearCount()
    {
        $year = date('Y');
        //$orders = Order::whereBetween('created_at', [$year.'-1-01', $year.'-12-31'])->get();
        $budgets = Budget::where('invoice', '<>', '')->get();
        return $budgets->count()+1;
    }
}