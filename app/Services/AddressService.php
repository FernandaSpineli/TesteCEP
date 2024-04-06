<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
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
            $body = $this->callViaCep($cep);
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

    public function callViaCep(string $cep) 
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get("https://viacep.com.br/ws/{$cep}/json/");
        $response = $request->getBody();
        return json_decode($response, true);
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

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function updateAddresses()
    {

        $addresses = $this->getAll();

        for ($i=0; $i < count($addresses); $i++) { 
            $localAddress = $addresses[$i];
            $viaCepAddress = $this->callViaCep($localAddress['cep']);
            
            $addressChanged = $this->hasChange($localAddress, $viaCepAddress);

            if ($addressChanged) {
                $this->update(new CreateAddressDTO(
                    $viaCepAddress['cep'], 
                    $viaCepAddress['logradouro'],
                    $viaCepAddress['complemento'],
                    $viaCepAddress['bairro'],
                    $viaCepAddress['localidade'],
                    $viaCepAddress['uf'],
                    $viaCepAddress['ddd'])
                );
            }
        }
    }

    public function update(CreateAddressDTO $dto)
    {
        $this->repository->update($dto);
    }

    public function hasChange($localAddress, $viaCepAddress) {
        $hasChange = ($localAddress['cep'] == $viaCepAddress['cep']) ? false : true;
        if ($hasChange) return true;

        $hasChange = ($localAddress['logradouro'] == $viaCepAddress['logradouro']) ? false : true;
        if ($hasChange) return true;

        $hasChange = ($localAddress['complemento'] == $viaCepAddress['complemento']) ? false : true;
        if ($hasChange) return true;

        $hasChange = ($localAddress['bairro'] == $viaCepAddress['bairro']) ? false : true;
        if ($hasChange) return true;

        $hasChange = ($localAddress['localidade'] == $viaCepAddress['localidade']) ? false : true;
        if ($hasChange) return true;

        $hasChange = ($localAddress['uf'] == $viaCepAddress['uf']) ? false : true;
        if ($hasChange) return true;

        $hasChange = ($localAddress['ddd'] == $viaCepAddress['ddd']) ? false : true;
        if ($hasChange) return true;

        return false;

    }

}

?>
