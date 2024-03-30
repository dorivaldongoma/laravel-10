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

    public function getAll(string $filter = null): array
    {
        /* 1 - $this->model->all()->toArray();
           2 - return $this->model
            ->where(function ($query) use ($filter){
                if($filter){
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->get()
            ->toArray(); */

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
