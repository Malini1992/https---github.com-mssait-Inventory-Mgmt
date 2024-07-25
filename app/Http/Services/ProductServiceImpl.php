<?php

namespace App\Http\Services;

use App\Http\Interfaces\ProductService;
use App\Http\Repositories\ProductRepository;


class ProductServiceImpl implements ProductService
{
    protected $ProductRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function all()
    {
        try {
            return $this->ProductRepository->all();
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
            return $this->ProductRepository->create($data);
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
            return $this->ProductRepository->find($id);
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
            return $this->ProductRepository->save($data, $id);
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
            return $this->ProductRepository->delete($id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }


}
