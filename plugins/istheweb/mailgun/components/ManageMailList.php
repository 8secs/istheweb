<?php namespace Istheweb\Mailgun\Components;

use Cms\Classes\ComponentBase;

use Illuminate\Support\Facades\Validator;
use Mailgun\Mailgun;
use October\Rain\Exception\ValidationException;
use System\Models\MailSetting;

class ManageMailList extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'istheweb.mailgun::lang.components.manage_mail_lists.name',
            'description' => 'istheweb.mailgun::lang.components.manage_mail_lists.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {

    }

    public function onSubscribe()
    {

        $rules = [
            'email' => 'required|email|min:2|max:64'
        ];

        $validation = Validator::make(post(), $rules);

        if($validation->fails()) {
            throw new ValidationException($validation);
        }

        $listAddress = 'newsletter@mg.istheweb.com';
        $mailSettings = MailSetting::instance();
        $mgClient = new Mailgun($mailSettings->mailgun_secret);

        $result = $mgClient->post("lists/$listAddress/members", array(
            'address'     => post('email'),
            'description' => 'Website subscription',
            'subscribed'  => true
        ));

        return $this->page['success'] = true;

    }
}