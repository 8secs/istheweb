<?php namespace NetSTI\Connections\Models;

use \DrewM\MailChimp\MailChimp;
use October\Rain\Database\Model as BaseModel;

class MailSettings extends BaseModel{

	public $implement = ['System.Behaviors.SettingsModel', 'RainLab.Translate.Behaviors.TranslatableModel'];

	public $translatable = ['footer','inbox','subscriptor','inbox_subject','subscriptor_subject'];

	public $settingsCode = 'netsti_mail_settings';

	public $settingsFields = 'fields.yaml';

	public $attachOne = [];

	public function getMailchimpListOptions(){
		if(strlen($this->api_key) >= 32){
			$chimp = new MailChimp($this->api_key);
			$result = $chimp->get('lists');
			$list = array();

			if(!$result)
				return [];
			
			foreach ($result['lists'] as $value)
				$list[$value['id']] = $value['name'];

			return $list;
		}else{
			return [];
		}
	}
}
