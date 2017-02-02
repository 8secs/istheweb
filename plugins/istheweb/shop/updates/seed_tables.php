<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/02/17
 * Time: 19:03
 */

namespace istheweb\shop\updates;

use Istheweb\Shop\Controllers\TaxCategories;
use Istheweb\Shop\Models\Currency;
use Istheweb\Shop\Models\ShippingCategory;
use Istheweb\Shop\Models\ShippingMethod;
use Istheweb\Shop\Models\TaxCategory;
use Istheweb\Shop\Models\TaxRate;
use Istheweb\Shop\Models\Zone;
use October\Rain\Database\Updates\Seeder;
use RainLab\Location\Models\Country;


class SeedTables extends Seeder
{
    public function run()
    {
        Currency::create([
                'name' => 'Euro',
                'iso_code' => 'EUR',
                'iso_code_num' => 978,
                'sign' => '€',
                'format' => 2,
                'decimals' => 1,
                'conversion_rate' => 1.00,
                'active' => 1,
        ]);

        Currency::create([
            'name' => 'Dollar',
            'iso_code' => 'USD',
            'iso_code_num' => 840,
            'sign' => '$',
            'format' => 1,
            'decimals' => 1,
            'conversion_rate' => 1.00,
            'active' => 1,
        ]);


        $spain = Zone::create([
            'name' => 'España',
            'description' => 'Zona de las provincias de España exceptuando las islas, Ceuta y Melilla',
            'active' => 1,

        ]);
        $country = Country::where('code', 'ES')->first();
        $spain->countries()->add($country);

        $taxes_group = TaxCategory::create([
            'code' => 'clothing', 'name' => 'Ropa', 'description' => 'Grupo de impuestos aplicado a la ropa',
        ]);

        $clothing_tax_group = TaxCategory::whereCode('clothing')->first();
        $tax = TaxRate::create([
            'tax_category_id' => $clothing_tax_group->id,
            'zone_id' => $spain->id,
            'name' => 'ES - Ropa - 21%',
            'type' => 'P',
            'rate' => 21.00,
            'active' => 1,
        ]);

        $shipping = ShippingCategory::create([
            'name' => 'Envios nacionales ES',
            'code' => 'spanish_shipping',
            'description' => 'Grupo de envio para las provincias de España'
        ]);

        $shipping_method = ShippingMethod::create([
            'shipping_category_id' => $shipping->id,
            'tax_category_id' => $clothing_tax_group->id,
            'zone_id' => $spain->id,
            'code' => 'ups_spain',
            'name' => 'UPS - ES',
            'description' => 'Envio UPS a las provincias de la Península Ibérica',
            'calculator' => 'flat_rate',
            'amount' => 3.24,
            'category_requirement' => 1,
            'is_enabled' => 1

        ]);


    }

}