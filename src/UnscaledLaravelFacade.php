<?php

namespace Unscaled\UnscaledLaravel;

use Illuminate\Support\Facades\Facade;

/**
 *
 */
class UnscaledLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'unscaled-laravel';
    }
}
