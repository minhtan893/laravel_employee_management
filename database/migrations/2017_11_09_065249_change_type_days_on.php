<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeDaysOn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE users MODIFY days_on  LONGTEXT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE users MODIFY days_on string');
    }
}
