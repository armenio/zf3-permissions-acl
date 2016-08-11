<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Permissions\Acl;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AclFactory
 * @package Armenio\Permissions\Acl
 */
class AclFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param array|null $options
     * @return Acl
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $acl = new Acl();

        return $acl;
    }
}
