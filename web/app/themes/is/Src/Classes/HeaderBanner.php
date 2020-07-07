<?php

namespace Src\Classes;

class HeaderBanner
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

            switch ($this->fields['banner_type']) {
                case "none":
                    return false;
                    break;
                case "shallow":
                    $output = [
                        'type' => "shallow",
                        'desktop' => $this->fields['banner_shallow_desktop']['sizes']['shallow_desktop'],
                        'mobile' => $this->fields['banner_shallow_mobile']['sizes']['shallow_mobile'],
                        'overlay' => ($this->fields['banner_has_overlay'] === true) ? [ 'colour' => $this->fields['banner_overlay_colour'], 'opacity' => $this->fields['banner_overlay_opacity'] ] : false,
                        'title' => $this->fields['banner_title'],
                        'text' => $this->fields['banner_content'],
                    ];
                    break;
                case "deep":
                    $output = [
                        'type' => "deep",
                        'desktop' => $this->fields['banner_deep_desktop']['sizes']['deep_desktop'],
                        'mobile' => $this->fields['banner_deep_mobile']['sizes']['deep_mobile'],
                        'overlay' => ($this->fields['banner_has_overlay'] === true) ? [ 'colour' => $this->fields['banner_overlay_colour'], 'opacity' => $this->fields['banner_overlay_opacity'] ] : false,
                        'title' => $this->fields['banner_title'],
                        'text' => $this->fields['banner_content'],
                    ];
                    break;
            }

            return $output;

        }

        return false;

    }

    private function map_fields()
    {

        $fields = [
            'banner_type' => 'none',
            'banner_shallow_desktop' => '',
            'banner_shallow_mobile' => '',
            'banner_deep_desktop' => '',
            'banner_deep_mobile' => '',
            'banner_has_overlay' => false,
            'banner_overlay_colour' => '',
            'banner_overlay_opacity' => '',
            'banner_title' => '',
            'banner_content' => '',
        ];

        $post_fields = get_fields($this->id);

        foreach ($fields as $key => $value) {

            $fields[$key] = (isset($post_fields[$key])) ? $post_fields[$key] : '';

        }

        $this->fields = $fields;

    }

}
