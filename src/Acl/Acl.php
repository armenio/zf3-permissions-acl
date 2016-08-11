<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */

namespace Armenio\Permissions\Acl;

use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Stdlib\Exception\InvalidArgumentException;
use Zend\Stdlib\Exception\RuntimeException;

/**
 * Class Acl
 * @package Armenio\Permissions\Acl
 */
class Acl extends ZendAcl
{
    /**
     * @var array
     */
    protected $roleResourcePrivileges = [];

    /**
     * @param array $roleResourcePrivileges
     * @return $this
     */
    public function setRoleResourcePrivileges(array $roleResourcePrivileges)
    {
        if (empty($roleResourcePrivileges)) {
            throw new InvalidArgumentException('Invalid Role Resource Privileges');
        }
        $this->roleResourcePrivileges = $roleResourcePrivileges;
        $this->addRoleResourcePrivileges();
        return $this;
    }

    /**
     * @return array
     */
    public function getRoleResourcePrivileges()
    {
        if (empty($this->roleResourcePrivileges)) {
            throw new RuntimeException('Empty Role Resource Privileges');
        }
        return $this->roleResourcePrivileges;
    }

    /**
     * @return void
     */
    public function addRoleResourcePrivileges()
    {
        foreach ($this->roleResourcePrivileges as $roleName => $resources) {
            if (!$this->hasRole($roleName)) {
                $this->addRole(new Role($roleName));
            }

            foreach ($resources as $resourceName => $privileges) {
                if (!$this->hasResource($resourceName)) {
                    $this->addResource(new Resource($resourceName));
                }

                foreach ($privileges as $privilegeName) {
                    $this->allow($roleName, $resourceName, $privilegeName);
                }
            }
        }
    }

    /**
     * @param  Zend\Permissions\Acl\Role\RoleInterface|string $role
     * @param  Zend\Permissions\Acl\Resource\ResourceInterface|string $resource
     * @param  string $privilege
     * @return bool
     */
    public function isAllowed($role = null, $resource = null, $privilege = null)
    {
        if (!$this->hasRole($role)) {
            return false;
        }

        if (!$this->hasResource($resource)) {
            return false;
        }

        return parent::isAllowed($role, $resource, $privilege);
    }
}