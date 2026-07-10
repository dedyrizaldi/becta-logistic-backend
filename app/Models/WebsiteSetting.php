<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WebsiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Company
        |--------------------------------------------------------------------------
        */

        'company_name',
        'tagline',
        'company_description',

        /*
        |--------------------------------------------------------------------------
        | Contact
        |--------------------------------------------------------------------------
        */

        'email',
        'phone',
        'mobile',
        'whatsapp',
        'fax',

        /*
        |--------------------------------------------------------------------------
        | Address
        |--------------------------------------------------------------------------
        */

        'address',
        'latitude',
        'longitude',
        'google_maps',
        'office_hours',

        /*
        |--------------------------------------------------------------------------
        | Social
        |--------------------------------------------------------------------------
        */

        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'tiktok',
        'twitter',

        /*
        |--------------------------------------------------------------------------
        | Footer
        |--------------------------------------------------------------------------
        */

        'footer_text',
        'copyright',

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */

        'default_seo_title',
        'default_seo_description',

    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('logo')
            ->singleFile();

        $this
            ->addMediaCollection('footer_logo')
            ->singleFile();

        $this
            ->addMediaCollection('favicon')
            ->singleFile();

        $this
            ->addMediaCollection('og_image')
            ->singleFile();
    }
}