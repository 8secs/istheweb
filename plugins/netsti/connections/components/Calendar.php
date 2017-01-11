<?php namespace NetSTI\Connections\Components;

use Lang;
use Flash;
use Backend;
use ValidationException;
use NetSTI\Connections\Models\Event;
use NetSTI\Connections\Models\Calendar as CalendarModel;

class Calendar extends \Cms\Classes\ComponentBase{

	public $calendar;


	public function componentDetails(){
		return [
			'name' => 'Calendar Widget',
			'description' => 'Add Calendar to FrontEnd.'
		];
	}

	public function defineProperties(){
		return [
			'calendar' => [
				'title'		=> 'Calendar',
				'type'		=> 'dropdown',
				'showExternalParam' => false,
			],
		];
	}

	public function onRun(){
		$this->prepareVars();
		
		$this->addCss('/plugins/netsti/connections/assets/css/fullcalendar.css');
		$this->addCss('/plugins/netsti/connections/assets/css/calendar_comp.css');
		$this->addJs('/plugins/netsti/connections/assets/js/moment.min.js');
		$this->addJs('/plugins/netsti/connections/assets/js/fullcalendar.min.js');
	}

	protected function prepareVars(){
		$this->inputClass = $this->property('inputClass');
		$this->ifInline = $this->property('ifInline');
		$this->submitClass = $this->property('submitClass');
		$this->style = $this->property('style');

		$this->calendar = $this->page['calendar'] = CalendarModel::find($this->property('calendar'));
	}

	public function getCalendarOptions(){
		return CalendarModel::lists('name', 'id');
	}
}
?>