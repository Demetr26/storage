<?php
/**
 * Created by PhpStorm.
 * User: shkreba
 * Date: 16.12.2016
 * Time: 12:31
 */

namespace app\components\calculation\v2\storage;


use app\components\calculation\v2\loggers\Logger;
use yii\helpers\ArrayHelper;

class MemoryStorage implements IStorage
{

    /**
     * @var array
     */
    private static $_data;

    public function __construct()
    {
        self::$_data = Array();
    }

    public function setValue($name, $value)
    {
        $this->putItem( self::$_data , $name, $value);
        Logger::log("Установлено значение в storage по ключу {$name}" , Logger::LOG_LEVEL_ALL);
    }

    public function getValue( $name = "" )
    {
        if($name == ""){
            return self::$_data;
        }
        return ArrayHelper::getValue(self::$_data , $name, false);
    }

    public function putItem( &$array , $name, $value ) {

        if (($pos = strpos($name, '.')) !== false) {
            $this->putItem($array[substr($name, 0, $pos)], substr($name, $pos+1, strlen($name)), $value);
            $name = substr($name, $pos + 1);
        }else{
            $array[$name] = $value;
        }

    }

    public function unsetValue($name)
    {
        return $this->unsetItem( self::$_data, $name);
    }

    public function unsetItem ( &$array , $name){
        if (($pos = strpos($name, '.')) !== false) {
            $this->unsetItem($array[substr($name, 0, $pos)], substr($name, $pos+1, strlen($name)));
            $name = substr($name, $pos + 1);
        }else{
            ArrayHelper::remove( $array , $name);
        }
    }

}