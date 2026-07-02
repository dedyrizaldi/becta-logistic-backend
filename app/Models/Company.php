<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'tagline',

        'about',
        'vision',
        'mission',

        'address',
        'phone',
        'whatsapp',
        'email',
        'website',
        'google_maps',

        'logo',
        'footer_logo',
        'favicon',

        'facebook',
        'instagram',
        'linkedin',
        'youtube',

        'seo_title',
        'seo_description',
        'seo_keywords',

        'is_active',
    ];
}