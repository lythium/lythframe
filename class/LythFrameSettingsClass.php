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
        $this->id_unit = '';
        $this->name_unit = '';
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
            $nbIndex = count($_POST['save_unit_name']);
            for ($i = 0; $i <= $nbIndex; $i++) {
                $obj = New LythFrameSettings();
                $obj->name_unit = $_POST['save_unit_name'];
                $obj->image_url = $_POST['save_image_url'];
                $obj->spell_name_en = $_POST['save_spell_name_en'];
                $obj->spell_name_fr = $_POST['save_spell_name_fr'];
                $obj->hits = $_POST['save_hits'];
                $obj->spell_frame = $_POST['save_spell_frame'];
                $obj->frame_delay_hit = $_POST['save_frame_delay_hit'];
                $obj->frame_pattern = $_POST['save_frame_pattern'];
                $obj->add();
            };
            die(json_encode(array(
                'return' => true,
                'message' => 'success',
                'datapost' => $obj
            )));
        } else {
            die(json_encode(array(
                'return' => false,
                'error' => 'error'
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
        $wpdb->insert(
            "{$wpdb->prefix}lythframe",
            array(
                'name_unit' => $this->name_unit,
                'image_url' => $this->image_url,
                'spell_name_en' => $this->spell_name_en,
                'spell_name_fr' => $this->spell_name_en,
                'hits' => $this->hits,
                'spell_frame' => $this->spell_frame,
                'frame_delay_hit' => $this->frame_delay_hit,
                'frame_pattern' => $this->frame_pattern
            )
        );
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
