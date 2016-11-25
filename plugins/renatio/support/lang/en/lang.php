<?php

return [
    'plugin'       => [
        'name'        => 'Renatio Backend Support',
        'description' => 'Support ticket system for backend users.'
    ],
    'navigation'   => [
        'support'         => 'Support',
        'tickets'         => 'Tickets',
        'ticket_types'    => 'Ticket types',
        'ticket_statuses' => 'Ticket statuses',
    ],
    'field'        => [
        'name'                => 'Name',
        'subject'             => 'Subject',
        'content'             => 'Message',
        'content_comment'     => 'You can use Markdown syntax.',
        'reply'               => 'Reply',
        'attachments'         => 'Attachments',
        'type'                => 'Type',
        'description'         => 'Description',
        'created_at'          => 'Created at',
        'updated_at'          => 'Updated at',
        'is_active'           => 'Active',
        'id'                  => 'Id',
        'user'                => 'Owner',
        'ticket'              => 'Ticket',
        'status'              => 'Status',
        'is_closed'           => 'Closed',
        'email'               => 'E-mail',
        'attachments_comment' => 'Attach screenshots/files with bugs, errors or any others problems.',
    ],
    'tickettype'   => [
        'label'                   => 'Ticket Types',
        'return_to_list'          => 'Return to the ticket types list',
        'edit'                    => 'Edit Ticket Type',
        'create'                  => 'Create Ticket Type',
        'manage'                  => 'Manage Ticket Types',
        'name'                    => 'Ticket Type',
        'delete_confirm'          => 'Do you really want to delete this Ticket Type?',
        'new'                     => 'New Ticket Type',
        'delete_selected_confirm' => 'Are you sure you want to remove selected Ticket Types?',
        'delete_selected_empty'   => 'There are no selected Ticket Types to delete.',
        'delete_selected_success' => 'Successfully deleted the selected Ticket Types.',
    ],
    'ticketstatus' => [
        'label'                   => 'Ticket Statuses',
        'return_to_list'          => 'Return to the ticket statuses list',
        'edit'                    => 'Edit Ticket Status',
        'create'                  => 'Create Ticket Status',
        'manage'                  => 'Manage Ticket Statuses',
        'name'                    => 'Ticket Status',
        'delete_confirm'          => 'Do you really want to delete this Ticket Status?',
        'new'                     => 'New Ticket Status',
        'delete_selected_confirm' => 'Are you sure you want to remove selected Ticket Statuses?',
        'delete_selected_empty'   => 'There are no selected Ticket Statuses to delete.',
        'delete_selected_success' => 'Successfully deleted the selected Ticket Statuses.',
    ],
    'ticket'       => [
        'label'                   => 'Tickets',
        'return_to_list'          => 'Return to the tickets list',
        'edit'                    => 'Edit Ticket',
        'create'                  => 'Create Ticket',
        'manage'                  => 'Manage Tickets',
        'name'                    => 'Ticket',
        'delete_confirm'          => 'Do you really want to delete this Ticket?',
        'new'                     => 'New Ticket',
        'delete_selected_confirm' => 'Are you sure you want to remove selected Tickets?',
        'delete_selected_empty'   => 'There are no selected Tickets to delete.',
        'delete_selected_success' => 'Successfully deleted the selected Tickets.',
        'refresh'                 => 'Refresh',
        'all_complete'            => 'Close selected',
        'close_selected_confirm'    => 'Are you sure you want to close selected Tickets?',
        'close_selected_empty'    => 'There are no selected Tickets to close.',
        'close_selected_success'  => 'Successfully closed the selected Tickets.',
        'open'                    => 'Open tickets',
        'closed'                  => 'Closed tickets',
        'close'                   => 'Close ticket',
        'toolbar'                 => 'Ticket toolbar',
        'messages'                => 'Ticket messages',
        'preview'                 => 'Preview Ticket',
        'close_confirm'           => 'Do you really want to close this Ticket?',
        'open_confirm'            => 'Do you really want to open this Ticket?',
        'close_success'           => 'Successfully closed the ticket.',
        'open_success'            => 'Successfully opened the ticket.',
    ],
    'message'      => [
        'send'    => 'Send',
        'success' => 'Message was send.',
        'reply'   => 'Type reply here...',
        'at'      => 'at',
    ],
    'toolbar'      => [
        'owner'         => 'Created by',
        'created'       => 'created',
        'id'            => 'Ticket ID',
        'status'        => 'Status',
        'since'         => 'since',
        'update_status' => 'Change status to...',
        'open'          => 'Open ticket',
    ],
    'tab'          => [
        'details'      => 'Details',
        'messages'     => 'Messages',
        'support_team' => 'Support Team',
    ],
    'status'       => [
        'success' => 'Status was changed successfully.'
    ],
    'filters'      => [
        'hide_closed' => 'Hide closed tickets'
    ],
    'settings'     => [
        'category'    => 'Support',
        'label'       => 'Settings',
        'description' => 'Manage support settings'
    ],
    'permissions'  => [
        'tab'             => 'Support',
        'ticket_types'    => 'Manage ticket types',
        'ticket_statuses' => 'Manage ticket statuses',
        'tickets'         => 'Manage tickets',
        'other_tickets'   => 'Support team access',
        'settings'        => 'Manage settings',
    ],
    'messages'     => [
        'empty' => 'Currently there are no replies for this topic.'
    ]
];