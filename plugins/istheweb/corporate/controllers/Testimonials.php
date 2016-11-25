<?php namespace Istheweb\Corporate\Controllers;

use Istheweb\Corporate\Models\Testimonial;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Testimonials Back-end Controller
 */
class Testimonials extends Controller
{
    public $requiredPermissions = ['istheweb.corporate.access_testimonials'];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Corporate', 'corporate', 'istheweb.corporate::lang.testimonials.controller_label');
    }

    /**
     * Deleted checked testimonials.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $testimonialId) {
                if (!$testimonial = Testimonial::find($testimonialId)) {
                    continue;
                }

                $testimonial->delete();
            }

            Flash::success(Lang::get('istheweb.corporate::lang.testimonials.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.corporate::lang.testimonials.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}