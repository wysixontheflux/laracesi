<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'telephone', 'capacite'];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function employes()
    {
        return $this->hasMany(Employe::class);
    }
}
