<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Permissions\Controller\Plugin;

use Armenio\Permissions\Acl\Acl;
use Armenio\Permissions\Controller\Plugin\Acl as AclPlugin;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AclFactory
 * @package Armenio\Permissions\Controller\Plugin
 */
class AclFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param array|null $options
     * @return \Armenio\Permissions\Controller\Plugin\Acl|object
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $helper = new AclPlugin();

        if ($container->has(Acl::class)) {
            $helper->setAcl($container->get(Acl::class));
        }

        return $helper;
    }
}
