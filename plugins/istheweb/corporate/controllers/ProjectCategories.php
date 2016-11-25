<?php namespace Istheweb\Corporate\Controllers;

use Istheweb\Corporate\Models\ProjectCategory;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Project Categories Back-end Controller
 */
class ProjectCategories extends Controller
{
    public $requiredPermissions = ['istheweb.corporate.access_project_categories'];

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

        BackendMenu::setContext('Istheweb.Corporate', 'corporate', 'istheweb.corporate::lang.project_categories.controller_label');
    }

    /**
     * Deleted checked services.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $categoryId) {
                if (!$category = ProjectCategory::find($categoryId)) {
                    continue;
                }

                $category->delete();
            }

            Flash::success(Lang::get('istheweb.corporate::lang.project_categories.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.corporate::lang.project_categories.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}