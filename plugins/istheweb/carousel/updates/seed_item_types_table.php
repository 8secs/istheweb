<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 31/05/16
 * Time: 18:36
 */

namespace Istheweb\Carousel\Updates;


use October\Rain\Database\Updates\Seeder;
use Istheweb\Carousel\Models\ItemType;

class SeedItemTypesTable extends Seeder
{
    public function up(){
        $text = new ItemType();
        $text->name = "Text";
        $text->description = "Text type";

        $text->save();

        $background = new ItemType();
        $background->name = "Background";
        $background->description = "Background Type";

        $background->save();

        $button = new ItemType();
        $button->name = "Button";
        $button->description = "Button Type";

        $button->save();

        $image = new ItemType();
        $image->name = "Image";
        $image->description = "Image Type";

        $image->save();
    }

}