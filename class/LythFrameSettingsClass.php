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


    public function __construct($id_unit = null)
    {
        // $def = array(
        //     'id' => '',
        //     'name_unit' => '',
        //     'image_url' => '',
        //     'spell_name_en' => '',
        //     'spell_name_fr' => '',
        //     'hits' => '',
        //     'spell_frame' => '',
        //     'frame_delay_hit' => '',
        //     'frame_pattern' => ''
        // );
        $this->id = '';
        $this->unit_name = '';
        $this->image_url = '';
        $this->spell_name_en = '';
        $this->spell_name_fr = '';
        $this->hits = '';
        $this->spell_frame = '';
        $this->frame_delay_hit = '';
        $this->frame_pattern = '';

        if ($id_unit) {
            $result = LythFrameCore::getItem($id_unit);
            foreach ($result as $key => $value) {
                $this->$key = $value;
            }
        }

        add_action( 'wp_ajax_ajaxProcess', array($this, 'ajaxProcess' ));
        add_action( 'wp_ajax_nopriv_ajaxProcess', array($this, 'ajaxProcess' ));
    }

    public static function ajaxProcess() {
        if (isset($_POST) || !empty($_POST)) {
            $nbIndex = (int)count($_POST['save_unit_name']);
            for ($a=0; $a < $nbIndex; $a++)  {
                $obj = new LythFrameSettings();
                $obj->id = null;
                $obj->unit_name = $_POST['save_unit_name'][$a];
                $obj->image_url = $_POST['save_image_url'][$a];
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
                'error' => 'Post invalid'
            )));
        };
    }

    public function save($null_values = false)
    {
        return (int)$this->id > 0 ? $this->update($null_values) : $this->add($null_values);
    }

    public function add()
    {
        global $wpdb;
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
