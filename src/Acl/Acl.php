<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
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
     * @example Role = admin, Resource = IndexController, privilege = home
     *
     * [
     *     'admin' => [
     *         'IndexController' => [
     *             'home',
     *         ],
     *     ],
     * ]
     *
     * @param array $roleResourcePrivileges
     * @return $this
     */
    public function setRoleResourcePrivileges(array $roleResourcePrivileges)
    {
        if (empty($roleResourcePrivileges)) {
            throw new InvalidArgumentException('Invalid Role Resource Privileges');
        }

        $this->roleResourcePrivileges = $roleResourcePrivileges;

        $this->addRules();

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
    public function addRules()
    {
        if (empty($this->roleResourcePrivileges)) {
            return;
        }

        foreach ($this->roleResourcePrivileges as $roleName => $resources) {
            if (!$this->hasRole($roleName)) {
                $this->addRole(new Role($roleName));
            }

            if (empty($resources)) {
                continue;
            }

            foreach ($resources as $resourceName => $privileges) {
                if (!$this->hasResource($resourceName)) {
                    $this->addResource(new Resource($resourceName));
                }

                if (empty($privileges)) {
                    continue;
                }

                foreach ($privileges as $privilegeName) {
                    $this->allow($roleName, $resourceName, $privilegeName);
                }
            }
        }
    }
}