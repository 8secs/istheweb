<?php namespace NetSTI\Connections\Components;

// CLASSES
use Lang;
use Validator;
use ValidationException;
use NetSTI\Connections\Models\Subscriber;
use NetSTI\Connections\Classes\MailHelper;

class SubscribeComponent extends \Cms\Classes\ComponentBase{

	public $props;
	public $fields;

	public function componentDetails(){
		return [
			'name'        => 'Subscribe Form',
			'description' => 'Add Subscribe Form Integration.'
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
			'submitClass' => [
				'title'             => 'Submit Class',
				'type'              => 'string',
				'default'           => 'btn btn-primary',
				'group'             => 'Form Options',
				'showExternalParam' => false,
			],
			'ifInline' => [
				'title'             => 'Inline Form',
				'type'              => 'checkbox',
				'group'             => 'Form Options',
				'showExternalParam' => false,
				'default'           => true
			],
			'style' => [
				'title'             => 'Form Style',
				'type'              => 'dropdown',
				'showExternalParam' => false,
				'group'             => 'Form Options',
				'default'           => "all",
				'options' => [
					"all"        => "Name and Email",
					"email"      => "Only Email",
					"emailgroup" => "Email in input group"
				]
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

	public function onSubscribeForm(){
		$data = post();
		$mailHelper = new MailHelper();

		$rules = [
			'name'  => 'between:2,100',
			'email' => ['required','email','unique:netsti_connections_subscribers']
		];

		$validation = Validator::make($data, $rules);
		if ($validation->fails()) {
			return [
				'#flash' => $this->renderPartial('@error-alert', [
					'messages' => $validation->messages(),
					'props'    => $this->props
				])
			];
		}

		Subscriber::create($data);

		if($this->property('sendReply'))
			$mailHelper->sendSubscribeReplyMail($data['email']);

		return [
			'#subscribe-form-render' => $this->renderPartial('@success', [
				'props' => $this->getProperties(), 
				'lang'  => Lang::get('netsti.connections::lang')
			])
		];
	}
}
?>