<?php
/**
 *Data injuction container
 * add data  and bind it with the given key
 * and use when need by calling that key
 */
namespace Core;

class App
{
        protected static $registry = [];

        public static function  bind($key, $value)
        {
                static::$registry[$key] = $value;
        }

        public static function get($key)
        {
                if(! array_key_exists($key, static::$registry)){
                        throw new Exception("No {$key} is bound in this container", 1);
                }
                return static::$registry[$key];
        }
}
 ?>
