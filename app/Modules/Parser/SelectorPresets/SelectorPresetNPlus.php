<?php

namespace App\Modules\Parser\SelectorPresets;

class SelectorPresetNPlus extends SelectorPresetForDataRetrieve
{
    public function __construct()
    {
        $this->setUp();
        parent::__construct();
    }

    protected function setUp(): void
    {
        $this->siteUrl = 'https://nplus1.ru/';
        $this->urlSelector = 'div.border-gray-2 > div.flex-col > a';
        $this->titleSelector = 'h1';
        $this->shortTextSelector = 'div.n1_material > p';
        $this->longTextSelector = 'div.n1_material > p';
        $this->imageSelector = 'img';
    }
}
