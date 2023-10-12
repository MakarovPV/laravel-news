<?php

namespace App\Modules\Parser\SelectorPresets;

class SelectorPresetNakedScience extends SelectorPresetForDataRetrieve
{
    public function __construct()
    {
        $this->setUp();
        parent::__construct();
    }

    protected function setUp(): void
    {
        $this->siteUrl = 'https://naked-science.ru/';
        $this->urlSelector = 'h3 > a';
        $this->titleSelector = 'h1';
        $this->shortTextSelector = 'div.post-lead > p';
        $this->longTextSelector = 'div.body > p';
        $this->imageSelector = 'img';
    }
}
