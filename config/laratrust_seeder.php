<?php

/* 
we will use WordPress roles in our App: https://codex.wordpress.org/Roles_and_Capabilities
Super Admin – somebody with access to the site network administration features and all other features. See the Create a Network article.
Administrator (slug: 'administrator') – somebody who has access to all the administration features within a single site.
Editor (slug: 'editor') – somebody who can publish and manage posts including the posts of other users.
Author (slug: 'author') – somebody who can publish and manage their own posts.
Contributor (slug: 'contributor') – somebody who can write and manage their own posts but cannot publish them.
Subscriber (slug: 'subscriber') – somebody who can only manage their profile.
*/

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
                //acl means managing user permissions
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'editor' => [
            'profile' => 'r,u'
        ],
        'author' => [
            'profile' => 'r,u'
        ],
        'contributor' => [
            'profile' => 'r,u'
        ],
        'supporter' => [
            'profile' => 'r,u'
        ],
        'subscriber' => [
            'profile' => 'r,u'
        ],
    ],
    'permission_structure' => [
        // 'cru_user' => [
        //     'profile' => 'c,r,u'
        // ],
            //this would be if you wanted to set up user that has specific permissions
            //we don't need this, so I commented this out.
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
