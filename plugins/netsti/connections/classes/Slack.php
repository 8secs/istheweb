<?php namespace NetSTI\Connections\Classes;

use Lang;
use Backend;
use NetSTI\Connections\Models\SlackSettings;

class Slack{

	public static function set($message) {
		if(SlackSettings::get('on') == 1){
			$data = "payload=" . json_encode(array(
				"text"		=> $message,
				"username"	=> SlackSettings::get('bot'),
				"channel"	=> SlackSettings::get('channel')
			));

			$ch = curl_init(SlackSettings::get('hock'));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			return $result;
		}
	}

	public static function push($title, $fields, $url, $icon, $model) {
		if(SlackSettings::get('on') == 1){
			$text = Lang::get($title)."\n";
			$text .= ">>>";
			foreach ($fields as $key => $value) {
				$text .= "*".Lang::get('netsti.connections::lang.fields.'.$key)."*\n$value\n\n";
			}
			$text .= "\n... <".Backend::url($url)."|".Lang::get('netsti.connections::lang.fields.more').">";

			$data = "payload=" . json_encode(array(
				"text"			=> $text,
				"username"		=> SlackSettings::get('bot')." - ".Lang::get($model),
				"channel"		=> SlackSettings::get('channel'),
				"icon_emoji"	=> $icon
			));

			$ch = curl_init(SlackSettings::get('hock'));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			return $result;
		}
	}

}