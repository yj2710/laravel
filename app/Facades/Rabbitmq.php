<?php
/**
 *  * Rabbitmq操作
 *
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 *  * @see \App\Component\Queue\Rabbitmq
 *   */
class Rabbitmq extends Facade
{
    /**
     *      * Get the registered name of the component.
     *           *
     *                * @return string
     *                     */
    protected static function getFacadeAccessor()
    {
        return 'Rabbitmq';
    }
}
