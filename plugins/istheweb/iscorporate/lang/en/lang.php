<?php

return [
    'plugin'       => [
        'name'        => 'Corporate',
        'description' => 'A plugin to show information about your company',
    ],
    'sidebar'      => [
        'team'          => 'Team',
        'projects'      => 'Projects',
        'media'         => 'Media',
        'clients'       => 'Clients',
        'providers'     => 'Proveedores',
        'catalog'       => 'Projects',
        'issue'         => 'Issues'
    ],
    'components'   => [

    ],
    'descriptions' => [
        'maxItems' => 'Pick the maximum amout of results from your component',
        'itemId'   => 'Pick only one result from your component based on id number',
        'orderBy'  => 'Pick a column from which to order the results',
        'sort'     => 'Pick a direction to sort the results by',
    ],
    'templates' => [
        'preview'           => 'Preview'
    ],
    'navigation'   => [
        'support'         => 'Support',
        'issues'          => 'Issues',
        'issue_types'     => 'Issue Type',
        'issue_statuses'  => 'Issue State',
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
        'open'          => 'Open Issue',
        'total_time_task'   => 'Working Time',
        'assigned_to'       => 'Assigned to',
    ],
    'tab'          => [
        'details'      => 'Details',
        'messages'     => 'Messages',
        'support_team' => 'Support Team',
        'info'          => 'Info',
        'rrhh'          => 'Human Resources',
        'roles'          => 'Related roles positions',
        'service_elements' => 'Service Elements',
        'reports'          => 'Reports'

    ],
    'status'       => [
        'success' => 'Status was changed successfully.'
    ],
    'filters'      => [
        'hide_closed' => 'Hide closed issues'
    ],
    'settings'     => [
        'category'    => 'Support',
        'label'       => 'Settings',
        'description' => 'Manage support settings'
    ],
    'permissions'  => [
        'tab'             => 'Support',
        'ticket_types'    => 'Manage issue types',
        'ticket_statuses' => 'Manage issue statuses',
        'tickets'         => 'Manage issues',
        'other_tickets'   => 'Support team access',
        'settings'        => 'Manage settings',
    ],
    'messages'     => [
        'empty' => 'Currently there are no replies for this topic.'
    ],
    'mail'          => [
        'email_issue_to_resource'       => 'New issue mail to support team.',
        'email_reply_issue'             => 'New reply message for issue.',
        'email_close_issue'             => 'Close issue mail.'
    ],
    'project_now' => [
        'waiting_material'                  => 'Waiting material',
        'waiting_answers'                   => 'Waiting answer from client',
        'in_production'                     => 'In production',
        'in_test'                           => 'In test',
        'waiting_payment'                   => 'Waiting payment',
        'wating_to_public_client_server'    => 'Waiting to public in clients server',
        'terminated'                        => 'Finish',
    ],
    'project_state' => [
        'active'                        => 'Active',
        'discontinued'                  => 'Discontinued / Suspended',
        'completed'                     => 'Completed',
    ],
    'fields'    => [
        'company'           => 'Company',
        'activity'          => 'Activity',
        'content'           => 'Content',
        'subject'           => 'Subject',
        'type'              => 'Type',
        'message'           => 'Message',
        'url'               => 'URL',
        'payment_method'    => 'Payment Method',
        'notes'             => 'Notes',
        'state'             => 'State',
        'state_comment'     => 'Flick this switch to activate this client',
        'bank'              => 'Bank',
        'branch_office'     => 'Branch Office',
        'dc'                => 'DC',
        'account'           => 'Account',
        'comment'           => 'Comment',
        'comments'           => 'Comments',
        'services_tasks'     => 'Services & Tasks',
        'name'                => 'Name',
        'content_comment'     => 'You can user Markdown syntax.',
        'reply'               => 'Reply',
        'attachments'         => 'Attachments',
        'description'         => 'Description',
        'created_at'          => 'Created at',
        'updated_at'          => 'Updated at',
        'is_active'           => 'Active',
        'id'                  => 'Id',
        'user'                => 'Owner',
        'Incidencia'              => 'Ticket',
        'status'              => 'State',
        'is_closed'           => 'Close',
        'email'               => 'E-mail',
        'attachments_comment' => 'Attachments.',
        'resource'            => 'Human resource',
        'client'              => 'Client',
        'name_contact'        => 'Contact name',
        'surname_contact'     => 'Contact surname',
        'actually'            => 'Actually',
        'username'            => 'Username',
        'password'            => 'Password',
        'dates_states'        => 'Dates and State',
        'dates_states_comment' => 'State and dates of project',

    ],
    'labels'       => [
        'name'                      => 'Name',
        'email'                     => 'Email',
        'phone'                     => 'Phone',
        'address'                   => 'Address',
        'city'                      => 'City',
        'description'               => 'Description',
        'created_at'                => 'Created At',
        'updated_at'                => 'Updated At',
        'published_at'              => 'Published At',
        'visible'                   => 'View online',
        'enabled'                   => 'Enabled',
        'value'                     => 'Value',
        'values'                    => 'Values',
        'code'                      => 'Code',
        'slug'                      => 'Slug',
        'price'                     => 'Price',
        'prices'                    => 'Prices',
        'prices_times'              => 'Times & Prices',
        'service'                   => 'Service',
        'estimated_time'            => 'Estimated days',
        'planified_horas'           => 'Estimated hours',
        'hours'                     => 'Hours',
        'minutes'                   => 'Minutes',
        'prices_section_comment'    => 'You can manage the prices in this section.',
        'roles_comment'             => 'Set the position relative to this service',
        'service_element_comments'  => 'Set types of service relative to this service',
        'pricing_calculator'        => 'Pricing Calculator',
        'standard'                  => 'Standard',
        'channel_and_currency_based'=> 'Channel and currency based',
        'reason'                    => 'Reason',
        'caption'                   => 'Caption',
        'descripition'              => 'Description',
        'meta_keywords'              => 'Meta-Keyword',
        'meta_description'          => 'Meta-Description',
        'short_description'         => 'Short Description',
        'seo'                       => 'SEO',
        'pictures'                  => 'Pictures',
        'files'                     => 'Documents',
        'attachments'               => 'Attachments',
        'media'                     => 'Media',
        'delivery_date'             => 'Delivery date',
        'delivery_notes'            => 'Delivery notes',
        'reason_rejected'           => 'Rejected reasons',
        'available_on'              => 'Start date',
        'available_until'           => 'Delivery date',
        'select_state_project'      => '-- Project state --',
        'select_now_project'      => '-- Actually State --',
        'manage_urls'               => 'Manage URLS',
        'manage_urls_comment'       => 'Manage all URL to work with',
        'other_data'                => 'Other data',
        'manage_data_comment'       => 'If you need to add other data to the element here is the place',

    ],
    'employee'     => [
        'new'           => 'New Employee',
        'label'         => 'Employee',
        'create_title'  => 'Create Employee',
        'update_title'  => 'Edit Employee',
        'preview_title' => 'Preview Employee',
        'list_title'    => 'Manage Employees',
        'description'   => 'Team list'
    ],
    'employees'    => [
        'delete_selected_confirm' => 'Delete the selected employees?',
        'controller_label'        => 'employees',
        'menu_label'              => 'Employees',
        'return_to_list'          => 'Return to Employees',
        'delete_confirm'          => 'Do you really want to delete this employee?',
        'delete_selected_success' => 'Successfully deleted the selected employees.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'role'         => [
        'new'           => 'New Role',
        'label'         => 'Role',
        'create_title'  => 'Create Role',
        'update_title'  => 'Edit Role',
        'preview_title' => 'Preview Role',
        'list_title'    => 'Manage Roles',
        'description'   => 'Positions of team\'s members',
    ],
    'roles'        => [
        'delete_selected_confirm' => 'Delete the selected roles?',
        'controller_label'        => 'roles',
        'menu_label'              => 'Roles',
        'return_to_list'          => 'Return to Roles',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected roles.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
        'comment'                 => 'Asign roles / position of Employee'
    ],
    'client'         => [
        'new'           => 'New Client',
        'label'         => 'Client',
        'create_title'  => 'Create Client',
        'update_title'  => 'Edit Client',
        'preview_title' => 'Preview Client',
        'list_title'    => 'Manage Clients',
        'description'   => 'Manage Company\'s clients',
    ],
    'clients'        => [
        'delete_selected_confirm' => 'Delete the selected clients?',
        'controller_label'        => 'clients',
        'menu_label'              => 'Clients',
        'return_to_list'          => 'Return to Clients',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected clients.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'budget'         => [
        'new'           => 'New Budget',
        'label'         => 'Budget',
        'create_title'  => 'Create Budget',
        'update_title'  => 'Edit Budget',
        'preview_title' => 'Preview Budget',
        'create_project'=> 'Create project from budget',
        'create_pdf'    => 'Create Budget PDF',
        'list_title'    => 'Manage Budgets',
        'description'   => 'Manage Company\'s budgets',
    ],
    'budgets'        => [
        'delete_selected_confirm' => 'Delete the selected budgets?',
        'controller_label'        => 'budgets',
        'menu_label'              => 'Budgets',
        'return_to_list'          => 'Return to Budgets',
        'send_email'              => 'Send email to client',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected budgets.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'provider'         => [
        'new'           => 'New Provider',
        'label'         => 'Provider',
        'create_title'  => 'Create Provider',
        'update_title'  => 'Edit Provider',
        'preview_title' => 'Preview Provider',
        'list_title'    => 'Manage Providers',
        'description'   => 'Manage Company\'s providers',
    ],
    'providers'        => [
        'delete_selected_confirm' => 'Delete the selected providers?',
        'controller_label'        => 'providers',
        'menu_label'              => 'Providers',
        'return_to_list'          => 'Return to Providers',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected providers.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'project'         => [
        'new'           => 'New Project',
        'label'         => 'Project',
        'create_title'  => 'Create Project',
        'update_title'  => 'Edit Project',
        'preview_title' => 'Preview Project',
        'list_title'    => 'Manage Projects',
        'description'   => 'Manage Company\'s projects',
    ],
    'projects'        => [
        'delete_selected_confirm' => 'Delete the selected projects?',
        'controller_label'        => 'projects',
        'menu_label'              => 'Projects',
        'return_to_list'          => 'Return to Projects',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected projects.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'project_type'         => [
        'new'           => 'New Project Type',
        'label'         => 'Project Type',
        'comment'       => 'You can manage the project types of this project.',
        'create_title'  => 'Create Project Type',
        'update_title'  => 'Edit Project Type',
        'preview_title' => 'Preview Project Type',
        'list_title'    => 'Manage Project Types',
        'description'   => 'Manage Company\'s project types',
    ],
    'project_types'        => [
        'delete_selected_confirm' => 'Delete the selected project types?',
        'controller_label'        => 'project types',
        'menu_label'              => 'Project Types',
        'return_to_list'          => 'Return to Project Types',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected project types.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'option'         => [
        'new'           => 'New Project Option',
        'label'         => 'Project Option',
        'create_title'  => 'Create Project Option',
        'menu_label'              => 'Servicios',
        'update_title'  => 'Edit Project Option',
        'preview_title' => 'Preview Project Option',
        'list_title'    => 'Manage Project Options',
        'description'   => 'Manage Company\'s project options',
    ],
    'options'        => [
        'delete_selected_confirm' => 'Delete the selected project options?',
        'controller_label'        => 'project options',
        'menu_label'              => 'Project Options',
        'comment'                 => 'In this section you can manage the options of this element',
        'return_to_list'          => 'Return to Project Options',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected project options.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'variant'         => [
        'new'           => 'New Project Item',
        'label'         => 'Project Item',
        'create_title'  => 'Create Project Item',
        'update_title'  => 'Edit Project Item',
        'preview_title' => 'Preview Project Item',
        'list_title'    => 'Manage Project Items',
        'description'   => 'Manage Company\'s project items',
    ],
    'variants'        => [
        'delete_selected_confirm' => 'Delete the selected project items?',
        'controller_label'        => 'project items',
        'menu_label'              => 'Project Items',
        'return_to_list'          => 'Return to Project Items',
        'delete_confirm'          => 'Do you really want to delete this role?',
        'delete_selected_success' => 'Successfully deleted the selected project items.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
        'comment'                 => 'This section has the elements of this project. The project has to be created before you can create and edit elements.',
    ],
    'issuetype'   => [
        'label'                   => 'Ticket Types',
        'return_to_list'          => 'Return to the issue types list',
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
    'issuestatus' => [
        'label'                   => 'Ticket Statuses',
        'return_to_list'          => 'Return to the issue statuses list',
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
    'issue'       => [
        'label'                   => 'Issue',
        'return_to_list'          => 'Return to the issues list',
        'edit'                    => 'Edit Issue',
        'create'                  => 'Create Issue',
        'manage'                  => 'Manage Issues',
        'update'                  => 'Update Issue',
        'name'                    => 'Issue',
        'delete_confirm'          => 'Do you really want to delete this Issue?',
        'new'                     => 'New Issue',
        'delete_selected_confirm' => 'Are you sure you want to remove selected Issues?',
        'delete_selected_empty'   => 'There are no selected Issues to delete.',
        'delete_selected_success' => 'Successfully deleted the selected Issues.',
        'refresh'                 => 'Refresh',
        'all_complete'            => 'Close selected',
        'close_selected_confirm'    => 'Are you sure you want to close selected Issues?',
        'close_selected_empty'    => 'There are no selected Issues to close.',
        'close_selected_success'  => 'Successfully closed the selected Issues.',
        'open'                    => 'Open Issues',
        'closed'                  => 'Closed Issues',
        'close'                   => 'Close Issue',
        'toolbar'                 => 'Issue toolbar',
        'messages'                => 'Issue messages',
        'preview'                 => 'Preview Issue',
        'close_confirm'           => 'Do you really want to close this Issue?',
        'open_confirm'            => 'Do you really want to open this Issue?',
        'close_success'           => 'Successfully closed the Issue.',
        'open_success'            => 'Successfully opened the Issue.',
    ],

];