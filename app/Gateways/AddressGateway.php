<?php
namespace App\Gateways;

use \Event;
use App\Repositories\AddressRepository;
use Mail;

class AddressGateway
{
    protected $addressRepository;

    public function __construct(AddressRepository $addressRepository){
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(array $data){
        $addressId = $this->addressRepository->create($data);
        
        if($addressId){
            try {
                $this->mailUser($data);    
            } catch (Exception $e) {
                return [
                    'status' => 'FAIL',
                    'message' => 'Failed sending message.'
                ];
            }
        }
        return $addressId;
    }

    public function mailUser(array $data){
        $userDetails = $this->addressRepository->getByEmailId($data['email']);
        
        Mail::send('mails.confirm', ['user' => $userDetails->name], function ($message) use ($userDetails) {

            $message->to($userDetails->email, $userDetails->name)->subject('Welcome to Finder');
        });
        return $userDetails;
    }   
}
?>