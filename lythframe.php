<?php
/*
Plugin Name: LythFrame
Plugin URI: https://www.Lythium.fr/
Description: Manage Unit frame list
Version: 1.0
Author: Ever Team
Author URI: https://www.team-ever.com/
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class LythFrame
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // Plugin Details
        $this->plugin               = new stdClass;
        $this->plugin->name         = 'lythframe'; // Plugin Folder
        $this->plugin->displayName  = 'LythFrame'; // Plugin Name
        $this->plugin->version      = '1.0.0';
        $this->plugin->folder       = plugin_dir_path(__FILE__);
        $this->plugin->url          = plugin_dir_url(__FILE__);

        add_action('admin_menu', array($this,'add_admin_menu'));
        add_action('admin_bar_menu', array($this, 'custom_toolbar_link'), 999);

        add_action('admin_enqueue_scripts', array($this, 'framedelay_scripts_admin' ));

        include_once plugin_dir_path(__FILE__).'class/LythFrameSettingsClass.php';
        new LythFrameSettings();

        include_once plugin_dir_path(__FILE__).'controller/LythFrameTools.php';
        new LythFrameTools();

        include_once plugin_dir_path(__FILE__).'controller/LythFrameValidate.php';
        new LythFrameValidate();

        include_once plugin_dir_path(__FILE__).'controller/LythFrameCore.php';
        New LythFrameCore();
        //Create on install
        register_activation_hook(__FILE__, array(__CLASS__, 'lythframe_install' ));

        //Delete on uninstall
        register_deactivation_hook(__FILE__, array(__CLASS__, 'lythframe_uninstall' ));
    }


    static function lythframe_install()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $sql_lythFrame = "CREATE TABLE {$wpdb->prefix}lythframe (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            unit_name varchar(255) NOT NULL,
            img_dir varchar(255) NOT NULL,
            url_post varchar(255) DEFAULT '0' NOT NULL,
            spell_name_en varchar(255) NOT NULL,
            spell_name_fr varchar(255) DEFAULT '0' NOT NULL,
            spell_frame int(5) NOT NULL,
            frame_delay int(5) NOT NULL,
            frame_delay_hit varchar(255) NOT NULL,
            frame_pattern varchar(255) NOT NULL,
            UNIQUE KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_lythFrame);
    }

    static function lythframe_uninstall()
    {
        global $wpdb;

        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}lythframe");
    }


    static function add_admin_menu()
     {
        add_menu_page('Frame Delay list',
            'Frame Delay list',
            'manage_options',
            'lythframelist',
            array($this, 'lythFrameList')
        );
        add_submenu_page('lythframelist',
            'Delay list',
            'Delay list',
            'manage_options',
            'lythframelist',
            array($this, 'lythFrameList')
        );
        add_submenu_page('lythframelist',
            'Add unit',
            'Add unit',
            'manage_options',
            'lythframeadd',
            array($this, 'lythFrameAddItem')
        );
     }

    static function custom_toolbar_link($wp_admin_bar) {
         $args = array(
             'id' => 'lythframelist',
             'title' => 'Frame Delay list',
             'href' => get_admin_url().'admin.php?page=lythframelist',
             'meta' => array(
                 'class' => 'lythframe',
                 'title' => 'Frame Delay list'
                 )
         );
         $wp_admin_bar->add_node($args);

     // Add the first child link

         $args = array(
             'id' => 'list-frame',
             'title' => 'Delay list',
             'href' => get_admin_url().'admin.php?page=lythframelist',
             'parent' => 'lythframelist',
             'meta' => array(
                 'class' => 'lythframe',
                 'title' => 'Delay list'
                 )
         );
         $wp_admin_bar->add_node($args);

     // Add another child link
     $args = array(
             'id' => 'add-frame',
             'title' => 'Add unit',
             'href' => get_admin_url().'admin.php?page=lythframeadd',
             'parent' => 'lythframelist',
             'meta' => array(
                 'class' => 'lythframe',
                 'title' => 'Add unit'
                 )
         );
         $wp_admin_bar->add_node($args);
    }

    static function framedelay_scripts_admin()
    {
        // Ajax
        wp_register_script( 'ajaxHandle', get_site_url() . '/wp-content/plugins/lythframe/views/js/ajax.js', array(), false, true );
        wp_enqueue_script( 'ajaxHandle' );
        wp_localize_script( 'ajaxHandle', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        // CSS
        wp_register_style( 'lythframeadmincss', get_site_url() . '/wp-content/plugins/lythframe/views/css/main_admin_style.css' );
        wp_enqueue_style( 'lythframeadmincss' );
    }

    static function lythFrameList()
    {
        // Load List
        include_once(WP_PLUGIN_DIR.'/lythframe/views/admin/list.php');
    }

    static function lythFrameAddItem()
    {
        // Load add Form
        include_once(WP_PLUGIN_DIR.'/lythframe/views/admin/additem.php');
    }
}
new LythFrame();
?>
