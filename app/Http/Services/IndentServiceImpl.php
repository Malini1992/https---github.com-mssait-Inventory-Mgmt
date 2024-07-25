<?php

namespace App\Http\Services;

use App\Http\Interfaces\IndentService;
use App\Http\Repositories\IndentRepository;


class IndentServiceImpl implements IndentService
{
    protected $IndentRepository;

    public function __construct(IndentRepository $IndentRepository)
    {
        $this->IndentRepository = $IndentRepository;
    }

    public function all()
    {
        try {
            return $this->IndentRepository->all();
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
            return $this->IndentRepository->create($data);
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
            return $this->IndentRepository->find($id);
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
            return $this->IndentRepository->save($data, $id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function getreturnstatus($status)
    {
		try { 
            if (!$status) {
                throw new CustomException('Id not provided');
            }
           return $this->IndentRepository->getreturnstatus($status);
        } catch (CustomException $e) {
            throw $e; 
        } catch (\Exception $e) {
            throw $e;
        }
    }



    public function getCustomerReturns($customerId,$status)
    {
		try { 
            if (!$customerId) {
                throw new CustomException('Id not provided');
            }
           return $this->IndentRepository->getCustomerReturns($customerId,$status);
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
            return $this->IndentRepository->delete($id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getReturnCustomers($status)
    {
		try { 
            if (!$status) {
                throw new CustomException('Id not provided');
            }
           return $this->IndentRepository->getReturnCustomers($status);
        } catch (CustomException $e) {
            throw $e; 
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateqty($data)
    {
		try { 
            if (!$data) {
                throw new CustomException('Id not provided');
            }
           return $this->IndentRepository->updateqty($data);
        } catch (CustomException $e) {
            throw $e; 
        } catch (\Exception $e) {
            throw $e;
        }
    }

   /* public function getCustomerReports()
    {
		try { 
           
           return $this->IndentRepository->getCustomerReports();
        } catch (CustomException $e) {
            throw $e; 
        } catch (\Exception $e) {
            throw $e;
        }
    }*/
}
