<?php

namespace App\Repositories\Field;

use App\Repositories\RepositoryInterface;

interface FieldRepositoryInterface extends RepositoryInterface
{
    public function searchByName($keyword);
}
