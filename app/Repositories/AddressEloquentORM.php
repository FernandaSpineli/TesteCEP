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
        $address = $this->model->find($cep);
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
}