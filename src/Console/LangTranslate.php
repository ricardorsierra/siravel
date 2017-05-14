<?php
/**
 * Created by PhpStorm.
 * User: sierra
 * Date: 16/04/17
 * Time: 14:12
 */

namespace Sitec\Siravel\Console;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\TranslateClient;
use Sitec\Siravel\Repositories\LangRepository;
use Illuminate\Support\Facades\App;

class LangTranslate extends Command
{

    /**
     * Espaçamento dos arquivos criados
     */
    CONST QNT_SPACES = '    ';

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

    protected $defaultFiles = false;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $directory = App::langPath().DIRECTORY_SEPARATOR;

        $default_lang = LangRepository::DEFAULT_LOCALE;
        $langs = LangRepository::get();
        if (!$langs || empty($langs)) {
            return '';
        }

        $this->translate_dir($default_lang, $langs, $directory);

    }

    /**
     * Return the name of file without extension
     * @param $fullName
     * @return string
     */
    private function returnNameFile($fullName)
    {
        $nameFile = explode(DIRECTORY_SEPARATOR, $fullName);
        $nameExplode = explode('.', array_pop($nameFile));
        array_pop($nameExplode);
        return implode('.', $nameExplode);
    }

    /**
     * Get the files and yours messages for verify with the new lang
     * @param $default_lang
     * @param $directory
     * @return array|bool
     */
    private function getDefaultFiles($default_lang, $directory)
    {
        if (!$this->defaultFiles) {
            $this->defaultFiles = [];
            $files = glob($directory . $default_lang . DIRECTORY_SEPARATOR.'*.php');
            foreach ($files as $file) {
                $messages = require($file);
                $this->defaultFiles[$this->returnNameFile($file)] = $messages;
            }
        }
        return $this->defaultFiles;
    }

    /**
     * Translate a Directory
     *
     * @param $default_lang
     * @param $langs
     * @param $directory
     * @return bool
     */
    private function translate_dir($default_lang, $langs, $directory)
    {
        foreach ($langs as $lang) {
            if ($lang['locale'] === $default_lang) {
                continue;
            }
            $files = $defaultFiles = $this->getDefaultFiles($default_lang, $directory);
            $isNewFolder = false;

            $target = $lang['locale'];

            # Instantiates a client
            $translate = new TranslateClient($default_lang, $lang['locale']);

            // Se nao for um diretorio cria
            if (!is_dir($directory.$lang['locale'])) {
                $this->cp($directory.$default_lang, $directory.$lang['locale']);
                $isNewFolder = true;
                $files = glob($directory.$lang['locale'] . DIRECTORY_SEPARATOR.'*.php');
            }

            foreach ($files as $indice => $file) {
                list($saveFile, $messages, $isNewFile) = $this->getMessageForTranslateDir($directory, $lang, $default_lang, $indice, $file, $isNewFolder);
                $fileContent = "<?php\n";
                $fileContent .= "return [\n";
                if ($isNewFile) {
                    // Traduz o arquivo inteiro
                    foreach ($messages as $chave => $texto) {
                        $fileContent .= $this->translateArrayLine($translate, $chave, $texto);
                    }
                } else {
                    // Procura o que não tem no arquivo e acrescenta
                    foreach ($file as $chave => $texto) {
                        if (!isset($messages[$chave]) || $messages[$chave]=='') {
                            $fileContent .= $this->translateArrayLine($translate, $chave, $texto);
                        } else {
                            $fileContent .= $this->copyArrayLine($translate, $chave, $texto, $messages[$chave]);
                        }
                    }
                }
                $fileContent .= "];\n";
                file_put_contents($saveFile, $fileContent);
            }
        }
        return true;
    }

    /**
     * Retorna as Mensagens para Tradução do Arquivo
     * 
     * @param $directory
     * @param $lang
     * @param $default_lang
     * @param $indice
     * @param $file
     * @param bool $isNewFile
     * @return array
     */
    protected function getMessageForTranslateDir($directory, $lang, $default_lang, $indice, $file, $isNewFile = false)
    {
        if (is_array($file)) {
            $saveFile = $directory.$lang['locale'].DIRECTORY_SEPARATOR.$indice.'.php';
            if (file_exists($saveFile)) {
                echo "\n".'['.$lang['locale'].'] Verificando Mudanças no arquivo: '.$indice . ".php\n";
                $messages = require($saveFile);
            } else {
                echo "\n".'['.$lang['locale'].'] Criando arquivo Traduzido: '.$indice . ".php\n";
                copy(
                    $directory.$default_lang.DIRECTORY_SEPARATOR.$indice.'.php',
                    $saveFile
                );
                $messages = require($saveFile);
                $isNewFile = true;
            }
        } else {
            $saveFile = $file;
            echo "\n".'['.$lang['locale'].'] Criando arquivo Traduzido: '.$file . "\n";
            $messages = require($file);
        }
        return [$saveFile, $messages, $isNewFile];
    }

    /**
     * Copia uma linha que já foi traduzida.
     * Porém verifica se algum subindice não existe na tradução.
     *
     * @param $translate
     * @param $chave
     * @param $texto
     * @param $message
     * @param int $espace
     * @return string
     */
    private function copyArrayLine(TranslateClient $translate, $chave, $texto, $message, $espace = 1)
    {
        $spacing = $this->getSpacing($espace);
        if (is_array($texto)) {
            $fileContent = '';
            foreach ($texto as $chaveInterna => $textoInterno) {
                if (!isset($message[$chaveInterna]) || $message[$chaveInterna]=='') {
                    $fileContent .= $this->translateArrayLine($translate, $chaveInterna, $textoInterno, $espace+1);
                } else {
                   $fileContent .= $this->copyArrayLine($translate, $chaveInterna, $textoInterno, $message[$chaveInterna], $espace+1);
                }
            }
            if ($fileContent=='') {
                return "{$spacing}'{$chave}' => [],\n";
            }
            return "{$spacing}'{$chave}' => [\n{$fileContent}{$spacing}],\n";;
        }
        return "{$spacing}'{$this->recoverTextForTranslate($translate, $chave)}' => '{$this->recoverTextForTranslate($translate, $chave, $message)}',\n";
    }

    /**
     * Traduz uma linha de um array
     *
     * @param TranslateClient $translate
     * @param string $chave
     * @param string $texto
     * @param $copyFolder
     * @param int $espace
     * @return string
     */
    private function translateArrayLine(TranslateClient $translate, $chave, $texto, $espace = 1)
    {
        $fileContent = '';

        $spacing = $this->getSpacing($espace);

        if (is_array($texto)) {
            foreach ($texto as $chaveInterna => $textoInterno) {
                $fileContent = $this->translateArrayLine($translate, $chaveInterna, $textoInterno, $espace+1);
            }
            if ($fileContent=='') {
                return "{$spacing}'{$chave}' => [],\n";
            }
            return "{$spacing}'{$chave}' => [\n{$fileContent}{$spacing}],\n";
        }

        $originText = $this->prepareTextForTranslate($texto);

        if ($originText != '') {
            try {
                $translateText = $translate->translate($originText);
            } catch (Exception $e) {
                $translateText = $originText;
            }
        } else {
            $translateText = $originText;
        }

        $destinationText = $this->recoverTextForTranslate($translate, $originText, $translateText);
        echo "Traduzindo: ".$this->recoverTextForTranslate($translate, $originText) . " -> {$destinationText} \n";

        $fileContent .= "{$spacing}'{$chave}' => '{$destinationText}',\n";

        return $fileContent;
    }

    /**
     * Converte o texto para preparar para a internacionalização
     * @param $texto
     * @return string
     */
    private function prepareTextForTranslate($texto)
    {
        $originText = str_replace(["\\'", "'"], ["'", "\\'"], ($texto));
        return preg_replace ("~:([A-Za-z]+)~", "<<$1>>", $originText);
    }

    /**
     * Converte o texto para escrita no arquivo php
     * @param TranslateClient $translate
     * @param string $original
     * @param string $translateText
     * @return string
     */
    private function recoverTextForTranslate(TranslateClient $translate, $original, $translateText = '')
    {
        if ($translateText!=='') {
            $matches = [];
            // Caso o google tenha traduzido os parametros, desfaz essas traduções
            preg_match_all("~<([ A-Za-z]+)>~", $original, $matches);
            if (!empty($matches) && (!empty($matches[0]) || !empty($matches[1]))) {
                foreach ($matches[0] as $indice=>$valor) {
                    if (strpos($valor, $translateText) === false) {
                        $palavraTraduzida = $translate->translate($matches[1][$indice]);
                        $translateText = preg_replace('/<<'.$matches[1][$indice].'>>/i', $valor, $translateText);
                        $translateText = preg_replace('/<<'.$palavraTraduzida.'>>/i', $valor, $translateText);
                    }
                }
            }
        } else {
            $translateText = $original;
        }

        return str_replace(
            ['& nbsp', '& amp;', '& Laquo;', '& raquo;', '<< ', ' >>', '<<', '>>', "\\'", "'"  ],
            ['&nbsp',  '&amp;',  '&Laquo;',  '&raquo;',  ':',   '',    ':',  '',  "'",   "\\'"],
            $translateText
        );
    }

    /**
     * Copia uma Pasta
     *
     * @param $diretorio
     * @param $destino
     * @param bool $ver_acao
     */
    private function cp($diretorio, $destino, $ver_acao = false){
        if ($destino{strlen($destino) - 1} == '/'){
            $destino = substr($destino, 0, -1);
        }
        if (!is_dir($destino)){
            if ($ver_acao){
                echo "Criando diretorio {$destino}\n";
            }
            mkdir($destino, 0755);
        }

        $folder = opendir($diretorio);

        while ($item = readdir($folder)){
            if ($item == '.' || $item == '..'){
                continue;
            }
            if (is_dir("{$diretorio}/{$item}")){
                copy_dir("{$diretorio}/{$item}", "{$destino}/{$item}", $ver_acao);
            }else{
                if ($ver_acao){
                    echo "Copiando {$item} para {$destino}"."\n";
                }
                copy("{$diretorio}/{$item}", "{$destino}/{$item}");
            }
        }
    }

    /**
     * Função para fazer o indentamento das funções
     *
     * @param int $espace Grau de Indentamento da linha
     * @return string
     */
    private function getSpacing($espace)
    {
        $spacing = '';
        for ($i=0; $i<$espace; ++$i) {
            $spacing .= self::QNT_SPACES;
        }
        return $spacing;
    }
}