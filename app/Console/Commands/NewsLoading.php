<?php

namespace App\Console\Commands;

use App\Modules\Parser\DataRetrieve\ImageRetrieve;
use App\Modules\Parser\DataRetrieve\LongTextRetrieve;
use App\Modules\Parser\DataRetrieve\TextRetrieve;
use App\Modules\Parser\Parser;
use App\Modules\Parser\SelectorPresets\SelectorPresetNakedScience;
use App\Modules\Parser\SelectorPresets\SelectorPresetNPlus;
use Illuminate\Console\Command;

class NewsLoading extends Command
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
     *
     * @param Parser $parser
     * @return void
     */
    public function handle(Parser $parser, SelectorPresetNakedScience $nakedScience, SelectorPresetNPlus $nPlus)
    {
        $parser->setUrl($nakedScience)->run();
        $parser->setUrl($nPlus)->run();
    }
}
