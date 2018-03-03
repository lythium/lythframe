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
        if (!isset($_POST['unit_name']) || empty($_POST['unit_name']) || !LythFrameTools::isGenericName($_POST['unit_name'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Name invalid'
            )));
        }
        if (!isset($_POST['image_url']) || empty($_POST['image_url']) || !LythFrameTools::isUrl($_POST['image_url'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'image invalid'
            )));
        }
        if (!isset($_POST['spell_name_en']) || empty($_POST['spell_name_en']) || !LythFrameTools::isGenericName($_POST['spell_name_en'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Spell Name EN invalid'
            )));
        }
        if (!empty($_POST['spell_name_fr'])) {
            if (!LythFrameTools::isGenericName($_POST['spell_name_fr'])) {
                die(json_encode(array(
                    'return' => false,
                    'error' => 'Spell Name FR invalid'
                )));
            }
        }
        if (!isset($_POST['hits']) || empty($_POST['hits']) || !LythFrameTools::isNumeric($_POST['hits'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Hits invalid'
            )));
        } else {
            if (!isset($_POST['frame_delay_hit']) || empty($_POST['frame_delay_hit']) || !LythFrameTools::isPattern($_POST['frame_delay_hit'], $_POST['hits'])) {
                die(json_encode(array(
                    'return' => false,
                    'error' => 'Frame Delay Hit invalid'
                )));
            }
            if (!isset($_POST['frame_pattern']) || empty($_POST['frame_pattern']) || !LythFrameTools::isPattern($_POST['frame_pattern'], $_POST['hits'])) {
                die(json_encode(array(
                    'return' => false,
                    'error' => 'Frame Pattern invalid'
                )));
            }
        }
        if (!isset($_POST['spell_frame']) || empty($_POST['spell_frame']) || !LythFrameTools::isNumeric($_POST['spell_frame'])) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Spell Frame invalid'
            )));
        }
        die(json_encode(array(
            'return' => true,
            'message' => 'success',
            'datapost' => $_POST
        )));
    }
}
