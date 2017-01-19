<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 3/01/17
 * Time: 15:53
 */

namespace istheweb\iscorporate\updates;

use Backend\Models\User;
use Backend\Models\UserGroup;
use Carbon\Carbon;
use Istheweb\IsCorporate\Models\Employee;
use Istheweb\IsCorporate\Models\IssueStatus;
use Istheweb\IsCorporate\Models\IssueType;
use Istheweb\IsCorporate\Models\OptionValue;
use Istheweb\IsCorporate\Models\ProjectOption;
use Istheweb\IsCorporate\Models\ProjectType;
use Istheweb\IsCorporate\Models\Role;
use October\Rain\Database\Updates\Seeder;


class SeedProjectTypeOptions extends Seeder
{
    protected  $types = [
            'Actualizaciones',
            'Diseño web',
            'Formación',
            'Diseño Gráfico',
            'Posicionamiento',
            'Tienda Online',
            'Social Media',
            'Intranet',
            'Mantenimiento',
            'Personalizado'
        ];

    protected $options = [
        ['name' =>'Diseño Gráfico', 'code' => 'graphic_design'],
        ['name' =>'Diseño Web', 'code' => 'web_design'],
        ['name' =>'Posicionamiento', 'code' => 'seo'],
        ['name' =>'Tienda online', 'code' => 'ecommerce'],
        ['name' =>'Intranet', 'code' => 'back_office'],
        ['name' =>'Social Media', 'code' => 'social_media'],
        ['name' =>'Mantenimiento', 'code' => 'maintenance'],
        ['name' =>'Personalizado', 'code' => 'personalized'],

    ];

    protected $roles = [
        ['name' => 'Diseño gráfico', 'description' => 'Encargado de los servicios de diseño gráfico'],
        ['name' => 'Diseño web', 'description' => 'Encargado de los servicios de diseño web'],
        ['name' => 'SEO Manager', 'description' => 'Encargado de los servicios SEO '],
        ['name' => 'Desarrollador', 'description' => 'Encargado de los servicios de técnicos'],
        ['name' => 'Gerente', 'description' => 'Gerente de la empresa'],
        ['name' => 'Administración', 'description' => 'Administración de la empresa'],
    ];

    protected $values = [
        ['project_option' => '1', 'code' => 'logo_graphic_design', 'value' => 'Logo', 'price' => '150'],
        ['project_option' => '1', 'code' => 'dossier_graphic_design', 'value' => 'Dossier Corporativo', 'price' => '350'],
        ['project_option' => '2', 'code' => 'page_web_design', 'value' => 'Página web', 'price' => '700'],
        ['project_option' => '2', 'code' => 'personal_web_design', 'value' => 'Página personal', 'price' => '700'],
        ['project_option' => '2', 'code' => 'corporate_web_design', 'value' => 'Página corporativa', 'price' => '1500'],
        ['project_option' => '2', 'code' => 'portal_web_design', 'value' => 'Portal', 'price' => '2500'],
        ['project_option' => '4', 'code' => 'basic_ecommerce', 'value' => 'Tienda online básica', 'price' => '900'],
        ['project_option' => '4', 'code' => 'avanced_ecommerce', 'value' => 'Tienda online avanzada', 'price' => '1500'],
        ['project_option' => '4', 'code' => 'premium_ecommerce', 'value' => 'Tienda online premium', 'price' => '2500'],
        ['project_option' => '2', 'code' => 'blog_web_design', 'value' => 'Blog', 'price' => '500'],
        ['project_option' => '3', 'code' => 'posicionamiento_seo', 'value' => 'Posicionamiento', 'price' => '200'],
        ['project_option' => '3', 'code' => 'buscadores_seo', 'value' => 'Buscadores', 'price' => '200'],
        ['project_option' => '6', 'code' => 'basico_social_media', 'value' => 'Plan Social Media Básico', 'price' => '350'],
        ['project_option' => '6', 'code' => 'medio_social_media', 'value' => 'Plan Social Media Medio', 'price' => '450'],
        ['project_option' => '6', 'code' => 'avanzado_social_media', 'value' => 'Plan Social Media Avanzado', 'price' => '650'],
        ['project_option' => '6', 'code' => 'total_social_media', 'value' => 'Plan Social Media Total', 'price' => '750'],
        ['project_option' => '6', 'code' => 'otro_social_media', 'value' => 'Otros', 'price' => '450'],
        ['project_option' => '7', 'code' => 'dominio_mantenimiento', 'value' => 'Dominio', 'price' => '10'],
        ['project_option' => '7', 'code' => 'alojamiento_mantenimiento', 'value' => 'Alojamiento', 'price' => '200'],
        ['project_option' => '7', 'code' => 'soporte_mantenimiento', 'value' => 'Soporte', 'price' => '150'],
        ['project_option' => '8', 'code' => 'project_personalized', 'value' => 'Proyecto personalizado', 'price' => '500'],
    ];

    protected $statuses = ['Nuevo', 'En progreso', 'Solucionado', 'Pregunta'];



    public function run()
    {
        $i = 1;
        foreach ($this->types as $value){
            $pt = new ProjectType();
            $pt->name = $value;
            $pt->slug = strtolower($value);
            $pt->nest_left = $i;
            $i++;
            $pt->nest_right = $i;
            $i++;
            $pt->nest_depth = 0;
            $pt->created_at = Carbon::now();
            $pt->updated_at = Carbon::now();
            $pt->save();
        }

        foreach($this->options as $option){
            $op = ProjectOption::create($option);
            $op->created_at = Carbon::now();
            $op->updated_at = Carbon::now();
            $op->save;
        }

        foreach($this->roles as $role){
            $r = Role::create($role);
            $r->setCreatedAt(Carbon::now());
            $r->setUpdatedAt(Carbon::now());
            $r->save();
        }

        foreach($this->values as $value){
            $op = OptionValue::create($value);
            $op->created_at = Carbon::now();
            $op->updated_at = Carbon::now();
            $op->save;

        }

        foreach ($this->statuses as $status) {
            IssueStatus::create([
                'name' => $status
            ]);
        }

        IssueType::create([
            'name'        => 'Normal Issue',
            'description' => 'Report normal issue errors.'
        ]);

        IssueType::create([
            'name'        => 'Urgent issues',
            'description' => 'Report urgent issue errors.'
        ]);

        $users = User::all();
        $group = UserGroup::find(2);

        foreach($users as $user){
            if($user->inGroup($group)){
                $empleado = new Employee();
                $empleado->user = $user;
                $empleado->created_at = Carbon::now();
                $empleado->updated_at = Carbon::now();
                $empleado->save();
            }
        }

    }
}