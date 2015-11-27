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
use App\Models;

class CsvProductImporter implements iProductImporter
{

    public function doImport(ProductImportOptions $pio)
    {
        //dd($pio);

        //$userProductImport = new UserProductImport();
        //$userProductImport->user_id = $data['user_id'];
        //$userProductImport->uuid = $data['uuid'];
        //$userProductImport->filename = $data['filename'];
        //$userProductImport->save();

        $fileContents = \Storage::get(config('app.csv_storage') . '/' . $pio->getUuid() . '/' .  $pio->getFileName());
        $csv = Reader::createFromString($fileContents);
        $csv->setDelimiter(',');

        if($pio->isIncludeHeaders())
        {
            $csv->setOffset(1); //because we don't want to insert the header
        }

        $recordsAdded = 0;
        $recordsUpdated = 0;
        $recordsFailed = 0;
        $recordCount = 0;

        $csv->each(function ($row) use(&$pio, &$recordsAdded, &$recordsUpdated, &$recordsFailed, &$recordCount)
        {

            /* Row Structure
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
                if(!$pio->isSimulate())
                {
                    \DB::beginTransaction();
                }

                try
                {
                    // Check to see if the record already exists (update)
                    $userProduct = \App\UserProduct::where('uniquekey', '=', $row[8])
                                    ->orWhere('uniquekey', '=', $row[11])->first();

                    $isExisting = ($userProduct) ? true : false;

                    if($isExisting && !$pio->isSimulate())
                    {
                        // Clear any existing categories
                        \DB::table('user_products_categories')->where('product_id', '=', $userProduct->id)->delete();

                        // Clear any existing allergens
                        \DB::table('user_products_allergens')->where('product_id', '=', $userProduct->id)->delete();
                    }
                    else
                    {
                        $userProduct = new UserProduct();
                        $userProduct->user_id = $pio->getUserId();
                        $userProduct->uniquekey = (isset($row[8])) ? $row[8] : $row[11]; // MPC or GTIN
                    }

                    $userProduct->name =                $row[3];
                    $userProduct->brand =               $row[4];
                    $userProduct->pack =                $row[5];
                    $userProduct->size =                $row[6];
                    $userProduct->uom =                 $row[7];
                    $userProduct->serving_size_uom =    $row[7]; // Not sure this should be duplicated
                    $userProduct->mpc =                 $row[8];
                    $userProduct->broker_contact =      $row[9];
                    $userProduct->gtin =                $row[10];
                    $userProduct->is_halal =            ($row[11] == 'Yes') ? 1 : 0;
                    $userProduct->is_organic =          ($row[12] == 'Yes') ? 1 : 0;
                    $userProduct->is_kosher =           ($row[13] == 'Yes') ? 1 : 0;
                    $userProduct->calc_size =           $row[14];
                    $userProduct->calculation_size_uom = $row[15];
                    $userProduct->calories =            $row[16];
                    $userProduct->calories_from_fat =   $row[17];
                    $userProduct->protein =             $row[18];
                    $userProduct->carbs =               $row[19];
                    $userProduct->fibre =               $row[20];
                    $userProduct->sugar =               $row[21];
                    $userProduct->total_fat =           $row[22];
                    $userProduct->saturated_fats =      $row[23];
                    $userProduct->sodium =              $row[24];

                    //rows 25, 26, 27, 28, 29, 30, 31, 32, 33 are allergens

                    $userProduct->product_image =       $row[34];
                    $userProduct->description =         $row[35];
                    $userProduct->preparation =         $row[36];
                    $userProduct->ingredient_deck =     $row[37];
                    $userProduct->features_benefits =   $row[38];

                    $userProduct->allergen_disclaimer = '';
                    $userProduct->net_weight =          0;
                    $userProduct->gross_weight =        0;
                    $userProduct->tare_weight =         0;
                    $userProduct->serving_size =        0;
                    $userProduct->vendor_logo =         '';
                    $userProduct->pos_pdf =             '';

                    if(!$isExisting)
                    {
                        $userProduct->published = $pio->isAddAsActive();
                    }

                    // Only create record, relationships and commit if not simulated
                    if(!$pio->isSimulate())
                    {
                        $userProduct->save();

                        // Create any categories for the user product
                        $catIdRoot = $this->createCategory($row[0], null);
                        $catIdSub1 = $this->createCategory($row[1], $row[0]);
                        $catIdSub2 = $this->createCategory($row[2], $row[1]);

                        $this->createUserCategory($catIdRoot, $userProduct->id);
                        $this->createUserCategory($catIdSub1, $userProduct->id);
                        $this->createUserCategory($catIdSub2, $userProduct->id);

                        // Create any allergens for the user product
                        if($row[25] == 'Y') { $this->createUserAllergen(6, $userProduct->id); }
                        if($row[26] == 'Y') { $this->createUserAllergen(9, $userProduct->id); }
                        if($row[27] == 'Y') { $this->createUserAllergen(5, $userProduct->id); }
                        if($row[28] == 'Y') { $this->createUserAllergen(4, $userProduct->id); }
                        if($row[29] == 'Y') { $this->createUserAllergen(1, $userProduct->id); }
                        if($row[30] == 'Y') { $this->createUserAllergen(2, $userProduct->id); }
                        if($row[31] == 'Y') { $this->createUserAllergen(7, $userProduct->id); }
                        if($row[32] == 'Y') { $this->createUserAllergen(8, $userProduct->id); }
                        if($row[33] == 'Y') { $this->createUserAllergen(3, $userProduct->id); }

                        \DB::commit();

                    }

                    ($isExisting) ? $recordsUpdated += 1 : $recordsAdded += 1;
                }
                catch(\Exception $ex)
                {
                    if(!$pio->isSimulate())
                    {
                        \DB::rollBack();
                    }

                    $recordsFailed +=1 ;
                }

                $recordCount += 1;

                return true; // Continue processing file
            }
        });


        echo sprintf('Import complete, %s records added, %s records updated, %s records failed %s', $recordsAdded, $recordsUpdated, $recordsFailed, ($pio->isSimulate() ? '(Simulated)' : '' ));

    }

    private function createUserAllergen($allergenId, $productId)
    {
        $upa = new \App\UserProductAllergen();
        $upa->product_id = $productId;
        $upa->allergen_id = $allergenId;
        $upa->save();
    }

    private function createUserCategory($categoryId, $productId)
    {
        // Assign categories to user product
        if($categoryId != null)
        {
            $upc = new \App\UserProductCategory();
            $upc->product_id = $productId;
            $upc->category_id = $categoryId;
            $upc->save();
        }
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