<?php

use Phinx\Seed\AbstractSeed;

class CategorySeeder extends AbstractSeed
{
 public function run()
    {
       $faker = Faker\Factory::create();
    /*   $data = [];
        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                
                'libelle' => $faker->lexify('libelle ???'),
                'details' => $faker->lexify('details ???'),
                'image'   => $faker->numerify('img#.png'),
                'etat'    => $faker->boolean($chanceOfGettingTrue = 65),
                'datec'   => $faker->date($format = 'Y-m-d', $max = 'now'),
            ];
        }
 	
        $this->table('Catalog')->insert($data)->saveData();
	$data2 = [];
	for ($i = 0; $i < 30; $i++) {
            $data2[] = [
                
                'lib' => $faker->lexify('produit de ???'),

                'image'   => $faker->numerify('img#.png'),
               // 'catalog' => $faker->randomDigitNotNull,
            ];
        }
 
        $this->table('Product')->insert($data2)->saveData();
*/
	$data3 = [];
	for ($i = 0; $i < 10; $i++) {
            $data3[] = [
                
                'catalog' => $faker->randomDigitNotNull,
		        'product' => $faker->randomDigitNotNull
            ];
        }
 
        $this->table('CatalogProduct')->insert($data3)->saveData();

/*
        $data4 = [];
        for ($i = 0; $i < 10; $i++) {
            $data4[] = [

                'catalog' => $faker->randomDigitNotNull,

                'product' => $faker->randomDigitNotNull,
            ];
        }
        $this->table('CatProd')->insert($data4)->saveData();*/
    }


}
?>
