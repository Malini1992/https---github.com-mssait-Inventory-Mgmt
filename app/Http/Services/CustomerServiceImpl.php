<?php

namespace App\Http\Services;

use App\Http\Interfaces\CustomerService;
use App\Http\Repositories\CustomerRepository;

class CustomerServiceImpl implements CustomerService
{
    protected $CustomerRepository;

    public function __construct(CustomerRepository $CustomerRepository)
    {
        $this->CustomerRepository = $CustomerRepository;
    }


    public function all()
    {
        try {
            return $this->CustomerRepository->all();
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

    }

     public function create($data)
    {
        try {
            if (!$data) {
                throw new CustomException('Data not provided');
            }
            return $this->CustomerRepository->create($data);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function find($id)
    {
        try {
            if (!$id) {
                throw new CustomException('Id not provided');
            }
            return $this->CustomerRepository->find($id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }


    public function update($data, $id)
    {
        try {
            if (!$data) {
                throw new CustomException('Data not provided');
            }
            if (!$id) {
                throw new CustomException('Id not provided');
            }
            return $this->CustomerRepository->save($data, $id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function delete($id)
    {
        try {
            if (!$id) {
                throw new CustomException('Id not provided');
            }
           return $this->CustomerRepository->destroy($id);         
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

