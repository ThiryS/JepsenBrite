<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\Subcategory;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        $subcategories = ['Rock', 'Rap', 'R&B', 'Reggae', 'Hard Rock', 'Autre'];
        foreach ($subcategories as $subcategory) 
        {
            DB::table('subcategories')->insert(['name' => $subcategory, 'category_id' => 1]);
        }
        $subcategories2 = ['Sculpture', 'Peinture', 'Vestimentaire', 'Autre'];
        foreach ($subcategories2 as $subcategory2) 
        {
            DB::table('subcategories')->insert(['name' => $subcategory2, 'category_id' => 2]);
        }
        $subcategories3 = ['Scientifique ', 'Médicale', 'Philosophique', 'Politique', 'Autre'];
        foreach ($subcategories3 as $subcategory3) 
        {
            DB::table('subcategories')->insert(['name' => $subcategory3, 'category_id' => 3]);
        }
        $subcategories4 = ['Batiment ', 'Tourisme', 'Auto-Moto', 'Aéronautique', 'Autre'];
        foreach ($subcategories4 as $subcategory4) 
        {
            DB::table('subcategories')->insert(['name' => $subcategory4, 'category_id' => 4]);
        }
        $subcategories5 = ['Dance ', 'Chant', 'Théatre', 'Comédie', 'Tragédie' , 'Autre'];
        foreach ($subcategories5 as $subcategory5) 
        {
            DB::table('subcategories')->insert(['name' => $subcategory5, 'category_id' => 5]);
        }
        $subcategories6 = ['Dansante ', 'Privée', 'Publique', 'Anniversaire', 'Bar Mitzvah' , 'Autre'];
        foreach ($subcategories6 as $subcategory6) 
        {
            DB::table('subcategories')->insert(['name' => $subcategory6, 'category_id' => 6]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategories');
    }
}
