<?php namespace Istheweb\Slider\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Slides Back-end Controller
 */
class Slides extends Controller
{
    public $requiredPermissions = ['istheweb.slider.access_slides'];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = "config_relation.yaml";

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Slider', 'slider', 'istheweb.slider::lang.slides.controller_label');
    }
}