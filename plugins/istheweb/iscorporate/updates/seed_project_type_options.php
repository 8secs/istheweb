<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 3/01/17
 * Time: 15:53
 */

namespace istheweb\iscorporate\updates;

use Carbon\Carbon;
use Istheweb\IsCorporate\Models\ProjectType;
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
        'Diseño Gráfico',
        'Diseño Web',
        'Posicionamiento',
        'Tienda Online',
        'Social Media',
        'Intranet',
        'Mantenimiento',
        'Personalizado'

    ];

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

    }
}