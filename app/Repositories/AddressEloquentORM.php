<?php

namespace App\Repositories;

use stdClass;
use App\Models\Address;
use App\DTO\CreateAddressDTO;
use App\Repositories\PaginationInterface;

class AddressEloquentORM implements AddressRepositoryInterface
{

    public function __construct(protected Address $model)
    { }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): PaginationInterface
    {
        $result =  $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('localidade', $filter);
                            $query->orWhere('bairro', 'like', "{%$filter%}");
                            $query->orWhere('logradouro', 'like', "{%$filter%}");
                        }
                    })
                    ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    public function findOne(string $cep): stdClass|null
    {
        $newCep = $this->buildCep($cep);
        $address = $this->model->where('cep', $newCep)->first();
        if(!$address){
            return $address;
        }
        
        return (object) $address->toArray();
    }

    public function new(CreateAddressDTO $dto): stdClass
    {
        $address = $this->model->create( (array) $dto);

        return (object) $address->toArray();
    }

    public function getAll(): array
    {
        return $this->model
                    ->get()
                    ->toArray();
    }

    public function buildCep(string $cep): string
    {
        $part1 = substr($cep, 0, 5); 
        $part2 = substr($cep, 5);    
        $newCep = $part1 . '-' . $part2;
        return $newCep;
    }

    public function update(CreateAddressDTO $dto)
    {
        $address = $this->model->where('cep', $dto->cep)->first();
        if ($address == null) {
            return null;
        }
        $address->update( (array) $dto);
    }
}