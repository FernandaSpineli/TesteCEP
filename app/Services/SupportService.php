<?php 

namespace App\Services;

use stdClass;
use App\DTO\{CreateSupportDTO, UpdateSupportDTO};
use App\Repositories\SupportRepositoryInterface;

class SupportService
{
    public function __construct(
        protected SupportRepositoryInterface $repository
    ) { }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null)
    {
        return $this->repository->paginate(page: $page, totalPerPage: $totalPerPage, filter: $filter);
    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string|int $id): void
    {
        $this->repository->delete($id);
    }
}
?>