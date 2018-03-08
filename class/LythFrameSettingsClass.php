<?php
/**
 *
 */
class LythFrameSettings
{
    public $id;
    public $unit_name;
    public $image_url;
    public $url_post;
    public $spell_name_en;
    public $spell_name_fr;
    public $hits;
    public $spell_frame;
    public $frame_delay_hit;
    public $frame_pattern;


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
        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}lythframe WHERE unit_name = '$this->unit_name'");
        if (!empty($results)) {
            foreach ($results as $row) {
                if (($this->spell_name_en === $row->spell_name_en) && ($this->frame_pattern === $row->frame_pattern) && ($this->hits === $row->hits)) {
                    return false;
                }
            }
        };
        if (!empty($this->url_post)) {
            $url_post = $this->url_post;
        } else {
            $url_post = '';
        };
        if (!empty($this->spell_name_fr)) {
            $spell_name_fr = $this->spell_name_fr;
        } else {
            $spell_name_fr = '';
        };
        $args = array(
            'unit_name' => $this->unit_name,
            'image_url' => $this->image_url,
            'url_post' => $url_post,
            'spell_name_en' => $this->spell_name_en,
            'spell_name_fr' => $spell_name_fr,
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
        global $wpdb;
        $args = array(
            'unit_name' => $this->unit_name,
            'image_url' => $this->image_url,
            'url_post' => $this->url_post,
            'spell_name_en' => $this->spell_name_en,
            'spell_name_fr' => $this->spell_name_fr,
            'hits' => $this->hits,
            'spell_frame' => $this->spell_frame,
            'frame_delay_hit' => $this->frame_delay_hit,
            'frame_pattern' => $this->frame_pattern
        );
        if (!$wpdb->update("{$wpdb->prefix}lythframe", $args, array('id' => $this->id), array( '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s'), array('%d'))) {
            return false;
        }
        return true;
    }

    public function delete()
    {
        global $wpdb;
        if (!$wpdb->delete("{$wpdb->prefix}lythframe", array('id' => $this->id), array('%d'))) {
            return false;
        }
        return true;
    }
}
