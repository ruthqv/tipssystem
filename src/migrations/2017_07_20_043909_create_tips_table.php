<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('mongodb')->create('tips', function($collection)
        {
            $collection->index('question');
            $collection->index('category');
            $collection->ensureIndex("solution","text");
            $collection->index('approved')->default(0);
            $collection->index('resource')->nullable();
            $collection->index('email')->nullable();
            $collection->index('username')->nullable();
            $collection->index('user_id')->nullable();

            $collection->timestamps();
            $collection->softDeletes();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->drop('tips');
        // Schema::drop('tips');    
    }

}
