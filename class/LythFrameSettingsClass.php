<?php
/**
 *
 */
class LythFrameSettings
{
    public function __construct()
    {
        add_action( 'admin_enqueue_scripts', array($this,'load_wp_media_files' ));
    }
    
    public static function getList()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}lythframe");
        if (!$results) {
            $results = false;
        }
        return $results;
    }
    public static function load_wp_media_files() {
        wp_enqueue_media();
    }
}

 ?>
