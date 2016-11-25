<?php namespace Istheweb\Carousel\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Slides Back-end Controller
 */
class Slides extends Controller
{
    public $requiredPermissions = ['istheweb.carousel.access_slides'];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Carousel', 'carousel', 'istheweb.carousel::lang.slides.controller_label');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $employeeId) {
                if (!$employee = Employee::find($employeeId)) {
                    continue;
                }

                $employee->delete();
            }

            Flash::success(Lang::get('istheweb.carousel::lang.slides.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.carousel::lang.slides.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}