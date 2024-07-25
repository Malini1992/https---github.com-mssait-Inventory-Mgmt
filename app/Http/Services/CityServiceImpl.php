<?php
namespace App\Http\Services;
use App\Http\Interfaces\CityService;
use App\Http\Repositories\CityRepository;


class CityServiceImpl implements CityService
{
    protected $CityRepository;

    public function __construct(CityRepository $CityRepository)
    {
        $this->CityRepository = $CityRepository;
    }

	
	public function all()
    {
		try {
           return $this->CityRepository->all();
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
           return $this->CityRepository->find($id);
        } catch (CustomException $e) {
            throw $e; 
        } catch (\Exception $e) {
            throw $e;
        }
    }
	
	 public function getcities($stateId)
    {
		try {
            if (!$stateId) {
                throw new CustomException('Id not provided');
            }
           return $this->CityRepository->getcities($stateId);
        } catch (CustomException $e) {
            throw $e; 
        } catch (\Exception $e) {
            throw $e;
        }
    }
   
}
