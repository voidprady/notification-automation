<?php
namespace App\Gateways;

use \Event;
use App\Repositories\AddressRepository;
use App\Validators\AddressValidator;
use Mail;

class AddressGateway
{
    protected $addressRepository;

    public function __construct(    AddressRepository $addressRepository,
                                    AddressValidator $addressValidator){

        $this->addressRepository = $addressRepository;
        $this->addressValidator = $addressValidator;
    }

    public function createAddress(array $data){
        $addressId = $this->addressRepository->create($data);
        if($addressId){
            $this->mailUser($data);
        }

        return $addressId;
    }

    public function mailUser(array $data){
        Mail::send('mails.confirm', ['user' => $data['name']], function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Welcome to Finder');
        });
        return 1;
    }

    public function validateInput(array $data){
        $this->addressValidator->with($data);
        if (!$this->addressValidator->passes()) {
            $errors = $this->addressValidator->getErrors()->all();
            return $errors;
        }
    }  
}
?>