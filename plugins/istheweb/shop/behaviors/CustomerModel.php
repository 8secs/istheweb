<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 27/01/17
 * Time: 14:24
 */

namespace istheweb\shop\behaviors;


use Illuminate\Support\Str;
use Istheweb\Shop\Models\Address;
use Istheweb\Shop\Models\Customer;
use RainLab\User\Facades\Auth;
use System\Classes\ModelBehavior;

class CustomerModel extends ModelBehavior
{
    public function __construct($model)
    {
        return parent::__construct($model);
    }

    /**
     * Automatically creates a customer for a user if not one already.
     * @param  \RainLab\User\Models\User $user
     * @return \Istheweb\Shop\Models\Customer
     */
    public function getFromUser($user = null)
    {

        if ($user === null)
            $user = Auth::getUser();

        if (!$user)
            return;

        if (!$user->customer) {

            $customer = Customer::where('user_id', '=', $user->id)->first();

            if(!$customer){
                $generatedUsername = explode('@', $user->email);
                $generatedUsername = array_shift($generatedUsername);
                $generatedUsername = Str::limit($generatedUsername, 24, '') . $user->id;

                //$customer = new static;
                $customer = Customer::create([

                ]);
                /*$customer->user = $user;
                $customer->username = $generatedUsername;
                $customer->save();*/

                /**
                 * Check if necessary!!
                 */
                $customer->addresses = $this->getAddresses($customer->id);
                $user->customer = $customer;
            }else{
                $customer->addresses = $this->getAddresses($customer->id);
                $user->customer = $customer;
            }
        }else{
            $customer = $user->customer;
            $customer->addresses = $this->getAddresses($customer->id);

            $user->customer = $customer;
        }
        return $user->customer;
    }

    public function getAddresses($customer_id){
        $addresses = Address::where('customer_id', '=', $customer_id)->get();
        return $addresses;
    }
}