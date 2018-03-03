<?php
/**
 *
 */
class LythFrameSettings
{
    private $id_unit;
    private $name_unit;
    private $image_url;
    private $spell_name_en;
    private $spell_name_fr;
    private $hits;
    private $spell_frame;
    private $frame_delay_hit;
    private $frame_pattern;


    public function __construct($id_unit = null)
    {
        $this->$def = array(
            'id' => '',
            'name_unit' => '',
            'image_url' => '',
            'spell_name_en' => '',
            'spell_name_fr' => '',
            'hits' => '',
            'spell_frame' => '',
            'frame_delay_hit' => '',
            'frame_pattern' => ''
        );
        if ($id_unit) {
            $result = getItem($id_unit);
            foreach ($result as $key => $value) {
                $this->$def[$key] = $value;
            }
        }
        add_action( 'admin_enqueue_scripts', array($this,'load_wp_media_files' ));
    }
    public function getItem($id_unit)
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
    public static function load_wp_media_files() {
        wp_enqueue_media();
    }
    public function save($null_values = false)
    {
        return (int)$this->id > 0 ? $this->update($null_values) : $this->add($null_values);
    }
    public function add()
    {

    }
    public function update()
    {

    }
    public function delete()
    {

    }
}
