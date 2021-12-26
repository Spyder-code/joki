<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryService extends Repository
{
    public $requestService;

    public function __construct()
    {
        $this->requestService = new Category;
    }

    public function all()
    {
        return $this->requestService->all();
    }
}
