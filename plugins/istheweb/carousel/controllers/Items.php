<?php namespace Istheweb\Carousel\Controllers;

use Istheweb\Carousel\Models\Item;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Items Back-end Controller
 */
class Items extends Controller
{
    public $requiredPermissions = ['istheweb.carousel.access_items'];

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

        BackendMenu::setContext('Istheweb.Carousel', 'carousel', 'istheweb.carousel::lang.items.controller_label');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $itemId) {
                if (!$item = Item::find($itemId)) {
                    continue;
                }

                $item->delete();
            }

            Flash::success(Lang::get('istheweb.carousel::lang.items.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.carousel::lang.items.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}