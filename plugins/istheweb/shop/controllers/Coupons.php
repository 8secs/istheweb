<?php namespace Istheweb\Shop\Controllers;

use BackendMenu;
use Flash;
use Lang;
use Backend\Classes\Controller;
use Istheweb\Shop\Models\Coupon;

/**
 * Coupons Back-end Controller
 */
class Coupons extends Controller
{
    public $requiredPermissions = ['istheweb.shop.access_coupons'];

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

        BackendMenu::setContext('Istheweb.Shop', 'shop', 'coupons');
    }

    /**
     * Deleted checked services.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $categoryId) {
                if (!$category = Coupon::find($categoryId)) {
                    continue;
                }

                $category->delete();
            }

            Flash::success(Lang::get('istheweb.shop::lang.coupons.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.shop::lang.coupons.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}