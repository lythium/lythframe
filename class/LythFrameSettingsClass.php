<?php
/**
 *
 */
class LythFrameSettings
{
    public $id;
    public $unit_name;
    public $image_url;
    public $spell_name_en;
    public $spell_name_fr;
    public $hits;
    public $spell_frame;
    public $frame_delay_hit;
    public $frame_pattern;
    public $url_post;


    public function __construct($id_unit = null)
    {
        if ($id_unit) {
            $result = LythFrameCore::getItem($id_unit);
            foreach ($result[0] as $key => $value) {
                $this->$key = $value;
            }
        }
    }



    public function save($null_values = false)
    {
        return (int)$this->id > 0 ? $this->update($null_values) : $this->add($null_values);
    }

    public function add()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}lythframe WHERE unit_name = '$this->unit_name' AND spell_name_en = '$this->spell_name_en'");
        if (!empty($results)) {
            die(json_encode(array(
                'return' => false,
                'error' => 'Unit already exists'
            )));
        };
        $args = array(
            'unit_name' => $this->unit_name,
            'image_url' => $this->image_url,
            'spell_name_en' => $this->spell_name_en,
            'spell_name_fr' => $this->spell_name_fr,
            'hits' => $this->hits,
            'spell_frame' => $this->spell_frame,
            'frame_delay_hit' => $this->frame_delay_hit,
            'frame_pattern' => $this->frame_pattern
        );
        if (!$wpdb->insert("{$wpdb->prefix}lythframe", $args)) {
            return false;
        }
        return true;
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
