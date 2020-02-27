<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavbarsTable extends Migration
{
    const TABLE_NAME = 'navbars';

    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table)
        {
            $table->charset   = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');

            $table->integer('pid')->unsigned()->default(0);
            $table->string('filter', 32)->nullable();
            $table->string('type', 32);
            $table->boolean('group')->default(false);
            $table->string('body', 64)->nullable();
            $table->string('title')->nullable();
            $table->string('href', 2000)->nullable();
            $table->boolean('external')->default(false);
            $table->string('class')->nullable();
            $table->string('icon')->nullable();
            $table->text('attrs')->nullable();
            $table->string('role')->nullable();
            $table->string('permission')->nullable();
            $table->integer('position')->unsigned()->default(0);
        });
    }

    public function down(): void
    {
        Schema::drop(self::TABLE_NAME);
    }
}
