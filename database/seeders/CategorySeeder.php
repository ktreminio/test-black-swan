<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'namecategory' => 'Pantalon limpio y planchado',
            'score' => '1',
            'goalboolean' => '1'
        ]);

        $category2 = Category::create([
            'namecategory' => 'Uñas (limpias, bien cuidadas y no tan largas)',
            'score' => '1',
            'goalboolean' => '1'
        ]);

        $category3 = Category::create([
            'namecategory' => 'Cabello (Peinado)',
            'score' => '1',
            'goalboolean' => '1'
        ]);

        $category4 = Category::create([
            'namecategory' => 'Cubre Boca',
            'score' => '2',
            'goalboolean' => '1'
        ]);

        $category5 = Category::create([
            'namecategory' => 'Gorro',
            'score' => '1',
            'goalboolean' => '1'
        ]);

        $category6 = Category::create([
            'namecategory' => 'Piso Limpio',
            'score' => '1',
            'goalboolean' => '1'
        ]);

        $category7 = Category::create([
            'namecategory' => 'Mesa de Trabajo Ordenada',
            'score' => '1',
            'goalboolean' => '1'
        ]);

        $category8 = Category::create([
            'namecategory' => 'Uso de Teléfono unicamente en el lugar de descanso',
            'score' => '5',
            'goalboolean' => '1'
        ]);

        $category9 = Category::create([
            'namecategory' => 'Ausencias Injustificadas',
            'score' => '4',
            'goalinteger' => '0'
        ]);

        $category10 = Category::create([
            'namecategory' => 'Llegadas Tardes',
            'score' => '4',
            'goalinteger' => '0'
        ]);

        $category11 = Category::create([
            'namecategory' => 'Permisos Extraordinarios',
            'score' => '4',
            'goalinteger' => '1'
        ]);
    }
}
