<?php
/**
 *
 */
class LythFrameCore
{
    function __construct()
    {
        add_action( 'admin_enqueue_scripts', array($this,'load_wp_media_files' ));

        add_action( 'wp_ajax_addProcess', array($this, 'addProcess' ));
        add_action( 'wp_ajax_nopriv_addProcess', array($this, 'addProcess' ));

        add_action( 'wp_ajax_updateProcess', array($this, 'updateProcess' ));
        add_action( 'wp_ajax_nopriv_updateProcess', array($this, 'updateProcess' ));
    }

    public static function addProcess() {
        if (isset($_POST) || !empty($_POST)) {
            $nbIndex = (int)count($_POST['save_unit_name']);
            if ($nbIndex == 0) {
                die(json_encode(array(
                    'return' => false,
                    'error' => 'List Empty'
                )));
            }
            for ($a=0; $a < $nbIndex; $a++)  {
                $obj = new LythFrameSettings();
                $obj->id = null;
                $obj->unit_name = $_POST['save_unit_name'][$a];
                $obj->image_url = $_POST['save_image_url'][$a];
                $obj->url_post = $_POST['save_url_post'][$a];
                $obj->spell_name_en = $_POST['save_spell_name_en'][$a];
                $obj->spell_name_fr = $_POST['save_spell_name_fr'][$a];
                $obj->hits = $_POST['save_hits'][$a];
                $obj->spell_frame = $_POST['save_spell_frame'][$a];
                $obj->frame_delay_hit = $_POST['save_frame_delay_hit'][$a];
                $obj->frame_pattern = $_POST['save_frame_pattern'][$a];

                if (!$obj->add()) {
                    die(json_encode(array(
                        'return' => false,
                        'error' => 'add failed'
                    )));
                }
            };
            die(json_encode(array(
                'return' => true,
                'message' => 'success for '.$a.' add'
            )));
        } else {
            die(json_encode(array(
                'return' => false,
                'error' => 'Data invalid'
            )));
        };
    }

    public static function updateProcess() {
        if (isset($_POST) || !empty($_POST)) {
            if ($_POST['submit-type'] == "update") {
                $dif = 0;
                $obj = new LythFrameSettings($_POST["id"]);

                foreach ($obj as $key => $value) {
                    if ($value !== $_POST[$key]) {
                        $obj->$key = $_POST[$key];
                        $dif++;
                    };
                };
                if ($dif > 0) {
                    if (!$obj->update()) {
                        die(json_encode(array(
                            'return' => false,
                            'error' => 'update failed'
                        )));
                    };
                    die(json_encode(array(
                        'return' => true,
                        'message' => 'success update'
                    )));
                };
                die(json_encode(array(
                    'return' => false,
                    'error' => 'no dif'
                )));
            }
        } else {
            die(json_encode(array(
                'return' => false,
                'error' => 'Data for update invalid'
            )));
        };
    }

    public static function getItem($id_unit)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}lythframe WHERE id = $id_unit");
        if (!$result) {
            $result = false;
        }
        return $result;
    }
    public static function getList()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}lythframe ORDER BY spell_frame ASC, hits ASC, frame_pattern + 1 ASC",OBJECT);
        if (!$results) {
            $results = false;
        }
        return $results;
    }
    public static function getListFront()
    {
        global $wpdb;
        for ($i=0; $i < 15 ; $i++) {
            $resultForFrame = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}lythframe WHERE spell_frame = '$i' ORDER BY hits ASC, frame_pattern + 1 ASC",OBJECT);
            if ($resultForFrame) {
                $results[$i] = array(
                    'frame' => $i,
                    'list' => $resultForFrame
                );
            }
        }
        if (!$results) {
            $results = false;
        }
        return $results;
    }
    public function load_wp_media_files() {
        wp_enqueue_media();
    }

    public static function image_id_by_url( $image_url ) {
        global $wpdb;

        if( empty( $image_url ) ) {
            return false;
        }

        $query_arr = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        $image_id = (!empty( $query_arr )) ? $query_arr[0] : 0;

        return $image_id;
    }
}
