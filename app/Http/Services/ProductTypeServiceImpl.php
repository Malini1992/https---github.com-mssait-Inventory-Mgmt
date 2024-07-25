<?php

namespace App\Http\Services;

use App\Http\Interfaces\ProductTypeService;
use App\Http\Repositories\ProductTypeRepository;


class ProductTypeServiceImpl implements ProductTypeService
{
    protected $ProductTypeRepository;

    public function __construct(ProductTypeRepository $ProductTypeRepository)
    {
        $this->ProductTypeRepository = $ProductTypeRepository;
    }

    public function all()
    {
        try {
            return $this->ProductTypeRepository->all();
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
            return $this->ProductTypeRepository->create($data);
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
            return $this->ProductTypeRepository->find($id);
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
            return $this->ProductTypeRepository->save($data, $id);
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
            return $this->ProductTypeRepository->destroy($id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }


}
