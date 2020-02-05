<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Permissions\Acl;

use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Exception\InvalidArgumentException;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Zend\Permissions\Acl\Role\GenericRole as Role;

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

        $this->addRules();

        return $this;
    }

    /**
     * @return array
     */
    public function getRoleResourcePrivileges()
    {
        return $this->roleResourcePrivileges;
    }

    /**
     * @return void
     */
    protected function addRules()
    {
        $roleResourcePrivileges = $this->getRoleResourcePrivileges();

        foreach ($roleResourcePrivileges as $roleName => $resources) {
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

    /**
     * @param  \Zend\Permissions\Acl\Role\RoleInterface|string $role
     * @param  \Zend\Permissions\Acl\Resource\ResourceInterface|string $resource
     * @param  string $privilege
     * @return bool
     */
    public function isAllowed($role = null, $resource = null, $privilege = null)
    {
        return $this->hasRole($role) && $this->hasResource($resource) && parent::isAllowed($role, $resource, $privilege);
    }
}