<?php namespace Istheweb\Corporate\Controllers;

use Backend\Facades\BackendAuth;
use Backend\Models\User;
use Backend\Models\UserGroup;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Empleados Back-end Controller
 */
class Empleados extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Corporate', 'corporate', 'empleados');
    }

    /**
     * Called before the creation form is saved.
     * @param Model
     */
    public function formBeforeCreate( $model )
    {
        dd(post());
        $user = post('Empleado')['user'];
        $model->user = User::create([
            'login'                  => $user['login'],
            'email'                 => $user['email'],
            'first_name'            => $user['first_name'],
            'last_name'             => $user['last_name'],
            'password'              => $user['password'],
            'password_confirmation' => $user['password_confirmation'],
            'permissions'           => [],
            'is_superuser'          => false,
            'is_activated'          => true
        ]);
        $connect = UserGroup::whereCode('connect')->first();
        $model->user->addGroup($connect);
    }
}