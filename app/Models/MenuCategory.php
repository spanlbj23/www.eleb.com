<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable=[
      'name',
      'type_accumulation',
        'description',
        'is_selected',
        'shop_id',
    ];

    public function menu(){
        return $this->belongsTo(Menu::class,'id','category_id');
    }
}
