<?php
/**
 * Created by PhpStorm.
 * User: sierra
 * Date: 16/04/17
 * Time: 14:12
 */

namespace Sitec\Siravel\Console;

use Illuminate\Console\Command;
use Google\Cloud\Translate\TranslateClient;

class LangTranslate extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'siravel:lang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Siravel will translate your translates paths';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        # Your Google Cloud Platform project ID
        $projectId = 'sierratecnologiabrasil';

        $directory = App::langPath().DIRECTORY_SEPARATOR;

        # Instantiates a client
        $translate = new TranslateClient(['projectId' => $projectId]);

        $languages = ['en-US' => 'en', 'es-ES' => 'es'];
        foreach ($languages as $language => $target) {
            $files = glob($directory.$language . '/*.php');
            foreach ($files as $file) {
                echo $file . "\n";
                $messages = require($file);
                $fileContent = "<?php\n";
                $fileContent .= "return [\n";
                foreach ($messages as $originText => $destinationText) {
                    $originText = str_replace("'", "\\'", ($originText));
                    if (!empty($destinationText)) {
                        $fileContent .= " '
                        {
                        $originText
                        }
    
                        ' => '{
                            $destinationText}',\n
                        ";
                        continue;
                    }

                    $originText = str_replace(['{', '}'], ['<', '>'], $originText);

                    $translation = $translate->translate(utf8_encode($originText), [
                        'target' => $target
                    ]);
                    $destinationText = str_replace(['<', '>'], ['{', '}'], utf8_decode($translation['text']));
                    $originText = str_replace(['<', '>'], ['{', '}'], $originText);
                    echo $originText . " - {$destinationText} \n";

                    $fileContent .= " '{$originText}' => '{$destinationText}',\n";

                }
                $fileContent .= "];\n";
                rename($file, $file . ".bkp");
                file_put_contents($file, $fileContent);
            }
        }

    }
}