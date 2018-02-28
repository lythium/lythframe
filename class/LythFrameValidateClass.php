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
        if (isset($_POST) && !empty($_POST)) {
            die(json_encode(array(
                'return' => true,
                'message' => 'success'
            )));
        } else {
            die(json_encode(array(
                'return' => false,
                'error' => 'error'
            )));
        }
        die();
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
