<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Table Restaurants
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse');
            $table->string('telephone')->nullable();
            $table->integer('capacite');
            $table->timestamps();
        });

        // Table Tables
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->integer('capacite');
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->string('status');
            $table->timestamps();
        });

        // Table Clients
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->nullable();
            $table->timestamps();
        });

        // Table Reservations
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('status');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('table_id')->constrained('tables');
            $table->timestamps();
        });

        // Table Stocks
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nom_produit');
            $table->integer('quantite');
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->timestamps();
        });

        // Table Menus
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->timestamps();
        });

        // Table Plats
        Schema::create('plats', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('description')->nullable();
            $table->float('prix');
            $table->foreignId('menu_id')->constrained('menus');
            $table->timestamps();
        });

        // Table Employes
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('poste');
            $table->float('salaire');
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->timestamps();
        });

        // Table Commandes
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('plat_id')->constrained('plats');
            $table->timestamps();
        });
    }

    public function down()
    {
        // Supprimez les tables dans l'ordre inverse des relations
        Schema::dropIfExists('commandes');
        Schema::dropIfExists('employes');
        Schema::dropIfExists('plats');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('tables');
        Schema::dropIfExists('restaurants');
    }
};
