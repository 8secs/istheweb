<?php namespace Istheweb\Corporate\Controllers;

use Istheweb\Corporate\Models\Role;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Roles Back-end Controller
 */
class Roles extends Controller
{
    public $requiredPermissions = ['istheweb.corporate.access_employees'];

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

        BackendMenu::setContext('Istheweb.Corporate', 'corporate', 'istheweb.corporate::lang.roles.controller_label');
    }

    /**
     * Deleted checked roles.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $roleId) {
                if (!$role = Role::find($roleId)) {
                    continue;
                }

                $role->delete();
            }

            Flash::success(Lang::get('istheweb.corporate::lang.roles.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.corporate::lang.roles.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}