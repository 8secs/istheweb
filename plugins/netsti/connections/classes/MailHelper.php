<?php namespace NetSTI\Connections\Classes;

use Mail;
use Lang;
use View;
use Twig;
use Backend;
use \DrewM\MailChimp\MailChimp;
use NetSTI\Connections\Models\MailSettings;
use NetSTI\Connections\Models\CompanySettings;

class MailHelper{
	use \System\Traits\ViewMaker;

	public function renderHeader(){
		return $this->makePartial('header', [
			'company' => CompanySettings::instance()
		]);
	}

	public function renderFooter(){
		return $this->makePartial('footer', [
			'company' => CompanySettings::instance(),
			'mail'    => MailSettings::instance()
		]);
	}

	public function sendContactFormMail($to, $data){
		$vars = [
			'header' => $this->renderHeader(),
			'footer' => $this->renderFooter(),
			'data'   => $data
		];

		Mail::send('netsti.connections::mail.contact-form', $vars, function($message) use ($to) {
			$message->to($to);
			$message->subject(Lang::get('netsti.connections::lang.new_contact'));
		});
	}

	public function sendContactReplyMail($to){
		$vars = [
			'header' => $this->renderHeader(),
			'footer' => $this->renderFooter(),
			'mail'   => MailSettings::instance()
		];

		Mail::send('netsti.connections::mail.contact-reply', $vars, function($message) use ($to) {
			$message->to($to);
			$message->subject(MailSettings::get('inbox_subject'));
		});
	}

	public function sendSubscribeReplyMail($to){
		$vars = [
			'header' => $this->renderHeader(),
			'footer' => $this->renderFooter(),
			'mail'   => MailSettings::instance()
		];

		Mail::send('netsti.connections::mail.subscribe-reply', $vars, function($message) use ($to) {
			$message->to($to);
			$message->subject(MailSettings::get('inbox_subject'));
		});

		if(MailSettings::get('mailchimp') && MailSettings::get('mailchimp_list')){
			$chimp   = new MailChimp(MailSettings::get('api_key'));
			$list_id = MailSettings::get('mailchimp_list');
			$result  = $chimp->post("lists/$list_id/members", [
				'email_address' => $to,
				'status' => 'subscribed',
			]);
		}
	}
}
 
 ?>