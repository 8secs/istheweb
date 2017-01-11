<?php namespace NetSTI\Connections\Controllers;

// LIBRERIAS
use Lang;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;

// CONTROLADOR
class Calendars extends Controller{

	// PROPRIEDADES
	public $implement = [
		'Backend\Behaviors\ListController',
		'Backend\Behaviors\FormController',
		'NetSTI\Connections\Behaviors\DeleteList',
		'NetSTI\Connections\Behaviors\ModalContext'
	];
	
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'netsti.connections.events' 
    ];

	public function __construct()
	{
		parent::__construct();
		BackendMenu::setContext('NetSTI.Connections', 'connections', 'events');
	}
}