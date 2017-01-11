<?php namespace NetSTI\Connections\Components;

// CLASSES
use Lang;
use Validator;
use ValidationException;
use Cms\Classes\ComponentBase;
use NetSTI\Connections\Models\Inbox;
use NetSTI\Connections\Classes\MailHelper;

class ContactComponent extends ComponentBase{

	public $props;
	public $fields;

	public function componentDetails(){
		return [
			'name'        => 'Contact Form',
			'description' => 'Add Contact Form Integration.',
			'icon'        => 'icon-envelope',
		];
	}

	public function defineProperties(){
		return [
			'formClass' => [
				'title'             => 'Form Class',
				'type'              => 'string',
				'default'           => 'form-control',
				'group'             => 'Form Options',
				'showExternalParam' => false,
			],
			'inputClass' => [
				'title'             => 'Input Class',
				'type'              => 'string',
				'default'           => 'form-control',
				'group'             => 'Form Options',
				'showExternalParam' => false,
			],
			'groupClass' => [
				'title'             => 'Input Group Class',
				'type'              => 'string',
				'default'           => 'form-group',
				'group'             => 'Form Options',
				'showExternalParam' => false,
			],
			'submitClass' => [
				'title'             => 'Submit Class',
				'type'              => 'string',
				'default'           => 'btn btn-primary',
				'group'             => 'Form Options',
				'showExternalParam' => false,
			],
			'ifLabel' => [
				'title'             => 'Show Labels',
				'type'              => 'checkbox',
				'group'             => 'Form Options',
				'showExternalParam' => false,
				'default'           => true
			],
			'ifTitle' => [
				'title'             => 'Show Form Title',
				'type'              => 'checkbox',
				'group'             => 'Form Options',
				'showExternalParam' => false,
				'default'           => true
			],
			'formTitle' => [
				'title'             => 'Form Title',
				'type'              => 'string',
				'default'           => 'Contact',
				'group'             => 'Form Options',
				'showExternalParam' => false,
			],
			'icons' => [
				'title'             => 'With Icons',
				'type'              => 'checkbox',
				'showExternalParam' => false,
				'group'             => 'Form Options',
				'default'           => false,
			],
			'iconsType' => [
				'title'             => 'Icons Type',
				'type'              => 'dropdown',
				'showExternalParam' => false,
				'group'             => 'Form Options',
				'options' => [
					'fa'        => 'Font Awesome',
					'glyphicon' => 'Glyphicons'
				]

			],
			'notification' => [
				'title'             => 'Notification Type',
				'type'              => 'dropdown',
				'showExternalParam' => false,
				'group'             => 'Form Options',
				'default'           => 'flash',
				'options' => [
					'flash'        => 'PopUp',
					'alert'        => 'Inline Alert'
				]

			],
			'ifPhone' => [
				'title'             => 'Show Phone',
				'type'              => 'checkbox',
				'group'             => 'Extra Fields',
				'showExternalParam' => false,
				'default'           => false
			],
			'ifSubject' => [
				'title'             => 'Show Subject',
				'type'              => 'checkbox',
				'group'             => 'Extra Fields',
				'showExternalParam' => false,
				'default'           => true
			],
			'ifCompany' => [
				'title'             => 'Show Company',
				'type'              => 'checkbox',
				'group'             => 'Extra Fields',
				'showExternalParam' => false,
				'default'           => false
			],
			'sendDetailEmail' => [
				'title'             => 'Send Details Email',
				'type'              => 'checkbox',
				'default'           => false,
				'group'             => 'On Send',
				'showExternalParam' => false,
			],
			'sendEmail' => [
				'title'             => 'Email to send',
				'type'              => 'string',
				'group'             => 'On Send',
				'showExternalParam' => false,
			],
			'sendReply' => [
				'title'             => 'Send AutoReply Email',
				'type'              => 'checkbox',
				'default'           => false,
				'group'             => 'On Send',
				'showExternalParam' => false,
			],
		];
	}

	public function onRun(){
		$this->prepareVars();

		$this->addCss('/plugins/netsti/connections/assets/css/animate.css');
		$this->addCss('/plugins/netsti/connections/assets/css/components.css');
		$this->addJs('/plugins/netsti/connections/assets/js/components.js');
	}

	protected function prepareVars(){
		$this->props  = $this->getProperties();
		$this->fields = Lang::get('netsti.connections::lang.fields'); 
	}

	public function onContactForm(){
		$data = post();
		$mailHelper = new MailHelper();

		$rules = [
			'name'  => 'required|between:2,64',
			'email' => 'required|email|between:8,64',
			'message' => 'required|min:10'
		];

		$validation = Validator::make($data, $rules);
		$notify = $this->property('nofitication');

		if ($validation->fails()) {
			return [
				'#flash' => $this->renderPartial('@error-alert', [
					'messages' => $validation->messages(),
					'props'    => $this->props
				]),
			];
		}

		Inbox::create($data);

		if($this->property('sendDetailEmail'))
			$mailHelper->sendContactFormMail($this->property('sendEmail'), $data);

		if($this->property('sendReply'))
			$mailHelper->sendContactReplyMail($data['email']);

		return [
			'#contact-form-render'.$this->property('nofitication') => $this->renderPartial('@success', [
				'props' => $this->getProperties(), 
				'lang'  => Lang::get('netsti.connections::lang')
			])
		];
	}
}
?>