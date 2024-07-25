<?php
namespace App\Http\Services;

use App\Http\Interfaces\StateService;
use App\Http\Repositories\StateRepository;


class StateServiceImpl implements StateService
{
    protected $StateRepository;

    public function __construct(StateRepository $StateRepository)
    {
        $this->StateRepository = $StateRepository;
    }


    public function all()
    {
        try {
            return $this->StateRepository->all();
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
            return $this->StateRepository->find($id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getstates($countryId)
    {
		try { 
            if (!$countryId) {
                throw new CustomException('Id not provided');
            }
           return $this->StateRepository->getstates($countryId);
        } catch (CustomException $e) {
            throw $e; 
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
