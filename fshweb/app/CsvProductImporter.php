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

        //\Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix()
        $path = $pio->getUuid() . '/' .  $pio->getFileName();

        $fileContents = \Storage::disk('imports')->get($path);


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
                    // Check to see if the record already exists (update) if not ignore existing items
                    $product = \App\Models\Product::where('uniquekey', '=', $row[8])
                                    ->orWhere('uniquekey', '=', $row[11])->first();

                    $isExisting = ($product) ? true : false;

                    if($isExisting && !$pio->isSimulate() && !$pio->isIgnoreExisting())
                    {
                        // Clear any existing categories
                        \DB::table('product_categories')->where('product_id', '=', $product->id)->delete();

                        // Clear any existing allergens
                        \DB::table('product_allergens')->where('product_id', '=', $product->id)->delete();
                    }
                    else
                    {
                        $product = new \App\Models\Product();
                        $product->vendor_id = $pio->getVendorId();
                        $product->uniquekey = (isset($row[8])) ? $row[8] : $row[11]; // MPC or GTIN
                    }

                    $product->name =                $row[3];
                    $product->brand =               $row[4];
                    $product->pack =                $row[5];
                    $product->size =                $row[6];
                    $product->uom =                 $row[7];
                    $product->serving_size_uom =    $row[7]; // Not sure this should be duplicated
                    $product->mpc =                 $row[8];
                    $product->broker_contact =      $row[9];
                    $product->gtin =                $row[10];
                    $product->is_halal =            ($row[11] == 'Yes') ? 1 : 0;
                    $product->is_organic =          ($row[12] == 'Yes') ? 1 : 0;
                    $product->is_kosher =           ($row[13] == 'Yes') ? 1 : 0;
                    $product->calc_size =           $row[14];
                    $product->calculation_size_uom = $row[15];
                    $product->calories =            $row[16];
                    $product->calories_from_fat =   $row[17];
                    $product->protein =             $row[18];
                    $product->carbs =               $row[19];
                    $product->fibre =               $row[20];
                    $product->sugar =               $row[21];
                    $product->total_fat =           $row[22];
                    $product->saturated_fats =      $row[23];
                    $product->sodium =              $row[24];

                    //rows 25, 26, 27, 28, 29, 30, 31, 32, 33 are allergens

                    $product->product_image =       $row[34];
                    $product->description =         $row[35];
                    $product->preparation =         $row[36];
                    $product->ingredient_deck =     $row[37];
                    $product->features_benefits =   $row[38];

                    $product->allergen_disclaimer = '';
                    $product->net_weight =          0;
                    $product->gross_weight =        0;
                    $product->tare_weight =         0;
                    $product->serving_size =        0;
                    $product->vendor_logo =         '';
                    $product->pos_pdf =             '';

                    if(!$isExisting)
                    {
                        $product->published = $pio->isAddAsActive();
                    }

                    // Only create record, relationships and commit if not simulated
                    if(!$pio->isSimulate() || ($isExisting && !$pio->isIgnoreExisting()))
                    {
                        $product->save();

                        // Create any categories for the user product
                        $catIdRoot = $this->createCategory($row[0], null);
                        $catIdSub1 = $this->createCategory($row[1], $row[0]);
                        $catIdSub2 = $this->createCategory($row[2], $row[1]);

                        $this->createProductCategory($catIdRoot, $product->id);
                        $this->createProductCategory($catIdSub1, $product->id);
                        $this->createProductCategory($catIdSub2, $product->id);

                        // Create any allergens for the user product
                        if($row[25] == 'Y') { $this->createProductAllergen(6, $product->id); }
                        if($row[26] == 'Y') { $this->createProductAllergen(9, $product->id); }
                        if($row[27] == 'Y') { $this->createProductAllergen(5, $product->id); }
                        if($row[28] == 'Y') { $this->createProductAllergen(4, $product->id); }
                        if($row[29] == 'Y') { $this->createProductAllergen(1, $product->id); }
                        if($row[30] == 'Y') { $this->createProductAllergen(2, $product->id); }
                        if($row[31] == 'Y') { $this->createProductAllergen(7, $product->id); }
                        if($row[32] == 'Y') { $this->createProductAllergen(8, $product->id); }
                        if($row[33] == 'Y') { $this->createProductAllergen(3, $product->id); }

                        \DB::commit();

                    }

                    if($isExisting && !$pio->isIgnoreExisting())
                    {
                        $recordsUpdated += 1;
                    }
                    else
                    {
                        $recordsAdded += 1;
                    }

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

        // Create a record of the import in the database
        $productImport = new \App\Models\ProductImport();
        $productImport->user_id = $pio->getVendorId();
        $productImport->uuid = $pio->getUuid();
        $productImport->filename = $pio->getFileName();
        $productImport->save();

        echo sprintf('Import complete, %s records added, %s records updated, %s records failed %s', $recordsAdded, $recordsUpdated, $recordsFailed, ($pio->isSimulate() ? '(Simulated)' : '' ));

    }

    private function createProductAllergen($allergenId, $productId)
    {
        $upa = new \App\Models\ProductAllergen();
        $upa->product_id = $productId;
        $upa->allergen_id = $allergenId;
        $upa->save();
    }

    private function createProductCategory($categoryId, $productId)
    {
        // Assign categories to user product
        if($categoryId != null)
        {
            $upc = new \App\Models\ProductCategory();
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
            $existing = \App\Models\Category::where('name', '=', strtoupper($categoryName))->first();
            if($existing == null)
            {
                $newCat = new \App\Models\Category();
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
            $existingParent = \App\Models\Category::where('name', '=', strtoupper($parentCategoryName))->first();
            if($existingParent != null)
            {
                $existing = \App\Models\Category::where('name', '=', $categoryName)->where('parent_id', '=', $existingParent->id)->first();
                if($existing == null)
                {
                    $newCat = new \App\Models\Category();
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