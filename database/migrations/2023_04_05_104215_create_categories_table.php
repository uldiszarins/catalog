<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('category')->comment('categories.id');
            $table->string('name', 255)->comment('Nosaukums');
            $table->unsignedMediumInteger('inventory_number')->comment('Inventāra numurs');
            $table->unsignedInteger('language')->comment('languages.id');
            $table->string('author', 255)->comment('Autors');
            $table->year('year')->comment('Izdošanas gads');
            $table->unsignedMediumInteger('page_count')->comment('Lapaspušu skaits');
            $table->unsignedTinyInteger('photo')->nullable()->comment('Vai ir foto');
            $table->string('location', 255)->comment('Kur šobrīd atrodās');
            $table->softDeletes('deleted_at', $precision = 0);

            $table->foreign('category')
                ->references('id')
                ->on('categories')
                ->restrictOnDelete();

            $table->foreign('language')
                ->references('id')
                ->on('languages')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
