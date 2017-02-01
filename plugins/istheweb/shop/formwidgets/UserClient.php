<?php namespace Istheweb\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Istheweb\Shop\Models\Customer;
use October\Rain\Auth\Models\User;
use Flash;

/**
 * UserClient Form Widget
 */
class UserClient extends FormWidgetBase
{
    use \Backend\Traits\FormModelWidget;

    /**
     * @var string Field name to use for key.
     */
    public $keyFrom = 'id';

    /**
     * @var string Relation column to display for the name
     */
    public $nameFrom;

    /**
     * @var string Relation column to display for the description
     */
    public $descriptionFrom;

    /**
     * @var string Text to display for the title of the popup list form
     */
    public $title = 'backend::lang.userfinder.find_record';

    /**
     * @var string Prompt to display if no record is selected.
     */
    public $prompt = 'Click the %s button to find a record';

    /**
     * @var int Maximum rows to display for each page.
     */
    public $recordsPerPage = 10;

    /**
     * @var string Use a custom scope method for the list query.
     */
    public $scope;

    /**
     * @var string Filters the relation using a raw where query statement.
     */
    public $conditions;

    /**
     * @var string If searching the records, specifies a policy to use.
     * - all: result must contain all words
     * - any: result can contain any word
     * - exact: result must contain the exact phrase
     */
    public $searchMode;

    /**
     * @var string Use a custom scope method for performing searches.
     */
    public $searchScope;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'istheweb_shop_user_client';

    /**
     * @var Model Relationship model
     */
    public $relationModel;

    /**
     * @var \Backend\Classes\WidgetBase Reference to the widget used for viewing (list or form).
     */
    protected $listWidget;

    /**
     * @var \Backend\Classes\WidgetBase Reference to the widget used for searching.
     */
    protected $searchWidget;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig([
            'title',
            'prompt',
            'keyFrom',
            'nameFrom',
            'descriptionFrom',
            'scope',
            'conditions',
            'searchMode',
            'searchScope',
            'recordsPerPage',
        ]);

        if (post('userfinder_flag')) {
            $this->listWidget = $this->makeListWidget();
            $this->listWidget->bindToController();

            $this->searchWidget = $this->makeSearchWidget();
            $this->searchWidget->bindToController();

            $this->listWidget->setSearchTerm($this->searchWidget->getActiveTerm());

            /*
             * Link the Search Widget to the List Widget
             */
            $this->searchWidget->bindEvent('search.submit', function () {
                $this->listWidget->setSearchTerm($this->searchWidget->getActiveTerm());
                return $this->listWidget->onRefresh();
            });
        }

    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('container');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {

        if($this->model->user){
            if($this->model->user->exists){
                $this->relationModel = $this->model->user;
                $this->vars['user'] = $this->relationModel;
            }
        }

        $this->vars['value'] = $this->getKeyValue();
        $this->vars['field'] = $this->formField;
        $this->vars['nameValue'] = $this->getNameValue();
        $this->vars['descriptionValue'] = $this->getDescriptionValue();
        $this->vars['listWidget'] = $this->listWidget;
        $this->vars['searchWidget'] = $this->searchWidget;

        $this->vars['title'] = $this->title;
        $this->vars['prompt'] = str_replace('%s', '<i class="icon-th-list"></i>', e(trans($this->prompt)));

        if(isset($this->relationModel)){

        }
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/userclient.css', 'Istheweb.Shop');
        $this->addJs('js/userclient.js', 'Istheweb.Shop');

    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {

        return $value;
    }


    public function onFindRecord()
    {
        $this->prepareVars();

        /*
         * Purge the search term stored in session
         */
        if ($this->searchWidget) {
            $this->listWidget->setSearchTerm(null);
            $this->searchWidget->setActiveTerm(null);
        }

        return $this->makePartial('userfinder_form');
    }

    public function onCreateRecord()
    {
        $postUser = post('Customer[user]');
        if(strlen($postUser) > 0){
            $this->relationModel = User::find(post('Customer[user]'))->first();
        }else{
            $this->relationModel = null;
        }
        $this->prepareVars();

        if ($this->searchWidget) {
            $this->listWidget->setSearchTerm(null);
            $this->searchWidget->setActiveTerm(null);
        }

        return $this->makePartial('usercreate_form');
    }

    public function onSaveUser()
    {
        $customer = post('Customer');
        if(array_key_exists('send_invite', post())){
            $send_email = 1;
        }else{
            $send_email = 0;
        }

        $data = [
            'name' => $customer['User']['name'],
            'surname' => $customer['User']['surname'],
            'email' => $customer['User']['email'],
            'password' => $customer['User']['password'],
            'password_confirmation' => $customer['User']['password_confirmation'],
            'send_invite' => $send_email,
        ];

        $user = Customer::createUser($data);

        if($user){
            Flash::success('El usuario se ha creado correctamente');
            $error = 0;
            $this->relationModel = $user;
            $this->prepareVars();
            return ['#'.$this->getId('container') => $this->makePartial('userfinder')];
        }else{
            Flash::error('Hemos tenido problemas creando el usuario');
            $error = 1;
        }

        return $error;

    }

    public function onRefresh()
    {
        $user = User::find(post($this->formField->getName()))->first();
        $this->relationModel = $user;

        $this->prepareVars();
        return ['#'.$this->getId('container') => $this->makePartial('userfinder')];
    }

    public function getKeyValue()
    {
        if (!$this->relationModel) {

            return null;
        }
        return $this->relationModel->{$this->keyFrom};
    }

    public function getNameValue()
    {
        if (!$this->relationModel || !$this->nameFrom) {
            return null;
        }

        return $this->relationModel->name . " " . $this->relationModel->surname;
    }

    public function getDescriptionValue()
    {
        if (!$this->relationModel || !$this->descriptionFrom) {
            return null;
        }

        return $this->relationModel->{$this->descriptionFrom};
    }

    protected function makeListWidget()
    {
        $config = $this->makeConfig($this->getConfig('list'));
        $config->model = $this->getRelationModel();
        $config->alias = $this->alias . 'List';
        $config->showSetup = false;
        $config->showCheckboxes = false;
        $config->recordsPerPage = $this->recordsPerPage;
        $config->recordOnClick = sprintf("$('#%s').userFinder('updateRecord', this, ':" . $this->keyFrom . "')", $this->getId());
        $widget = $this->makeWidget('Backend\Widgets\Lists', $config);

        $widget->setSearchOptions([
            'mode' => $this->searchMode,
            'scope' => $this->searchScope,
        ]);

        if ($sqlConditions = $this->conditions) {
            $widget->bindEvent('list.extendQueryBefore', function($query) use ($sqlConditions) {
                $query->whereRaw($sqlConditions);
            });
        }
        elseif ($scopeMethod = $this->scope) {
            $widget->bindEvent('list.extendQueryBefore', function($query) use ($scopeMethod) {
                $query->$scopeMethod($this->model);
            });
        }
        else {
            $widget->bindEvent('list.extendQueryBefore', function($query) {
                $this->getRelationObject()->addDefinedConstraintsToQuery($query);
            });
        }

        return $widget;
    }

    protected function makeSearchWidget()
    {
        $config = $this->makeConfig();
        $config->alias = $this->alias . 'Search';
        $config->growable = false;
        $config->prompt = 'backend::lang.list.search_prompt';
        $widget = $this->makeWidget('Backend\Widgets\Search', $config);
        $widget->cssClasses[] = 'userfinder-search';
        return $widget;
    }

}
