<?php

/**
 * SilverEngine  - PHP MVC framework
 *
 * @package     SilverEngine
 * @author      SilverEngine Team
 * @copyright   2015-2017
 * @license     MIT
 * @link        https://github.com/SilverEngine/Framework
 *
 */

namespace Silver\Ghost\Components;


class Variables
{
    public function output($params)
    {
        $pattern = $params[0];
        $file    = $params[1];
        $patt    = $params[2];
        $data    = $params[3];

        $content =  file_get_contents($file);
        $content = preg_replace_callback($pattern,function($match) use($patt, $data){

            if($patt) $match =  htmlentities(trim(preg_replace($patt, null, $match[0])));

            // if dot access notation
            if (preg_match("#\.+#", $match)) {
                $keys = explode(".",  $match);


                $temp = &$data;

                foreach ($keys as $key) {

                    if (!isset($temp[$key])) return $key;

                    $temp = &$temp[$key];
                }
                return $temp;
            }

            if (!isset($data[$match])) return is_array($data[$match]) ? "array" : $data[$match];

            return is_array($data[$match]) ? "array" : $data[$match];


        }, $content);

        return $content;
    }
}