<?php

namespace App\Repositories;

use App\DTO\{CreateSupportDTO};
use App\DTO\{UpdateSupportDTO};
use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportEloquentORM implements \App\Repositories\SupportRepositoryInterface
{
    public function __construct(
        protected \App\Models\Support $model
    ){}

    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null,
    ): PaginationInterface
    {
        $query = $this->model->query();

        if ($filter) {
            $query->where('subject', $filter)
                ->orWhere('body', 'like', "%{$filter}%");
        }

        $result = $query->paginate($totalPerPage, ['*'], $page);

        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array
    {
        $query = $this->model->query();

        if ($filter) {
            $query->where('subject', $filter)
                ->orWhere('body', 'like', "%{$filter}%");
        }

        return $query->get()->toArray();
    }

    public function findOne(string $id): stdClass|null
    {
        $support = $this->model->find($id);
        if(!$support){
            return null;
        }

        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function new(CreateSupportDTO $dto): stdClass
    {
        $support = $this->model->create(
            (array) $dto
        );

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        if(!$support = $this->model->find($dto->id)){
            return null;
        }

        $support->update(
            (array) $dto
        );

        return (object) $support->toArray();
    }
}
