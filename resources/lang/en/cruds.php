<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
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
    'role' => [
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
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
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
            'locale'                   => 'Locale',
            'locale_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'first_name' => 'First Name',
            'first_name_helper' => ' ',
            'last_name' => 'Last Name',
            'last_name_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'birth_date' => 'Birth Date',
            'birth_date_helper' => ' ',
            'phone' => 'Phone',
            'phone_helper' => ' ',
            'bio' => 'Bio',
            'bio_helper' => ' ',
            'background_image'         => 'Background Image',
            'background_image_helper'  => ' ',
            'avatar'                   => 'Avatar',
            'avatar_helper'            => ' ',
            'country_id'                   => 'Location',
            'country_id_helper'            => ' ',
            'currency_id'                   => 'Currency',
            'currency_id_helper'            => ' ',
            'phone_code'                   => 'Phone Code',
            'phone_code_helper'            => ' ',
            'is_notify_email'                   => 'Email Notification',
            'is_notify_email_helper'            => ' ',
            'is_notify_sms'                   => 'SMS Notifications',
            'is_notify_sms_helper'            => ' ',
            'is_notify_push'                   => ' Push Notifications',
            'is_notify_push_helper'            => ' ',
            'is_marketing'                   => 'Marketing',
            'is_marketing_helper'            => ' ',


        ],
    ],
    'sport' => [
        'title'          => 'Sport',
        'title_singular' => 'Sport',
        'fields'         => [
            'id'                            => 'ID',
            'id_helper'                     => ' ',
            'name'                          => 'Name',
            'name_helper'                   => ' ',
            'description'                   => 'Description',
            'description_helper'            => ' ',
            'creator'                       => 'Creator',
            'creator_helper'                => ' ',
            'max_player_per_team'           => 'Max Player Per Team',
            'max_player_per_team_helper'    => ' ',
            'min_player_per_team'           => 'Min Player Per Team',
            'min_player_per_team_helper'    => ' ',
            'is_require_choose_role'        => 'Is Require Choose Role',
            'is_require_choose_role_helper' => ' ',
            'created_at'                    => 'Created at',
            'created_at_helper'             => ' ',
            'updated_at'                    => 'Updated at',
            'updated_at_helper'             => ' ',
            'deleted_at'                    => 'Deleted at',
            'deleted_at_helper'             => ' ',
        ],
    ],
    'team' => [
        'title'          => 'Team',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Name',
            'name_helper'             => ' ',
            'sport'                   => 'Sport',
            'sport_helper'            => ' ',
            'creator'                 => 'Creator',
            'creator_helper'          => ' ',
            'coach'                   => 'Coach',
            'coach_helper'            => ' ',
            'gender'                  => 'Gender',
            'gender_helper'           => ' ',
            'level'                   => 'Level',
            'level_helper'            => ' ',
            'oganization_name'        => 'Oganization Name',
            'oganization_name_helper' => ' ',
            'oganization_url'         => 'Oganization Url',
            'oganization_url_helper'  => ' ',
            'division'                => 'Division',
            'division_helper'         => ' ',
            'season'                  => 'Season',
            'season_helper'           => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Country',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'phone_code'        => 'Phone Code',
            'phone_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'event' => [
        'title'          => 'Event',
        'title_singular' => 'Event',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'event_type'              => 'Event Type',
            'event_type_helper'       => ' ',
            'sport'                   => 'Sport',
            'sport_helper'            => ' ',
            'number_of_team'          => 'Number Of Team',
            'number_of_team_helper'   => ' ',
            'player_per_team'         => 'Player Per Team',
            'player_per_team_helper'  => ' ',
            'application_type'        => 'Application Type',
            'application_type_helper' => ' ',
            'description'             => 'Description',
            'description_helper'      => ' ',
            'start_date_time'         => 'Start Date Time',
            'start_date_time_helper'  => ' ',
            'end_date_time'           => 'End Date Time',
            'end_date_time_helper'    => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'announcement' => [
        'title'          => 'Announcement',
        'title_singular' => 'Announcement',
        'fields'         => [
            'id'                      => 'ID',
            'type'                    => 'Announcement Type',
            'sport'                   => 'Sport',
            'sport_helper'            => ' ',
            'title'                   => 'Title',
            'announcement_type_helper'=> ' ',
            'about'                   => 'About ',
            'status'                  => 'status',
            'start_date'              => 'Start Date',
            'start_date_helper'       => ' ',
            'end_date'                => 'End Date',
            'end_date_helper'         => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'status_helper'           => ' ',
            'title_helper'            => ' ',
            'about_helper'            => ' ',
            'start_date_helper'       => ' ',
            'end_date_helper'         => ' ',
        ],
    ],
    'content' => [
        'title'          => 'Contents',
        'title_singular' => 'Content',
    ],
    'system' => [
        'title'          => 'Systems',
        'title_singular' => 'System',
    ],
    'currency' => [
        'title' => 'Currency',
        'title_singular' => 'Currency',
        'create' => 'Add Currency',
        'fields' => [
            'id'            => 'ID',
            'name'          => "Name",
            'code'          => 'Code',
            'symbol'        => 'Symbol',
            'id_helper'     => ' ',
            'code_helper'   => ' ',
            'symbol_helper' => ' ',
            'name_helper'   => ' ',
        ],
    ],

];
