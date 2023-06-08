<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'coaches' => [
        'name' => 'Coaches',
        'index_title' => 'AllCoaches List',
        'new_title' => 'New Coaches',
        'create_title' => 'Create Coaches',
        'edit_title' => 'Edit Coaches',
        'show_title' => 'Show Coaches',
        'inputs' => [
            'user_id' => 'User',
        ],
    ],

    'players' => [
        'name' => 'Players',
        'index_title' => 'AllPlayers List',
        'new_title' => 'New Players',
        'create_title' => 'Create Players',
        'edit_title' => 'Edit Players',
        'show_title' => 'Show Players',
        'inputs' => [
            'user_id' => 'User',
            'teams_id' => 'Teams',
            'jersey_number' => 'Jersey Number',
            'height' => 'Height',
            'weight' => 'Weight',
            'age' => 'Age',
        ],
    ],

    'games' => [
        'name' => 'Games',
        'index_title' => 'AllGames List',
        'new_title' => 'New Games',
        'create_title' => 'Create Games',
        'edit_title' => 'Edit Games',
        'show_title' => 'Show Games',
        'inputs' => [
            'home_team_id' => 'Home Team Id',
            'away_team_id' => 'Away Team Id',
            'location' => 'Location',
            'date' => 'Date',
            'start_time' => 'Start Time',
        ],
    ],

    'practices' => [
        'name' => 'Practices',
        'index_title' => 'AllPractices List',
        'new_title' => 'New Practices',
        'create_title' => 'Create Practices',
        'edit_title' => 'Edit Practices',
        'show_title' => 'Show Practices',
        'inputs' => [
            'teams_id' => 'Teams',
            'location' => 'Location',
            'date' => 'Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ],
    ],

    'event_types' => [
        'name' => 'Event Types',
        'index_title' => 'AllEventTypes List',
        'new_title' => 'New Event types',
        'create_title' => 'Create EventTypes',
        'edit_title' => 'Edit EventTypes',
        'show_title' => 'Show EventTypes',
        'inputs' => [
            'type' => 'Type',
            'name' => 'Name',
        ],
    ],

    'notifications' => [
        'name' => 'Notifications',
        'index_title' => 'AllNotifications List',
        'new_title' => 'New Notifications',
        'create_title' => 'Create Notifications',
        'edit_title' => 'Edit Notifications',
        'show_title' => 'Show Notifications',
        'inputs' => [
            'games_id' => 'Games',
            'practices_id' => 'Practices',
            'event_types_id' => 'Event Types',
            'title' => 'Title',
            'message' => 'Message',
            'sent_at' => 'Sent At',
        ],
    ],

    'event_statistics' => [
        'name' => 'Event Statistics',
        'index_title' => 'AllEventStatistics List',
        'new_title' => 'New Event statistics',
        'create_title' => 'Create EventStatistics',
        'edit_title' => 'Edit EventStatistics',
        'show_title' => 'Show EventStatistics',
        'inputs' => [
            'games_id' => 'Games',
            'players_id' => 'Players',
            'points' => 'Points',
            'rebounds' => 'Rebounds',
            'assists' => 'Assists',
            'blocks' => 'Blocks',
            'steals' => 'Steals',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'maritial_status' => 'Maritial Status',
            'address' => 'Address',
            'password' => 'Password',
        ],
    ],

    'teams' => [
        'name' => 'Teams',
        'index_title' => 'AllTeams List',
        'new_title' => 'New Teams',
        'create_title' => 'Create Teams',
        'edit_title' => 'Edit Teams',
        'show_title' => 'Show Teams',
        'inputs' => [
            'name' => 'Name',
            'coaches_id' => 'Coaches',
            'image' => 'Image',
            'location' => 'Location',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
