<?php

namespace App\Modules\Parser\SelectorPresets;

use App\Modules\Parser\DataRetrieve\ImageRetrieve;
use App\Modules\Parser\DataRetrieve\LongTextRetrieve;
use App\Modules\Parser\DataRetrieve\TextRetrieve;
use JetBrains\PhpStorm\Pure;

abstract class SelectorPresetForDataRetrieve
{
    protected string $siteUrl;
    protected string $urlSelector;
    protected string $titleSelector;
    protected string $shortTextSelector;
    protected string $longTextSelector;
    protected string $imageSelector;
    private array $receivedData = [];

    #[Pure] public function __construct()
    {
        $this->receivedData['title'] = new TextRetrieve($this->titleSelector);
        $this->receivedData['shortText'] = new TextRetrieve($this->shortTextSelector);
        $this->receivedData['longText'] = new LongTextRetrieve($this->longTextSelector);
        $this->receivedData['image'] = new ImageRetrieve($this->imageSelector);
    }

    public function getSiteUrl() : string
    {
        return $this->siteUrl;
    }

    public function getUrlSelector() : string
    {
        return $this->urlSelector;
    }

    public function getReceivedData() : array
    {
        return $this->receivedData;
    }

    abstract protected function setUp() : void;
}
