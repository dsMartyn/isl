<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 08/11/2018
 * Time: 12:00
 */

namespace Services\Config;

class CustomConfigLoader
{

    public function mergeFile($key, $path)
    {

        if (empty($key)) {
            throw new \Exception();
        }

        $config = \App\sage('config');

        $existing = (is_array($config->get($key))) ? $config->get($key) : [];

        $config->set($key,
            array_merge(
                $existing,
                array_merge_recursive(
                    $existing,
                    require $path
                )
            )
        );

        return $config;

    }


}
