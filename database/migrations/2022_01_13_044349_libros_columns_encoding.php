<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LibrosColumnsEncoding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->string('titulo')->charset('utf8')->change();
            $table->string('titulo')->collation('utf8_spanish_ci')->change();
            $table->string('imagen')->charset('utf8')->change();
            $table->string('imagen')->collation('utf8_spanish_ci')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
