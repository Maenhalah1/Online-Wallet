<?php

namespace App\Http\Controllers\Web\Admin;

use App\Repositories\DashboardRepository;

class DashboardController
{
    protected DashboardRepository $repository;
    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $data = $this->repository->indexPage();
        return view("admin.dashboard.index", $data);
    }

}
