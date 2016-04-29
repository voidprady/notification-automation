<?php namespace App\Validators;

use App\Services\LaravelValidator;

class AddressValidator extends LaravelValidator {

    public static $rules = array(
        'name'      => 'sometimes|required|string|max:50',
        'email'     => 'sometimes|required|string|max:50',
        'address_1' => 'sometimes|required|string|max:100',
        'address_2' => 'sometimes|required|string|max:100',
        'mobile'    => 'required|integer',
        'city'      => 'sometimes|required|string|max:50',
        'state'     => 'sometimes|required|string|max:50', 
        'pincode'   => 'sometimes|required|integer'
    );

    

}