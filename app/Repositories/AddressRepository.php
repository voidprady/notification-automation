<?php namespace App\Repositories;

use App\Repositories\AddressRepository;
use DB;

class AddressRepository {

    public function create(array $data){
        $isPresent = DB::table('address')
                    ->where('email', $data['email'])
                    ->orWhere('mobile', $data['mobile'])
                    ->select('id')
                    ->get();
       
        if(!$isPresent){
            $addressId = DB::table('address')
                        ->insertGetId($data);

            return $addressId;
        }
        else{
            $updated = $this->update($data);
            return $updated;
        }
    }

    private function update(array $data){
        $result = DB::table('address')
                    ->where('email', $data['email'])
                    ->orWhere('mobile', $data['mobile'])
                    ->update($data);

        return $result;
    }

    public function getByEmailId($id){
        $data = DB::table('address')
                    ->where('email', $id)
                    ->first();
        return $data;
    }
}