<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

use App\Http\Requests;

class AddressController extends Controller
{
    /**
     * Display a listing of all addresses on ElasticSearch & form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listAddresses', ['items' => Address::fetchAllFromElastic()]);
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'address' => 'required'
        ]);

        Address::create($request->except(['_token']));

        return redirect()->back();
    }
}
