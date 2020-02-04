<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Permissions\View\Helper;

use Zend\Permissions\Acl\AclInterface;
use Zend\View\Exception;
use Zend\View\Helper\AbstractHelper;

/**
 * Class Acl
 * @package Armenio\Permissions\View\Helper
 */
class Acl extends AbstractHelper
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
