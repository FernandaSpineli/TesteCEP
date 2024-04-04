<?php

namespace App\Services;

use stdClass;
use App\DTO\CreateAddressDTO;
use App\Repositories\AddressRepositoryInterface;


class AddressService
{

    public function __construct(
        protected AddressRepositoryInterface $repository
    ) { }


    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null)
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
            dd($address);
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

}

?>