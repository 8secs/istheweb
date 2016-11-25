<?php namespace Istheweb\Corporate\Components;

use Cms\Classes\ComponentBase;
use Istheweb\Corporate\Models\Company as Settings;
use Istheweb\Corporate\Models\Employee;
use October\Rain\Database\Model;

class Company extends ComponentBase
{
    public $company;

    public function componentDetails()
    {
        return [
            'name'        => 'istheweb.corporate::lang.components.company.name',
            'description' => 'istheweb.corporate::lang.components.company.description',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $settings = Settings::instance();
        $company = new Model();
        $company->name = $settings->name;
        $company->slogan = $settings->slogan;
        $company->logo = $settings->logo;
        $company->story = $settings->story;
        $company->contact = $this->contact();

        $company->facebook = $settings->facebook;
        $company->google = $settings->googleplus;
        $company->twitter = $settings->twitter;
        $company->email = $settings->email;

        $company->phone = $settings->phone;
        $company->open = $settings->open;

        $company->address = $settings->address;
        $company->state = $settings->state;
        $company->country = $settings->country;
        $company->cp = $settings->cp;
        $company->city = $settings->city;

        $this->company = $this->page['company'] = $company;
    }

    public function contact()
    {
        if ($employee = Employee::find(Settings::get('contact'))) {
            return $employee;
        }
        return Employee::orderBy('id', 'asc')->first();
    }

}