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
        $parser->setProperties([
                'title' => 'div.post-title > h1',
                'shortText' => 'div.post-lead > p',
                'longText' => 'div.body',
                'image' => 'div.post-image-inner > a > img.wp-post-image',
            ]);
        $parser->getLinksFromMainPage('https://naked-science.ru/', 'div.full-width > div.news-item-title > h3 > a');

        $parser->setProperties([
                'title' => 'header.hero-lite > div > h1',
                'shortText' => 'article.content > div.js-mediator-article > p',
                'longText' => 'article.content > div.js-mediator-article',
                'image' => 'article.content > div.js-mediator-article > div.article-image > figure > img',
            ]);
        $parser->getLinksFromMainPage('https://nplus1.ru/', 'article.item-news > a');
        
        $parser->store();

     //   $parser2 = clone $parser;
        
      //  $parser2->store(); 
    }
}
