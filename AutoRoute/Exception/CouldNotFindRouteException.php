<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2013 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\Exception;

/**
 * @author Daniel Leech <daniel@dantleech.com>
 */
class CouldNotFindRouteException extends \Exception
{
    public function __construct($path)
    {
        $message = sprintf('Could not find route component at path "%s".',
            $path
        );

        parent::__construct($message);
    }
}
