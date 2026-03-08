<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
   protected $fillable = [
    'item_code', 'name_th', 'name_en', 'category', 'description',
    'price_hot', 'price_iced', 'price_frappe', 'cost_price', 'calories',
    'caffeine_level', 'recommend_sweet', 'image_path', 'is_available', 'note'
];
}
