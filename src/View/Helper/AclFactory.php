<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Permissions\View\Helper;

use Armenio\Permissions\Acl\Acl;
use Armenio\Permissions\View\Helper\Acl as AclHelper;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AclFactory
 * @package Armenio\Permissions\View\Helper
 */
class AclFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param array|null $options
     * @return \Armenio\Permissions\View\Helper\Acl|object
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $helper = new AclHelper();

        if ($container->has(Acl::class)) {
            $helper->setAcl($container->get(Acl::class));
        }

        return $helper;
    }
}
