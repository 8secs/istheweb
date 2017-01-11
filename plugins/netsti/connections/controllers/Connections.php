<?php namespace NetSTI\Connections\Controllers;

// LIBRERIAS
use Lang;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;

// CONTROLADOR
class Connections extends Controller{

	// PROPRIEDADES
	public $implement = [];
	public $pageTitle = "netsti.connections::lang.menu.connections";
	
	public $requiredPermissions = [
		'netsti.connections.events', 
		'netsti.connections.contacts', 
		'netsti.connections.inboxes', 
		'netsti.connections.subscribers' 
	];

	public function __construct()
	{
		parent::__construct();
		BackendMenu::setContext('NetSTI.Connections', 'connections');
	}

	// METODOS
	public function index(){
		return '<div class="layout-relative"> 
                    <div class="layout"> 
                        <div class="layout-row"> 
                            <div class="layout"> 
                                <div class="layout-cell oc-bg-logo"> 
                                    <script> 
                                        $(document).ready(function(){$("#settings-search-input").focus() }) 
                                    </script> 
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div>';
	}
}