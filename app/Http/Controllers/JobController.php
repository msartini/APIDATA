<?php

namespace App\Http\Controllers;

use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class JobController extends Controller
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
     * Método principal, recebe parâmetros do usuário.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse;
     */
    public function index(Request $request)
    {
        $jobs = $this->repository->all($request->all());

        return response()->json($this->indexJson($jobs));
    }

    /**
     * Cria a estrutura json para resposta
     * @param Collection $jobs
     * @return \Illuminate\Support\Collection
     */
    public function indexJson(Collection $jobs)
    {
        $colect = new Collection();
        foreach ($jobs as $item) {
            $colect->push($item);
        }

        return  new Collection(['jobs' => $colect]);
    }
}
