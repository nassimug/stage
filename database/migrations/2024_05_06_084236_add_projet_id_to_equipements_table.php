<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjetIdToEquipementsTable extends Migration
{
    public function up()
    {
        Schema::table('equipements', function (Blueprint $table) {
    $table->unsignedBigInteger('projet_id')->nullable()->after('id');
    $table->foreign('projet_id')->references('id')->on('projets');
});

    }

    public function down()
    {
        Schema::table('equipements', function (Blueprint $table) {
            $table->dropForeign(['projet_id']); // Supprime la contrainte de clé étrangère
            $table->dropColumn('projet_id'); // Supprime la colonne
        });
    }
}
