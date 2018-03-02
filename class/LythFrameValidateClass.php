<?php
/**
 *
 */
class LythFrameValidate
{
    function __construct()
    {
        add_action( 'wp_ajax_validateProcess', array($this, 'validateProcess' ));
        add_action( 'wp_ajax_nopriv_validateProcess', array($this, 'validateProcess' ));
    }
    public static function validateProcess()
    {
        if (!isset($_POST['unit_name']) || empty($_POST['unit_name']) || !$this->isGenericName($_POST['unit_name'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Name invalid'
            )));
        }
        if (!isset($_POST['image_url']) || empty($_POST['image_url']) || !$this->isUrl($_POST['image_url'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'mail invalid'
            )));
        }
        if (!isset($_POST['spell_name_en']) || empty($_POST['spell_name_en']) || !$this->isGenericName($_POST['spell_name_en'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Spell Name EN invalid'
            )));
        }
        if (!empty($_POST['spell_name_fr'])) {
            if (!$this->isGenericName($_POST['spell_name_fr'])) {
                die(json_encode(array(
                    'return' => false,
                    'error' => 'Spell Name FR invalid'
                )));
            }
        }
        if (!isset($_POST['hits']) || empty($_POST['hits']) || !$this->isNumeric($_POST['hits'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Hits invalid'
            )));
        } else {
            if (!isset($_POST['frame_delay_hit']) || empty($_POST['frame_delay_hit']) || !$this->isPattern($_POST['frame_delay_hit'], $_POST['hits'])) {
                die(json_encode(array(
                    'return' => false,
                    'error' => 'Frame Delay Hit invalid'
                )));
            }
            if (!isset($_POST['frame_pattern']) || empty($_POST['frame_pattern']) || !$this->isPattern($_POST['frame_pattern'], $_POST['hits'])) {
                die(json_encode(array(
                    'return' => false,
                    'error' => 'Frame Pattern invalid'
                )));
            }
        }
        if (!isset($_POST['spell_frame']) || empty($_POST['spell_frame']) || !$this->isNumeric($_POST['spell_frame'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Spell Frame invalid'
            )));
        }
        die(json_encode(array(
            'return' => true,
            'message' => 'success'
        )));
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
        return preg_match("/^[a-zA-ZÀ-ÿ'. -]+$/", $name);
    }
    public static function isPattern( string $pattern, int $hit_count)
    {
        if (!preg_match('/^\d+(?:-\d+)*$/', $pattern)) {
            return false;
        }
        $hits = explode('-', $pattern);

        if ($hit_count !== count($hits)) {
            return false;
        }

        return true;
    }
}
 ?>
