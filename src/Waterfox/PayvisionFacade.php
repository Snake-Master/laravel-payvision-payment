<?php 
namespace Waterfox\Payvision;

class PayvisionFacade extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'payvision';
    }
}