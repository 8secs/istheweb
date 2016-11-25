<?php namespace Istheweb\Faq\Components;

use Cms\Classes\ComponentBase;
use Istheweb\Faq\Models\Question;

class Featured extends ComponentBase
{

    public $faqsfeatured;

    public function componentDetails()
    {
        return [
            'name'        => 'FAQ Latest Questions',
            'description' => 'Displays featured questions links'
        ];
    }

    public function defineProperties()
    {
        return [
            'featuredNumber' => [
                'title'             => 'Number of Questions',
                'description'       => 'Show X Featured Questions',
                'default'           => 5,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Question Number property can contain only numeric symbols'
            ]
        ];
    }
    public function onRun()
    {
        $this->faqsfeatured = Question::whereIsApproved('1')
            ->whereIsFeatured('1')
            ->orderBy('id', 'desc')
            ->take($this->property['featuredNumber'])
            ->get();

    }

}