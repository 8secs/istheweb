<?php namespace Istheweb\IsCorporate\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Istheweb\IsCorporate\Models\Budget;
use Istheweb\IsCorporate\Models\Project;

/**
 * Projects Back-end Controller
 */
class Projects extends Controller
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

    public $budgets;

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.IsCorporate', 'iscorporate', 'projects');

        $this->preparevars();
    }

    protected function preparevars(){
        $this->budgets = $this->vars['budgets'] = $this->getBudgets();


    }

    public function getBudgets()
    {
        $budgets = Budget::all();

        return $budgets;
    }

}