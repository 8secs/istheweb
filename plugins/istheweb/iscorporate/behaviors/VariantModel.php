<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 19/01/17
 * Time: 19:08
 */

namespace istheweb\iscorporate\behaviors;


use Istheweb\IsCorporate\Models\Variant;
use System\Classes\ModelBehavior;

class VariantModel extends ModelBehavior
{

    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function createVariant($project, $variant)
    {

        $variant = Variant::create([
            'projectable_id'        => $project->id,
            'projectable_type'      => get_class($project),
            'code'                  => $variant->code.'_project',
            'employee_id'              => $variant->employee->id,
            'name'                  => $variant->name,
            'price'                 => $variant->price,
            'plazo'                 => $variant->plazo,
            'horas'                 => $variant->horas,
            'available_on'          => $variant->available_on,
            'available_until'       => $variant->available_until,
            'pricing_calculator'    => $variant->pricing_calculator,
        ]);

        $options = $variant->optionsValues;
        $variant->save();
        foreach ($options as $option){
            $variant->optionsValues()->add($option);
        }
        return $variant;
    }

    public function getTotal($variants){
        $total = 0;
        foreach($variants as $variant){
            $total += $variant->price;
        }
        return $total;
    }

    public function formatVariants($variants){
        foreach($variants as $variant){
            $r['name'] = $variant->name;
            $r['price'] = $variant->price;
            $result[] = $r;

        }
        return $result;
    }
}