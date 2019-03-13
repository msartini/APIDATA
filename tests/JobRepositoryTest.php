<?php

use App\Repositories\JobRepository as Repository;

class JobRepositoyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testSortSalaryAsc()
    {
        $repository = new Repository();
        dd($repository->getCities());

        $result = $repository->all(['sort_salary' => 'asc']);

        $this->assertInstanceOf('stdClass', array_first($result));
    }



}
