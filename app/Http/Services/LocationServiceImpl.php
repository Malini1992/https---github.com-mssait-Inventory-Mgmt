<?php

namespace App\Http\Services;

use App\Http\Interfaces\LocationService;
use App\Http\Repositories\LocationRepository;


class LocationServiceImpl implements LocationService
{
    protected $LocationRepository;

    public function __construct(LocationRepository $LocationRepository)
    {
        $this->LocationRepository = $LocationRepository;
    }

    public function all()
    {
        try {
            return $this->LocationRepository->all();
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
            return $this->LocationRepository->create($data);
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
            return $this->LocationRepository->find($id);
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
            return $this->LocationRepository->save($data, $id);
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
            return $this->LocationRepository->delete($id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }


}
