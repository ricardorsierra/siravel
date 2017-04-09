<?php

namespace Sitec\Siravel\Console;

use Illuminate\Console\Command;

class Keys extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'siravel:keygen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Siravel will generate keys for the API Internal and External access';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $keyOne = sha1(str_random(12));
        $keyTwo = sha1(str_random(40));

        $content = file_get_contents(base_path('.env'));

        if (strpos($content, 'SIRAVEL_API_TOKEN=') > -1) {
            $content = str_replace('SIRAVEL_API_TOKEN=', 'SIRAVEL_API_TOKEN='.$keyOne, $content);
        } else {
            $content .= "\nSIRAVEL_API_TOKEN=".$keyOne;
        }

        if (strpos($content, 'SIRAVEL_API_KEY=') > -1) {
            $content = str_replace('SIRAVEL_API_KEY=', 'SIRAVEL_API_KEY='.$keyTwo, $content)."\n";
        } else {
            $content .= "\nSIRAVEL_API_KEY=".$keyTwo."\n";
        }

        file_put_contents(base_path('.env'), $content);

        $this->info('Your keys have been generated.');
    }
}
