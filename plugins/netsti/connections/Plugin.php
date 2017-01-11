<?php namespace NetSTI\Connections;

use DB;
use Lang;
use Event;
use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase{

	// REQUIRED PLUGINS
	public $require = [];

	// DETAILS
	public function pluginDetails(){
		return [
			'name'        => 'Connections',
			'description' => 'Manage Companies, Contacts, Events, Calendars and Subscribers, with Contact and Subscribe Form',
			'author'      => 'NetSTI',
			'icon'        => 'icon-users',
			'homepage'    => 'http://netsti.com/plugins',
		];
	}

	// PERMISSIONS
	public function registerPermissions(){
		return [
			'netsti.connections.events' => [
				'tab'   => 'netsti.connections::lang.menu.connections',
				'label' => 'netsti.connections::lang.menu.events',
			],
			'netsti.connections.contacts' => [
				'tab'   => 'netsti.connections::lang.menu.connections',
				'label' => 'netsti.connections::lang.menu.contacts',
			],
			'netsti.connections.inboxes' => [
				'tab'   => 'netsti.connections::lang.menu.connections',
				'label' => 'netsti.connections::lang.menu.inboxes',
			],
			'netsti.connections.subscribers' => [
				'tab'   => 'netsti.connections::lang.menu.connections',
				'label' => 'netsti.connections::lang.menu.subscribers',
			],
		];
	}

	// MENU AND NAVIGATIONS
	public function registerNavigation(){
		return [
			'connections'     => [
				'label'       => 'netsti.connections::lang.menu.connections',
				'url'         => Backend::url('netsti/connections/connections'),
				'icon'        => 'icon-users',
				'permissions' => ['netsti.connections.*'],
				'order'       => '100',

				'sideMenu'    => [
					'companies'       => [    
						'label'       => 'netsti.connections::lang.menu.companies',
						'url'         => Backend::url('netsti/connections/companies'),
						'icon'        => 'icon-bank',
						'permissions' => ['netsti.connections.contacts']
					], 
					'contacts'        => [      
						'label'       => 'netsti.connections::lang.menu.contacts',
						'url'         => Backend::url('netsti/connections/contacts'),
						'icon'        => 'icon-user',
						'permissions' => ['netsti.connections.contacts']
					], 
					'events'          => [          
						'label'       => 'netsti.connections::lang.menu.events',
						'url'         => Backend::url('netsti/connections/events'),
						'icon'        => 'icon-calendar-o',
						'permissions' => ['netsti.connections.events']
					], 
					'inboxes'         => [        
						'label'       => 'netsti.connections::lang.menu.inboxes',
						'url'         => Backend::url('netsti/connections/inboxes'),
						'icon'        => 'icon-inbox',
						'counter'     => ($i = DB::table('netsti_connections_inboxes')->where('status', 0)->count()) ? $i : null,
						'permissions' => ['netsti.connections.inboxes'],
					], 
					'subscribers'     => [
						'label'       => 'netsti.connections::lang.menu.subscribers',
						'url'         => Backend::url('netsti/connections/subscribers'),
						'icon'        => 'icon-rss',
						'permissions' => ['netsti.connections.subscribers']
					],
				]
			]
		];
	}

	// COMPONENTS
	public function registerComponents(){
		return [
			'NetSTI\Connections\Components\SubscribeComponent' => 'subscribeForm',
			'NetSTI\Connections\Components\ContactComponent'   => 'inboxForm',
			'NetSTI\Connections\Components\Calendar'           => 'calendarWidget',
		];
	}

	// SETTINGS
	public function registerSettings(){
		return [
			'slack'           => [
				'label'       => 'netsti.connections::lang.slack',
				'description' => 'netsti.connections::lang.slack_description',
				'icon'        => 'icon-slack',
				'class'       => 'NetSTI\Connections\Models\SlackSettings',
				'category'    => 'netsti.connections::lang.manage',
				'order'       => 101,
				'keywords'    => 'crm customer relationship management slack'
			],
			'mail_preference' => [
				'label'       => 'netsti.connections::lang.mail_preference',
				'description' => 'netsti.connections::lang.mail_preference_description',
				'icon'        => 'icon-envelope',
				'class'       => 'NetSTI\Connections\Models\MailSettings',
				'category'    => 'netsti.connections::lang.manage',
				'order'       => 102,
				'keywords'    => 'crm customer relationship management mail'
			],
			'company'         => [
				'label'       => 'netsti.connections::lang.company',
				'description' => 'netsti.connections::lang.company_description',
				'icon'        => 'icon-building-o',
				'class'       => 'NetSTI\Connections\Models\CompanySettings',
				'category'    => 'netsti.connections::lang.manage',
				'order'       => 103,
				'keywords'    => 'crm customer relationship management company'
			]
		];	
	}

	public function registerMailTemplates(){
		return [
			'netsti.connections::mail.contact-form'    => 'Sent contact form details.',
			'netsti.connections::mail.contact-reply'   => 'Sent contact form auto reply.',
			'netsti.connections::mail.subscribe-reply' => 'Sent subscribe form auto reply.',
		];
	}

	// MARKUP TAGS
	public function registerMarkupTags(){
		return [
			'filters' => [
				'strpad' => [$this, 'makeStrPad'],
				'lang'   => ['Lang', 'get']
			],
			'functions'=> [
				'company' => ['NetSTI\Connections\Models\CompanySettings', 'get'],
				'_'   => ['Lang', 'get']
			]
		];
	}

	public function makeStrPad($text, $digits){
		return str_pad($text, $digits, 0, STR_PAD_LEFT);
	}

	// ON BOOT
	public function boot(){

	}

	// FORM WIDGETS
	public function registerFormWidgets(){
		return [
			'NetSTI\Connections\FormWidgets\Address' => [
				'label' => 'Address',
				'code'  => 'address'
			],
		];
	}
}
