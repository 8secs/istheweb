<?php namespace Istheweb\Faq\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{
    public $requiredPermissions = ['istheweb.faq.access_faq'];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Faq', 'faq', 'categories');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $postId) {
                if (!$post = Category::find($postId))
                    continue;
                $post->delete();
            }
            Flash::success('Category Deleted', ['name' => 'Category']);
        }
        return $this->listRefresh();
    }
    /**
     *   When clicked on sort button, redirect to sort url with category filter.
     **/
    public function onLinkSort($recordId = null)
    {
        $url = Backend::url('istheweb/faq/questions/reorder');
        return Redirect::to($url.'/'.$recordId);
    }
}