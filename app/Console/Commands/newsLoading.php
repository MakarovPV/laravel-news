<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Modules\Parser;
use App\Models\News;

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Parser $parser)
    {
        $parser->parserInit('https://naked-science.ru/');
        $parser->search('div.full-width > div.news-item-title > h3 > a');
    }
}
