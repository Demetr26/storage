<?php
/**
 * Created by PhpStorm.
 * User: shkreba
 * Date: 28.12.2016
 * Time: 15:32
 */

namespace app\components\calculation\v2\storage;

use app\components\calculation\v2\loggers\Logger;

/**
 * Class DataStorage
 * @package app\components\calculation\v2\storage
 *
 * @method static setValue(string $name, mixed $value)
 * @method static getValue(string $name)
 * @method static unsetValue(string $name)
 */
class DataStorage
{
    private static $_instance;

    public static function init( array $config = [] ){
        if(!isset($config['class'])){
            $config['class'] = 'app\components\calculation\v2\storage\MemoryStorage';
        }
        Logger::log("Класс DataStorage: ".$config['class'], Logger::LOG_LEVEL_ALL);
        self::$_instance = new $config['class']();
    }

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::init();
        }

        return self::$_instance;
    }

    public static function __callStatic( string $name, array $arguments )
    {
        return call_user_func_array( array(self::getInstance(), $name), $arguments);
    }
}