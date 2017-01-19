<?php namespace Istheweb\IsCorporate\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Backend\Facades\BackendAuth;
use Carbon\Carbon;
use Istheweb\IsCorporate\Models\Report;
use Istheweb\IsCorporate\Models\Variant;

/**
 * ProjectVariantReport Form Widget
 */
class ProjectVariantReport extends FormWidgetBase
{
    use \Backend\Traits\FormModelWidget;

    /**
     * @var int Maximum rows to display for each page.
     */
    public $recordsPerPage = 10;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'istheweb_iscorporate_project_variant_report';

    /**
     * {@inheritDoc}
     */
    protected $project;

    /**
     * @var string Use a custom scope method for the list query.
     */
    public $scope;

    /**
     * @var string Filters the relation using a raw where query statement.
     */
    public $conditions;

    /**
     * @var \Backend\Classes\WidgetBase Reference to the widget used for viewing (list or form).
     */
    protected $listWidget;

    /**
     * @var \Backend\Classes\WidgetBase Reference to the widget used for searching.
     */
    protected $searchWidget;

    /**
     * @var string If searching the records, specifies a policy to use.
     * - all: result must contain all words
     * - any: result can contain any word
     * - exact: result must contain the exact phrase
     */
    public $searchMode;

    /**
     * @var string Field name to use for key.
     */
    public $keyFrom = 'id';

    /**
     * @var string Relation column to display for the name
     */
    public $nameFrom;

    /**
     * @var string Use a custom scope method for performing searches.
     */
    public $searchScope;

    /**
     * @var Model Relationship model
     */
    public $relationModel;

    /**
     * @var time Total time worked on this task
     */
    public $totalDone;

    /**
     * @var string Selected task status name
     */
    public $selectedStatus;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig([
            'title',
            'prompt',
            'keyFrom',
            'nameFrom',
            'descriptionFrom',
            'scope',
            'conditions',
            'searchMode',
            'searchScope',
            'recordsPerPage',
        ]);


        $this->listWidget = $this->makeListWidget();
        $this->listWidget->bindToController();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('projectvariantreport');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {

        $this->vars['model'] = $this->model;

        $this->vars['value'] = $this->getKeyValue();
        $this->vars['field'] = $this->formField;
        $this->vars['nameValue'] = $this->getNameValue();
        $this->vars['descriptionValue'] = $this->getDescriptionValue();


        $this->relationModel = $this->getLoadValue();

        $this->vars['is_resource'] = $this->isUser();
        $this->vars['listWidget'] = $this->listWidget;
        $this->vars['totalDone'] = $this->getTotalReports();
        $this->vars['selectedStatus'] = $this->model->getSelectedStatus($this->model->status);
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/projectvariantreport.css', 'Istheweb.IsCorporate');
        $this->addJs('js/projectvariantreport.js', 'Istheweb.IsCorporate');
    }

    public function onRefresh()
    {
        list($model, $attribute) = $this->resolveModelAttribute($this->valueFrom);
        $model->{$attribute} = post($this->formField->getName());

        $this->prepareVars();
        return $this->makePartial('projectvariantreport');
    }

    /**
     * {@inheritDoc}
     */
    public function getLoadValue()
    {
        list($model, $attribute) = $this->resolveModelAttribute($this->valueFrom);

        if (!is_null($model)) {
            return $model->{$attribute};
        }

        return null;
    }

    public function getKeyValue()
    {
        if (!$this->relationModel) {
            return null;
        }

        return $this->relationModel->{$this->keyFrom};
    }

    public function getNameValue()
    {
        if (!$this->relationModel || !$this->nameFrom) {
            return null;
        }

        return $this->relationModel->{$this->nameFrom};
    }

    public function getDescriptionValue()
    {
        if (!$this->relationModel || !$this->descriptionFrom) {
            return null;
        }

        return $this->relationModel->{$this->descriptionFrom};
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        //dd($this->formField->value);
        //return $this->formField->value;

        if(is_array($this->formField->value)){
            $arr = array();
            foreach ($this->formField->value as $k => $v){
                $option = Variant::find($v);
                $arr[] = $option;
            }
        }
        return $arr ?: null;
    }

    public function isUser()
    {
        $back_user = BackendAuth::getUser();
        $is_same = false;
        if($back_user->id == $this->model->employee->user->id){
            $is_same = true;
        }
        return $is_same;
    }

    protected function getTotalReports(){
        $hours = 0;
        $minutes = 0;
        foreach($this->model->reports as $report){
            $hours += $report->hours;
            $minutes += $report->minutes;
        }

        $time = $this->calculateTime($hours, $minutes);

        return $time;
    }

    protected function calculateTime($hours, $minutes){
        if($minutes > 60){
            $hours += 1;
            $minutes = $minutes - 60;
            if($minutes > 60){
                $this->calculateTime($hours, $minutes);
            }
        }
        return [
            $hours, $minutes
        ];
    }

    protected function makeListWidget()
    {
        $config = $this->makeConfig($this->getConfig('list'));
        $config->model = $this->getRelationModel();
        $config->alias = $this->alias . 'List';
        $config->showSetup = false;
        $config->showCheckboxes = false;
        $config->recordsPerPage = $this->recordsPerPage;
        $config->recordOnClick = sprintf("$('#%s').recordFinder('updateRecord', this, ':" . $this->keyFrom . "')", $this->getId());
        $widget = $this->makeWidget('Backend\Widgets\Lists', $config);

        /*$widget->setSearchOptions([
            'mode' => $this->searchMode,
            'scope' => $this->searchScope,
        ]);*/



        return $widget;
    }

    public function onSaveReport()
    {
        $variant = post('Variant');
        $report = new Report();
        $report->hours = $variant['Report']['hours'];
        $report->minutes = $variant['Report']['minutes'];
        $report->comments = $variant['Report']['comment'];
        $report->variant = $this->model;
        $report->employee = $this->model->employee;
        $report->created_at = Carbon::now();
        $report->updated_at = Carbon::now();
        $report->save();
        return true;
        //$this->onRefresh();
    }

    protected function makeSearchWidget()
    {
        $config = $this->makeConfig();
        $config->alias = $this->alias . 'Search';
        $config->growable = false;
        $config->prompt = 'backend::lang.list.search_prompt';
        $widget = $this->makeWidget('Backend\Widgets\Search', $config);
        $widget->cssClasses[] = 'projectvariantreport-search';
        return $widget;
    }
}
