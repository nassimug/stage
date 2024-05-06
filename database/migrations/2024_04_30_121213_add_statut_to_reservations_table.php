<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddStatutToReservationsTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::table('reservations', function (Blueprint $table) {
$table->string('statut')->default('pending'); 
});
}
/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::table('reservations', function (Blueprint $table) {
$table->dropColumn('statut'); 
});
}
}