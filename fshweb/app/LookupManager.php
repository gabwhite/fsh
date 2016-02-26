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
            $this->cacheManager->setItem(env('CACHE_DRIVER'), 'countries', $countries, config('app.cache_expiry_time_countries'));
        }

        return $countries;
    }

    public function getStateProvincesForCountry($countryId)
    {
        $key = 'stateprovince-' . $countryId;

        $stateProvinces = Cache::remember($key, config('app.cache_expiry_time_stateprovinces'), function() use ($countryId)
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
            $this->cacheManager->setItem(env('CACHE_DRIVER'), 'allergens', $allergens, config('app.cache_expiry_time_allergens'));
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
            $this->cacheManager->setItem(env('CACHE_DRIVER'), $key, $categories, config('app.cache_expiry_time_categories'));
        }

        return $categories;
    }

    public function getUserTypes()
    {
        $userTypes = $this->cacheManager->getItem(env('CACHE_DRIVER'), 'usertypes');

        if($userTypes == null)
        {
            $userTypes = $this->dataAccess->getAllUserTypes();
            $this->cacheManager->setItem(env('CACHE_DRIVER'), 'usertypes', $userTypes, config('app.cache_expiry_time_usertypes'));
        }

        return $userTypes;
    }

}