<?php

namespace App\Services;

use stdClass;
use App\DTO\CreateAddressDTO;
use App\Repositories\AddressRepositoryInterface;
use App\Repositories\PaginationInterface;

class AddressService
{

    public function __construct(
        protected AddressRepositoryInterface $repository
    ) { }


    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): PaginationInterface
    {
        return $this->repository->paginate(page: $page, totalPerPage: $totalPerPage, filter: $filter);
    }

    public function getOrCreate(string $cep): stdClass|null
    {
        $address = $this->getByCep($cep);

        if($address == null)
        {
            $client = new \GuzzleHttp\Client();
            $request = $client->get("https://viacep.com.br/ws/{$cep}/json/");
            $response = $request->getBody();
            $body = json_decode($response, true);
            $address = $this->new(new CreateAddressDTO(
                $body['cep'], 
                $body['logradouro'],
                $body['complemento'],
                $body['bairro'],
                $body['localidade'],
                $body['uf'],
                $body['ddd'])
            );
            return $address;
        }

        return $address;
    }

    public function getByCep(string $cep): stdClass|null
    {
        return $this->repository->findOne($cep);
    }

    public function validateCep(string $cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        if (strlen($cep) != 8) {
            return false;
        }
        return true;
    }

    public function new(CreateAddressDTO $dto): stdClass
    {
        return $this->repository->new($dto); 
    }

    public function updateAddresses()
    {

        $addressesPagineted = $this->paginate(
            page: 1,
            totalPerPage: 2,
            filter: null
        );
        /* $currentPage = $addressesPagineted->currentPage();
        $lastPage = $addressesPagineted->lastPage(); */
        $a = $addressesPagineted->currentPage();
        do {
            
            $addressesPagineted = $this->paginate(page: $a,
            totalPerPage: 2,
            filter: null);
            $a =+ 1;
        } while (!$addressesPagineted->isLastPage());
        dd($a);


        dd($addressesPagineted);
        // for ($i=0; $i < $page; $i++) { 
        //     if($addressesPagineted->isLastPage())
        //     {
        //        break;
        //     }
        // }
        
        // chamar o metodo paginate dentro de um for para mudar as paginas
        //dentro do for fazer outro for para acessar endereço por endereço
        // buscar no via cep o endereço 
        // outro for para analisar campo por campo comparando endereço do db e do via cep


    }

}

?>