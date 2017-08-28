<?php


namespace Profit\Nordea\API;


class Helper
{
    static public function copyAttributes(&$base, &$source, array $attr_list)
    {
        foreach($attr_list as $key){
            if(!empty($source->$key)){
                $method = 'set' . ucfirst(str_camel_case($key));
                if(method_exists($base, $method)){
                    $base->{$method}($source->$key);
                } else {
                    $base->{ucfirst(str_camel_case($key))} = $source->$key;
                }
            }
        }
    }

    static public function hexRandom($length = 32)
    {
        return join('',array_map(function(){
            return dechex(random_int(0,15));
        },range(0, $length)));
    }
}