<?php

namespace Unscaled\UnscaledLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Unscaled\UnscaledLaravel\Skeleton\SkeletonClass
 */
class UnscaledLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'unscaled-laravel';
    }
}
