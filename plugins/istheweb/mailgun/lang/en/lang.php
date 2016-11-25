<?php

return [
    'plugin'       => [
        'name'        => 'Mailgun List Manager',
        'description' => 'This plugin manage mailing list with Mailgun API.',
    ],
    'sidebar'      => [

    ],
    'components'   => [
        'manage_mail_lists'      => [
            'name'        => 'Manage Mailing Lists',
            'description' => 'Manage Mailing Lists.',
        ]
    ],
    'descriptions' => [
        'maxItems' => 'Pick the maximum amout of results from your component',
        'itemId'   => 'Pick only one result from your component based on id number',
        'orderBy'  => 'Pick a column from which to order the results',
        'sort'     => 'Pick a direction to sort the results by',
    ],
    'labels'       => [

    ],

];