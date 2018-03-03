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
        $this->def = array(
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
            $result = LythFrameCore::getItem($id_unit);
            foreach ($result as $key => $value) {
                $this->$def[$key] = $value;
            }
        }

        add_action( 'wp_ajax_ajaxProcess', array($this, 'ajaxProcess' ));
        add_action( 'wp_ajax_nopriv_ajaxProcess', array($this, 'ajaxProcess' ));
    }

    public static function ajaxProcess() {
        if (isset($_POST) || !empty($_POST)) {
            die(json_encode(array(
                'return' => true,
                'message' => 'success',
                'datapost' => $_POST
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

    public function add($object)
    {
        global $wpdb;
        $wpdb->insert(
            "{$wpdb->prefix}lythframe",
            array(
                'id' => $object->def['id'],
                'name_unit' => $object->def['name_unit'],
                'image_url' => $object->def['image_url'],
                'spell_name_en' => $object->def['spell_name_en'],
                'spell_name_fr' => $object->def['spell_name_en'],
                'hits' => $object->def['hits'],
                'spell_frame' => $object->def['spell_frame'],
                'frame_delay_hit' => $object->def['frame_delay_hit'],
                'frame_pattern' => $object->def['frame_pattern']
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
