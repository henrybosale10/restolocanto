<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','description'];
    public function menus()
    {
        return $this->belongsToMany(Menu::class,'cuisine_menu');
    }



}
