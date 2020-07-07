<?php

namespace Src\Classes;

class HomeBanner
{

    public $fields;

    public $id;

    public function __construct($id = false)
    {

        $this->id = $id;

        if ($id) {

            $this->map_fields();

        }

    }

    public function render()
    {

        $output = false;

        if ($this->id) {

            $output = [
                'type' => "home",
                'desktop' => $this->fields['home_desktop']['sizes']['home_desktop'],
                'mobile' => $this->fields['home_mobile']['sizes']['home_mobile'],
                'title' => $this->fields['home_title'],
                'text' => $this->fields['home_content'],
                'link' => $this->fields['home_link_text'],
                'url' => $this->fields['home_link_url'],
            ];

            return $output;

        }

        return false;

    }

    private function map_fields()
    {

        $fields = [
            'home_desktop' => '',
            'home_mobile' => '',
            'home_title' => '',
            'home_content' => '',
            'home_link_text' => '',
            'home_link_url' => '',
        ];

        $post_fields = get_fields($this->id);

        foreach ($fields as $key => $value) {

            $fields[$key] = (isset($post_fields[$key])) ? $post_fields[$key] : '';

        }

        $this->fields = $fields;

    }

}
