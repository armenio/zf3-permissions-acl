<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Permissions\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Exception;
use Zend\Permissions\Acl\AclInterface;

/**
 * Class Acl
 * @package Armenio\Permissions\Controller\Plugin
 */
class Acl extends AbstractPlugin
{
    /**
     * @var AclInterface
     */
    protected $acl;

    /**
     * @return AclInterface
     */
    public function __invoke()
    {
        if (!$this->acl instanceof AclInterface) {
            throw new Exception\RuntimeException('No AclInterface instance provided');
        }

        return $this->acl;
    }

    /**
     * @param AclInterface $acl
     * @return $this
     */
    public function setAcl(AclInterface $acl)
    {
        $this->acl = $acl;
        return $this;
    }

    /**
     * @return AclInterface
     */
    public function getAcl()
    {
        return $this->acl;
    }
}
