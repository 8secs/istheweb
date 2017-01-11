<?php namespace NetSTI\Connections\Controllers;

// LIBRERIAS
use Lang;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;

// CONTROLADOR
class Subscribers extends Controller{

	// PROPRIEDADES
	public $implement = [
		'Backend\Behaviors\ListController',
		'Backend\Behaviors\FormController',
		'Backend\Behaviors\ImportExportController',
		'NetSTI\Connections\Behaviors\DeleteList',
		'NetSTI\Connections\Behaviors\ModalContext'
	];
	
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $importExportConfig = 'config_migration.yaml';

    public $requiredPermissions = [
        'netsti.connections.subscribers' 
    ];

	public function __construct()
	{
		parent::__construct();
		BackendMenu::setContext('NetSTI.Connections', 'connections', 'subscribers');
	}
}