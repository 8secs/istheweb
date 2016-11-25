<?php namespace Istheweb\Slider\Controllers;

use BackendMenu;
use October\Rain\Support\Facades\Flash;
use Illuminate\Support\Facades\Lang;
use Backend\Classes\Controller;
use Istheweb\Slider\Models\Slider;

/**
 * Sliders Back-end Controller
 */
class Sliders extends Controller
{
    public $requiredPermissions = ['istheweb.slider.access_slider'];

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

        BackendMenu::setContext('Istheweb.Slider', 'slider', 'istheweb.slider::lang.sliders.controller_label');
    }

    /**
     * Deleted checked sliders.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $sliderId) {
                if (!$slider = Slider::find($sliderId)) {
                    continue;
                }

                $slider->delete();
            }

            Flash::success(Lang::get('istheweb.slider::lang.sliders.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.slider::lang.sliders.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}