<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $node = Category::create([
            'name' => 'Moda',
            'children' => [
                [
                    'name' => 'Ona',
                    'children' => [
                        ['name' => 'Buty damskie'],
                        ['name' => 'Odzież damska'],
                        ['name' => 'Sandały'],
                    ],
                ], [
                    'name' => 'On',
                    'children' => [
                        ['name' => 'Buty męskie'],
                        ['name' => 'Odzież męska'],
                        ['name' => 'Zegarki męskie'],
                    ],
                ], [
                    'name' => 'Dziecko',
                    'children' => [
                        ['name' => 'Buty dziecięce'],
                        ['name' => 'Odzież dziecięca'],
                        ['name' => 'Dresy dziecięce'],
                    ],
                ],
            ],
        ]);


        $node = Category::create([
            'name' => 'Elektronika',
            'children' => [
                [
                    'name' => 'Komputery',
                    'children' => [
                        ['name' => 'Laptopy'],
                        ['name' => 'PC'],
                        ['name' => 'Podzespoły komputerowe'],
                    ],
                ], [
                    'name' => 'AGD',
                    'children' => [
                        ['name' => 'Do domu'],
                        ['name' => 'Odkurzacze'],
                        ['name' => 'Kuchnia'],
                    ],
                ], [
                    'name' => 'Telefony i akcesoria',
                    'children' => [
                        ['name' => 'Smartfony'],
                        ['name' => 'Smartwatche'],
                        ['name' => 'Tablety'],
                    ],
                ],
            ],
        ]);

        Category::fixTree();

    }
}
