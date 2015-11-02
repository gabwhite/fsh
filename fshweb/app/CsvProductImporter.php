<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 01/11/2015
 * Time: 2:51 PM
 */

namespace App;

use Ramsey\Uuid\Uuid;
use League\Csv\Reader;

class CsvProductImporter implements iProductImporter
{

    public function doImport($data)
    {

        //$userProductImport = new UserProductImport();
        //$userProductImport->user_id = $data['user_id'];
        //$userProductImport->uuid = $data['uuid'];
        //$userProductImport->filename = $data['filename'];
        //$userProductImport->save();

        $fileContents = \Storage::get($data['uuid'] . '/' .  $data['filename']);
        $csv = Reader::createFromString($fileContents);
        $csv->setDelimiter(',');
        if($data['include_headers'])
        {
            $csv->setOffset(1); //because we don't want to insert the header
        }

        $csv->each(function ($row) {

            /*
             *
             *CSV row format:
             *
             * Main,
             * Sub1,
             * Sub2,
             * Description,
             * Brand,
             * Pack,
             * Size,
             * UOM,
             * MPC,
             * Contact,
             * GTIN,
             * Halal,
             * IsOrganicProduct,
             * KosherClassification,
             * CalculationSize,
             * CalculationSizeUnitofMeasure,
             * Calories,
             * CaloriesfromFat,
             * Protein,
             * Carbohydrates,
             * TotalDietaryFibre,
             * TotalSugar,
             * TotalFat,
             * SaturatedFat,
             * Sodium mg,
             * AllergenPeanuts,
             * AllergenTreeNuts,
             * AllergenMilk,
             * AllergenLactose,
             * AllergenEggs,
             * AllergenFish,
             * AllergenShellfish,
             * AllergenSoy,
             * AllergenGluten,
             * Image URL,
             * ItemDetail,
             * Preparation,
             * IngredientsEnglish,
             * BenefitsEnglish

             *
             */


            if ($row[0] != null)
            {
                //echo $row[1];

                $catIdRoot = $this->createCategory($row[0], null);
                $catIdSub1 = $this->createCategory($row[1], $row[0]);
                $catIdSub2 = $this->createCategory($row[2], $row[1]);

                //$userProduct = new \App\UserProduct();


                echo '<br/>';
                return true;

            }
        });

        echo 'Import complete';

    }

    private function createCategory($categoryName, $parentCategoryName = null)
    {
        $categoryId = null;

        if($parentCategoryName == null)
        {
            // Top level category
            $existing = \App\Category::where('name', '=', strtoupper($categoryName))->first();
            if($existing == null)
            {
                $newCat = new \App\Category();
                $newCat->name = strtoupper($categoryName);
                $newCat->save();

                $categoryId = $newCat->id;
            }
            else
            {
                $categoryId = $existing->id;
            }
        }
        else
        {
            // Sub level category
            $existingParent = \App\Category::where('name', '=', strtoupper($parentCategoryName))->first();
            if($existingParent != null)
            {
                $existing = \App\Category::where('name', '=', $categoryName)->where('parent_id', '=', $existingParent->id)->first();
                if($existing == null)
                {
                    $newCat = new \App\Category();
                    $newCat->name = strtoupper($categoryName);
                    $newCat->parent_id = $existingParent->id;
                    $newCat->save();

                    $categoryId = $newCat->id;
                }
                else
                {
                    $categoryId = $existing->id;
                }
            }
        }

        return $categoryId;
    }
}