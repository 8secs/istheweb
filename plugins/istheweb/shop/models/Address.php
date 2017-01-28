<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use RainLab\Location\Models\Country;
use RainLab\Location\Models\State;

/**
 * Address Model
 */
class Address extends Base
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_addresses';

    /**
     * @var array Guarded fields
     */
    protected $rules = [
        'address_1' => 'required',
        'country'   => 'required',
        'state'     => 'required',
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'address_1',
        'address_2',
        'city',
        'postcode',
        'customer'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'customer'          => 'Istheweb\Shop\Models\Customer',
        'country'           => 'RainLab\Location\Models\Country',
        'state'             => 'RainLab\Location\Models\State',
    ];
    public $belongsToMany = [];

    public function getCountryOptions(){
        return Country::where('is_enabled', 1)->lists('name', 'id', 'code');
    }

    public function getCountriesOptions(){
        return Country::where('is_enabled', 1)->get();
    }

    public function getStateOptions()
    {
        if($this->country){
            $data = State::where('country_id', '=', $this->country->id)->lists('name', 'id', 'code');
        }else{
            $spain = Country::find(9);
            $data = State::where('country_id', '=', $spain->id)->lists('name', 'id', 'code');
        }

        return $data;
    }

}