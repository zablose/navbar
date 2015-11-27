<?php

use Zablose\Navbar\NavbarEntityCore;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavbarsTable extends Migration
{

    const TABLE_NAME = 'zablose_navbars';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('pid')->unsigned()->default(0);
            $table->string('filter', 32)->nullable();
            $table->string('type', 32)->default(NavbarEntityCore::TYPE_NAVBAR_LINK_RELATIVE);
            $table->string('body', 64)->nullable();
            $table->string('title')->nullable();
            $table->string('href', 2000)->nullable();
            $table->string('class')->nullable();
            $table->string('icon')->nullable();
            $table->integer('role_id')->unsigned()->default(0);
            $table->integer('permission_id')->unsigned()->default(0);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::TABLE_NAME);
    }

}
