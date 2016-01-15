<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 08/01/2016
 * Time: 11:34 PM
 */

namespace App;


use App\CacheManager;
use App\DataAccessLayer;
use Illuminate\Support\Facades\Cache;

class LookupManager
{

    protected $dataAccess;
    protected $cacheManager;

    /**
     * LookupManager constructor.
     */
    public function __construct(DataAccessLayer $dataAccess, CacheManager $cacheManager)
    {
        $this->dataAccess = $dataAccess;
        $this->cacheManager = $cacheManager;
    }

    public function getCountries()
    {
        $countries = $this->cacheManager->getItem(env('CACHE_DRIVER'), 'countries');

        if($countries == null)
        {
            $countries = $this->dataAccess->getAllCountries();
            $this->cacheManager->setItem(env('CACHE_DRIVER'), 'countries', $countries, 10);
        }

        return $countries;
    }

    public function getStateProvincesForCountry($countryId)
    {
        $key = 'stateprovince-' . $countryId;

        $stateProvinces = Cache::remember($key, 5, function() use ($countryId)
        {
            return $this->dataAccess->getStateProvincesForCountry($countryId);
        });

        return $stateProvinces;

    }

    public function getProductAllergens()
    {
        $allergens = $this->cacheManager->getItem(env('CACHE_DRIVER'), 'allergens');

        if($allergens == null)
        {
            $allergens = $this->dataAccess->getAllAllergens();
            $this->cacheManager->setItem(env('CACHE_DRIVER'), 'allergens', $allergens, 10);
        }

        return $allergens;
    }

    public function getFoodCategoriesForParent($parentId = null)
    {
        $key = 'foodcats-' . (isset($parentId) ? $parentId : 'root');

        $categories = $this->cacheManager->getItem(env('CACHE_DRIVER'), $key);
        if($categories == null)
        {
            $categories = $this->dataAccess->getFoodCategoriesForParent(true, $parentId, ['id', 'name', 'parent_id']);
            $this->cacheManager->setItem(env('CACHE_DRIVER'), $key, $categories, 10);
        }

        return $categories;
    }

}