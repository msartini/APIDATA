<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Repositório para Vagas. (Busca de vagas)
 */
class JobRepository
{
    private $data = '';
    private $file = 'vagas';
    private $model;

    /**
     * Construct atribui passa os dados para a model.
     */
    public function __construct()
    {
        $this->data = $this->getResource(sprintf('%s.json', $this->file));
        $this->model = $this->getModel();
    }

    /**
     * Método busca todos os registros que atenda ao filtro, todos serão passados, caso nada seha informado.
     * @param array $filter
     * @return \Illuminate\Support\Collection
     */
    public function all($filter = [])
    {
        $result = $this->applyFilter($filter);

        return $result;
    }
	
    /**
     * Chama a model com os dados populados.
     * @return \Illuminate\Support\Collection
     */
    private function getModel()
    {
        $data = json_decode($this->data);
        $this->model = new Collection($data->docs);

        return $this->model;
    }


    /**
     * Busca a coleção de dados
     * @param unknown $file
     * @return string
     */
    public function getResource($file)
    {
        return file_get_contents(
            sprintf(
                '%s/%s/%s',
                app()->basePath(),
                'data',
                $file
            )
        );
    }

    /**
     * Retorna uma coleçao de dados de cidades.
     * @return \Illuminate\Support\Collection
     */
    public function getCities()
    {
        $cities = new Collection();
        $collection = $this->model->each(function ($item, $key) use ($cities) {
            $cities->push(array_first($item->cidade));
        });

        return $cities->sort()->unique()->values();
    }

    /**
     * Aplica o filtro de pesquisa de dados na Model.
     * @param array $filter
     * @return \Illuminate\Support\Collection
     */
    public function applyFilter($filter = [])
    {
        $filtered = $this->model->filter(function ($value) use ($filter) {
            $textSearch = array_get($filter, 'q');
            $textSearch = strtolower($textSearch);
            
            $city = array_get($filter, 'cidade');


            if ($textSearch) {
                if (strpos(strtolower($value->title), $textSearch) ||
                        strtolower($value->title) == $textSearch ||
                        strpos(strtolower($value->description), $textSearch) ||
                        strtolower($value->description) == $textSearch) {
                    return true;
                }
                
                if ($city) {
	                	if (in_array($city, $value->cidade)) {
	                		return true;
	                	}
	                
	                	return;
                }
				
                return;
            }

            if ($city) {
                if (in_array($city, $value->cidade)) {
                    return true;
                }

                return;
            }

            return true;
        });

        $sortBySalary = array_get($filter, 'sort_salary');

        /*
         * Ordena se usuário informação alguma ordenação.
         */
        if ($sortBySalary) {
            if ($sortBySalary == 'desc') {
                $filtered = $filtered->sortByDesc('salario');
            } else {
                $filtered = $filtered->sortBy('salario');
            }
        }

        return $filtered;
    }
}
