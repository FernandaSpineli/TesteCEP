<?php

namespace App\Repositories;

use stdClass;
use App\DTO\CreateAddressDTO;


interface AddressRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): PaginationInterface;
    public function findOne(string $cep): stdClass|null;
    public function new(CreateAddressDTO $dto): stdClass;
    public function getAll(): array;
    public function buildCep(string $cep): string;
    public function update(CreateAddressDTO $dto);
}