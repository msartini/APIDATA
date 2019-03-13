<?php

namespace App\Http\Controllers;

use App\Repositories\JobRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $repository;
    /**
     * Construct que recebe as injeções de dependências.
     *
     * @return void
     */
    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Recebe os request e chama o repository para realizar os filtros.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $cities = $this->repository->getCities();
        $jobs = $this->repository->all($request->all());
        return view('home', ['jobs' => $jobs->all(), 'cities' => $cities]);
    }
}
