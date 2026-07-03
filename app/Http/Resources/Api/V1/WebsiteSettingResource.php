<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Company
            |--------------------------------------------------------------------------
            */

            'company_name' => $this->company_name,

            'tagline' => $this->tagline,

            'company_description' => $this->company_description,

            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            'email' => $this->email,

            'phone' => $this->phone,

            'mobile' => $this->mobile,

            'whatsapp' => $this->whatsapp,

            'fax' => $this->fax,

            'address' => $this->address,

            'latitude' => $this->latitude,

            'longitude' => $this->longitude,

            'google_maps' => $this->google_maps,

            'office_hours' => $this->office_hours,

            /*
            |--------------------------------------------------------------------------
            | Social
            |--------------------------------------------------------------------------
            */

            'facebook' => $this->facebook,

            'instagram' => $this->instagram,

            'linkedin' => $this->linkedin,

            'youtube' => $this->youtube,

            'tiktok' => $this->tiktok,

            'twitter' => $this->twitter,

            /*
            |--------------------------------------------------------------------------
            | Footer
            |--------------------------------------------------------------------------
            */

            'footer_text' => $this->footer_text,

            'copyright' => $this->copyright,

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'default_seo_title' => $this->default_seo_title,

            'default_seo_description' => $this->default_seo_description,

            /*
            |--------------------------------------------------------------------------
            | Media
            |--------------------------------------------------------------------------
            */

            'logo' => $this->getFirstMediaUrl('logo') ?: null,

            'footer_logo' => $this->getFirstMediaUrl('footer_logo') ?: null,

            'favicon' => $this->getFirstMediaUrl('favicon') ?: null,

            'og_image' => $this->getFirstMediaUrl('og_image') ?: null,

        ];
    }
}