<?php
/**
 * Created by PhpStorm.
 * User: Robert Gabriel Dinu
 * Date: 12/29/14
 * Time: 13:00
 */

namespace Vjroby\LaravelPbkdf2\Facades;


use Illuminate\Support\Facades\Facade;

class Pbkdf2Facade extends Facade{

    /**
     * Get the registered name of the component
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor()
    {
        return 'vjroby-laravel-pbkdf2';
    }

} // end of class