<?php

namespace App\Repositories\Field;

use App\Models\Field;
use App\Repositories\Repository;

class FieldRepository extends Repository implements FieldRepositoryInterface
{
    public function getModel()
    {
        return Field::class;
    }

    public function searchByName($keyword)
    {
        return Field::select('name')
            ->where('name', 'like', "%{$keyword}%")->get();
    }
}
