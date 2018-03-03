<?php
/**
 *
 */
class LythFrameCore
{
    function __construct()
    {
        add_action( 'admin_enqueue_scripts', array($this,'load_wp_media_files' ));
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
        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}lythframe DESC spell_frame");
        if (!$results) {
            $results = false;
        }
        return $results;
    }
    public function load_wp_media_files() {
        wp_enqueue_media();
    }

}
