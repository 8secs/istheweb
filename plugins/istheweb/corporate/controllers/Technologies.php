<?php namespace Istheweb\Corporate\Controllers;

use Istheweb\Corporate\Models\Technology;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Technologies Back-end Controller
 */
class Technologies extends Controller
{
    public $requiredPermissions = ['istheweb.corporate.access_technologies'];

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

        BackendMenu::setContext('Istheweb.Corporate', 'corporate', 'istheweb.corporate::lang.technologies.controller_label');
    }

    /**
     * Deleted checked services.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $serviceId) {
                if (!$service = Technology::find($serviceId)) {
                    continue;
                }

                $service->delete();
            }

            Flash::success(Lang::get('istheweb.corporate::lang.technologies.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.corporate::lang.technologies.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}