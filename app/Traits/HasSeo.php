<?php

namespace App\Traits;

trait HasSeo
{
    public function getSeoTitle(): string
    {
        return $this->seo_title ?: $this->title;
    }

    public function getSeoDescription(): string
    {
        return $this->seo_description ?: $this->excerpt;
    }
}