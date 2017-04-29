<?php

namespace Sitec\Siravel\Repositories;

use Siravel;
use Config;
use CryptoService;
use Illuminate\Support\Facades\Schema;

class LangRepository
{
    protected $data;
    /**
     * @var string
     */
    const DEFAULT_LOCALE = 'pt-BR';

    /**
     * @var string
     */
    const DEFAULT_COUNTRY = 'Brasil';

    /**
     * @var string
     */
    const COOKIENAME = 'language';

    /**
     * @return string
     */
    public static function getDefaultLocale()
    {
        return self::DEFAULT_LOCALE;
    }

    /**
     * @return array
     */
    public static function getLocale()
    {
        return [
            'pt-BR',
            'en-US',
            'es-CO'
        ];
    }

    /**
     * @param  mixed  $locale (optional)
     * @param  string $column (optional)
     * @param  string $inLocale (optional)
     * @return array
     */
    public static function get($locale = null, $column = null, $inLocale = self::DEFAULT_LOCALE)
    {
        $allLocale = self::getLocale();

        if ($locale) {
            $locale = (array) $locale;
            foreach ($locale as $value) {
                $bestLocale[] = \Locale::lookup($allLocale, $value, false, self::getDefaultLocale());
            }
            $allLocale = $bestLocale;
        }

        return self::configure($allLocale, $column, $inLocale);
    }

    /**
     * @param array  $locale
     * @param string $column
     * @param string $inLocale
     */
    protected static function configure($locale, $column, $inLocale)
    {
        foreach ($locale as $key) {
            $configured[$key] = [
                'locale' => $key,
                'name' => utf8_decode(\Locale::getDisplayName($key, $inLocale)),
                'region' => utf8_decode(\Locale::getDisplayRegion($key, $inLocale)),
                'language' => utf8_decode(\Locale::getDisplayLanguage($key, $inLocale)),
                'class' => 'flag-icon flag-icon-' . strtolower(\Locale::getRegion($key))
            ];
        }

        if ($column) {
            return array_column($configured, $column, 'locale');
        }

        return $configured;
    }

    /**
     * @return array
     */
    public static function getCurrent()
    {
        return current(self::get(app()->getLocale()));

//        if ($request->session()->has('language')) {
//            Config::set('app.locale', $request->session()->get('language'));
//            app()->setLocale($request->session()->get('language'));
//        }
        if ($cookieLocale = self::getCookie()) {
            return current(self::get($cookieLocale));
        }

        if (!empty(Yii::app()->user->model()->language)) {
            $userLocale = Yii::app()->user->model()->language;
            return current(self::get($userLocale));
        }

        if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $browserLocale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            return current(self::get($browserLocale));
        }

        return current(self::get(self::getDefaultLocale()));
    }

    /**
     * @param  string $language
     * @return bool
     */
    public static function updateCookie($language)
    {
        return (!self::getCookie()) ?: self::setCookie($language);
    }

    /**
     * @return bool
     */
    public static function getCookie()
    {
        if (empty($_COOKIE[self::COOKIENAME])) {
            return false;
        }

        return $_COOKIE[self::COOKIENAME];
    }

    /**
     * @param  string $language
     * @return bool
     */
    public static function setCookie($language)
    {
        $bestLocale = current(self::get($language));
        return setcookie(self::COOKIENAME, $bestLocale['locale'], time() + (10 * 365 * 24 * 60 * 60), '/');
    }

    /**
     * Retorna o texto de acordo com o pais aonde o sistema est� hospedado, independente da linguagem escolhida pelo usu�rio
     * @param $configName
     * @return mixed
     */
    public static function getSystemLocale($configName)
    {
        $className = self::getSystemLocaleClass();
        require_once __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
        return $className::getConfig($configName);
    }

    /**
     * Retorna uma fun��o de acordo com o pais aonde o sistema est� hospedado, independente da linguagem escolhida pelo usu�rio
     * @param $function
     * @param $configName
     * @return mixed
     */
    public static function getSystemLocaleFunction($function, $configName)
    {
        $className = self::getSystemLocaleClass();
        return $className::getFunction($function, $configName);
    }

    /**
     * Retorna o locale daonde o sistema est� hospedado, independente da linguagem escolhida pelo usu�rio
     * @return string
     */
    protected static function getSystemLocaleClass()
    {
        $className = 'Country'.(defined('_COUNTRY_')?_COUNTRY_:self::DEFAULT_COUNTRY);
        if (!class_exists($className)) {
            $className = 'Country'.self::DEFAULT_COUNTRY;
        }
        return $className;
    }

    /**
     * Um helper que cria as constantes no javascript para o javascript tamb�m ter as nomenclaturas do pais aonde o
     * sistema est� hospedado.
     *
     * @param bool $withTagScript
     * @return string
     */
    public static function getJsSystemLocaleConstants($withTagScript=false)
    {
        $jsCode = '';
        if ($withTagScript) {
            $jsCode = '<script type="text/javascript">';
        }

        $jsCode .= self::getJsConstantsLine('CNPJ_NAME');
        $jsCode .= self::getJsConstantsLine('CNPJ_NAME_PLURAL');
        $jsCode .= self::getJsConstantsLine('CNPJ_MASCARA');
        $jsCode .= self::getJsConstantsLine('MONEY');
        $jsCode .= self::getJsConstantsLine('MONEY_PREPEND');

        if ($withTagScript) {
            $jsCode .= '</script>';
        }
        return $jsCode;
    }

    /**
     * Retorna a linha com a constante definida em javascript
     * @param $config
     * @param bool $isString
     */
    protected static function getJsConstantsLine($config, $isString = true)
    {
        $result = self::getSystemLocale($config);
        if ($isString) {
            $result = '"'.$result.'"';
        }
        return 'const COUNTRY_LANGUAGE_'.$config.' = '.$result.';';
    }

}
