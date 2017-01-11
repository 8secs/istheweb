<?php namespace NetSTI\Connections\Models;

use October\Rain\Database\Model as BaseModel;

class SlackSettings extends BaseModel
{

	public $implement = ['System.Behaviors.SettingsModel'];

	public $settingsCode = 'netsti_slack_settings';

	public $settingsFields = 'fields.yaml';

	public $attachOne = [];
}
