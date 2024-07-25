<?php
namespace App\Http\Services;

use App\Http\Interfaces\CountryService;
use App\Http\Repositories\CountryRepository;


class CountryServiceImpl implements CountryService
{
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }


    public function all()
    {
        try {
            return $this->countryRepository->all();
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
            return $this->countryRepository->find($id);
        } catch (CustomException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
