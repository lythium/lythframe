<?php
/**
 *
 */
class LythFrameValidate
{
    function __construct()
    {
        add_action( 'wp_ajax_validateProcess', 'validateProcess' );
        add_action( 'wp_ajax_nopriv_validateProcess', 'validateProcess' );
    }
    static function validateProcess()
    {
        if (!isset($_POST) && empty($_POST)) {
            die(json_encode(array(
                'return' => false,
                'error' => 'error'
            )));
        }
        die();
    }
    public function cleanNonUnicode($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET')) {
            return $pattern;
        }
        return preg_replace(cleanNonUnicode('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2'), $pattern);
    }
    public static function isNumeric($value)
    {
        return is_numeric($value);
    }
    public static function isString($data)
    {
        return is_string($data);
    }
    public static function isUrl($url)
    {
        return preg_match('/^[~:#,$%&_=\(\)\.\? \+\-@\/a-zA-Z0-9\pL\pS-]+$/u', $url);
    }
    public static function isGenericName($name)
    {
        return empty($name) || preg_match(cleanNonUnicode('/^[^<>={}]*$/u'), $name);
    }
    public static function isPattern($pattern, int $hits)
    {
        $pattern = explode('-', $pattern);
        $count = count($pattern);
        if ($hits != $count) {
            return false;
        }
        foreach ($pattern as $key => $value) {
            if (!is_numeric($value)) {
                return false;
            }
        }
        return true;
    }
}
 ?>
