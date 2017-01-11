<?php namespace NetSTI\Connections\Controllers;

// LIBRERIAS
use Lang;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use NetSTI\Connections\Models\Event;
use NetSTI\Connections\Models\Calendar;

// CONTROLADOR
class Events extends Controller{

	// PROPRIEDADES
	public $implement = [
		'Backend\Behaviors\ListController',
		'Backend\Behaviors\FormController',
		'NetSTI\Connections\Behaviors\DeleteList',
		'NetSTI\Connections\Behaviors\ModalContext'
	];
	
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $bodyClass = 'compact-container';

    public $requiredPermissions = [
        'netsti.connections.events' 
    ];

	public function __construct()
	{

		parent::__construct();
		BackendMenu::setContext('NetSTI.Connections', 'connections', 'events');
	}

	public function index(){
		$this->vars['calendars'] = Calendar::all();

		$this->addCss('/plugins/netsti/connections/assets/css/timeline.css');
		$this->addCss('/plugins/netsti/connections/assets/css/calendar.css');

		$this->addJs('/plugins/netsti/connections/assets/js/moment.min.js');
		$this->addJs('/plugins/netsti/connections/assets/js/jquery-ui.min.js');
		$this->addJs('/plugins/netsti/connections/assets/js/timeline.min.js');

		$this->pageTitle = Lang::get('netsti.connections::lang.menu.events');

		$this->asExtension('ListController')->index();
	}

	public function listView(){
		$this->asExtension('ListController')->index();

		return $this->makePartial('list');
	}

	public function onChangeDate(){
		$start = strtotime("-1 month", strtotime(post('start_date')));
		$end = strtotime("+1 month", strtotime(post('end_date')));
		$events = Event::whereBetween('end_date', [
			date('Y-m-d H:i:s', $start), 
			date('Y-m-d H:i:s', $end)
		])->get();

		return [
			'start_date' =>  date('Y-m-d H:i:s',$start),
			'end_date' => date('Y-m-d H:i:s',$end),
			'items'=> $events
		];
	}
}