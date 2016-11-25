<?php namespace Istheweb\Carousel\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Items Types Back-end Controller
 */
class ItemsTypes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Carousel', 'carousel', 'istheweb.carousel::lang.itemtypes.controller_label');
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

            Flash::success(Lang::get('istheweb.carousel::lang.itemtypes.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.carousel::lang.itemtypes.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}