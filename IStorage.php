<?php
/**
 * Created by PhpStorm.
 * User: shkreba
 * Date: 16.12.2016
 * Time: 12:29
 */

namespace app\components\calculation\v2\storage;


use app\components\calculation\v2\Logger;

interface IStorage
{

    public function getValue( $name );

    public function setValue($name, $value);

    public function putItem( &$array , $name, $value);

    public function unsetValue( $name );
}