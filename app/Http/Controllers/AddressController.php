<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Gateways\AddressGateway;
use Request;
use App\Http\Requests;

class AddressController extends Controller
{
    public function __construct(AddressGateway $addressGateway)
    {
        $this->addressGateway = $addressGateway;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = Request::json()->all();
        $errors = $this->addressGateway->validateInput($input);
        if(!empty($errors)){
            return [
                'status' => 'FAIL',
                'message' => [$errors]
            ];
        }
        $data = $this->addressGateway->createAddress($input);

        if($data !=0){
            return [
                'status' => 'SUCCESS',
                'message' => 'Please check your inbox for confimation.'
            ];
        }else{
            return [
                'status' => 'FAIL',
                'message' => 'There is already an account with these details.'
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
