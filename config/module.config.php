<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Permissions;

return [
    'service_manager' => [
        'factories' => [
            Acl\Acl::class => Acl\AclFactory::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'acl' => Controller\Plugin\AclFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'acl' => View\Helper\AclFactory::class,
        ],
    ],
];