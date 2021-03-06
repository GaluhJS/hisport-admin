<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'hiGame'         => [
        'title'          => 'Hi Game',
        'title_singular' => 'Hi Game',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'event'          => [
        'title'          => 'Event',
        'title_singular' => 'Event',
    ],
    'hiVenue'        => [
        'title'          => 'Hi Venue',
        'title_singular' => 'Hi Venue',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'iframe'            => 'Iframe',
            'iframe_helper'     => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'long'              => 'Long',
            'long_helper'       => ' ',
            'lat'               => 'Lat',
            'lat_helper'        => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'hiEvent'        => [
        'title'          => 'Hi Event',
        'title_singular' => 'Hi Event',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'game'                => 'Game',
            'game_helper'         => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'event_banner'        => 'Event Banner',
            'event_banner_helper' => ' ',
            'game_type'           => 'Game Type',
            'game_type_helper'    => ' ',
            'game_level'          => 'Game Level',
            'game_level_helper'   => ' ',
            'price'               => 'Price',
            'price_helper'        => ' ',
            'player_type'         => 'Player Type',
            'player_type_helper'  => ' ',
            'start_date'          => 'Start Date',
            'start_date_helper'   => ' ',
            'finish_date'         => 'Finish Date',
            'finish_date_helper'  => ' ',
            'format'              => 'Format',
            'format_helper'       => ' ',
            'information'         => 'Information',
            'information_helper'  => ' ',
            'venue'               => 'Venue',
            'venue_helper'        => ' ',
            'fee'                 => 'Fee',
            'fee_helper'          => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'hiEventInfo'    => [
        'title'          => 'Hi Event Infos',
        'title_singular' => 'Hi Event Info',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'event'             => 'Event',
            'event_helper'      => ' ',
            'overview'          => 'Overview',
            'overview_helper'   => ' ',
            'rules'             => 'Rules',
            'rules_helper'      => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'location'          => 'Location',
            'location_helper'   => ' ',
            'contact'           => 'Contact',
            'contact_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
