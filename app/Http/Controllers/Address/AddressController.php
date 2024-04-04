<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function __construct(
        protected AddressService $service
    ){ }

    
    public function getAll(Request $request)
    {
        $addresses = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 10),
            filter: $request->filter
        );

        return view('address/list', compact('addresses'));
    }

    public function getOrCreate(string $cep)
    {
        if($this->service->validateCep($cep))
        {
            $address = $this->service->getOrCreate($cep);

            return view('address/show', compact('$address'));
        }
    }

}
