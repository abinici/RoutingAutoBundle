<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2013 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\PathExists;

use Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\PathActionInterface;
use Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\RouteStack;
use Doctrine\ODM\PHPCR\DocumentManager;

/**
 * @author Daniel Leech <daniel@dantleech.com>
 */
class UsePath implements PathActionInterface
{
    protected $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function init(array $options)
    {
    }

    public function execute(RouteStack $routeStack)
    {
        $paths = $routeStack->getFullPaths();

        foreach ($paths as $path) {
            $route = $this->dm->find(null, $path);

            if (!$route) {
                throw new \RuntimeException(sprintf(
                    'Expected to find a document at "%s",  but didn\'t. This shouldn\'t
                    happen. Maybe we have a race condition?',
                    $path
                ));
            }

            $routeStack->addRoute($route);
        }
    }
}
