<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',

        'button_text',
        'button_link',

        'background_image',

        'sort_order',

        'is_active',
    ];
}