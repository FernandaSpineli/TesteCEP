<?php 

namespace App\Repositories;

use stdClass;
use App\DTO\{CreateSupportDTO, UpdateSupportDTO};

interface SupportRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function new(CreateSupportDTO $dto): stdClass;
    public function update(UpdateSupportDTO $dto): stdClass|null;
    public function delete(string|int $id): void;
}
?>