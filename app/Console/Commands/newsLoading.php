<?php

namespace App\Console\Commands;

use App\Modules\Parser\ImageRetrieve;
use App\Modules\Parser\LongTextRetrieve;
use App\Modules\Parser\TextRetrieve;
use Illuminate\Console\Command;
use App\Modules\Parser\Parser;

class newsLoading extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'load parser news';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Настройки парсинга
     * @param Parser $parser
     * @return void
     */
    public function handle(Parser $parser)
    {
        $parser->getLinksFromMainPage('https://naked-science.ru/', 'h3 > a');
        $parser->setProperties([
            'title' => new TextRetrieve('h1'),
            'shortText' => new TextRetrieve('div.post-lead > p'),
            'longText' => new LongTextRetrieve('div.body > p'),
            'image' => new ImageRetrieve('img'),
        ]);
        $parser->retrieveDataFromPage();

        $parser->getLinksFromMainPage('https://nplus1.ru/', 'div.border-gray-2 > div.flex-col > a');
        $parser->setProperties([
            'title' => new TextRetrieve('h1'),
            'shortText' => new TextRetrieve('div.n1_material > p'),
            'longText' => new LongTextRetrieve('div.n1_material > p'),
            'image' => new ImageRetrieve('img'),
        ]);
        $parser->retrieveDataFromPage();

        $parser->getLinksFromMainPage('https://lenta.ru/', 'a.card-mini');
        $parser->setProperties([
            'title' => new TextRetrieve('h1'),
            'shortText' => new TextRetrieve('div.topic-body__title-yandex'),
            'longText' => new LongTextRetrieve('p'),
            'image' => new ImageRetrieve('img'),
        ]);
        $parser->retrieveDataFromPage();
        $parser->store();
    }
}
