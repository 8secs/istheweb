<?php

return [
    'plugin'       => [
        'name'        => 'FAQ',
        'description' => 'Interactive Faq Plugin that allows your users ask questions directly from your webpage.',
    ],
    'sidebar'      => [
        'questions'             => 'Questions',
        'categories'            => 'Categories',
    ],
    'components'   => [
        'question'  => [
            'name'          => 'Question',
            'description'   => 'Question of images with Twitter integration',
        ],
    ],
    'descriptions' => [
        
    ],
    'labels'       => [
        'answer'            => 'Answer',
        'edit_answer'       => 'Edit answer here',
        'public'            => 'Public',
        'featured'          => 'Featured',
        'replay_email'      => 'Replay Email',
        'created_at'        => 'Created at',
        'creation_date'     => 'Creation date',
        'creation_date_description' => 'When the question was created',
        'is_public'         => 'Is Public?',
        'is_featured'       => 'Is Featured?',
        'make_featured'     => 'Make this question featured',
        'notification_email'    => 'Notification Email',

    ],
    'question'      => [
        'new'           => 'New Question',
        'label'         => 'Question',
        'create_title'  => 'Create Question',
        'update_title'  => 'Edit Question',
        'update_description' => 'Edit this question title',
        'preview_title' => 'Preview Question',
        'list_title'    => 'Manage Question',
        'description'   => 'Questions and answers of FAQ'
    ],
    'questions'     => [
        'delete_selected_confirm' => 'Delete the selected questionrs?',
        'menu_label'              => 'Questions',
        'return_to_list'          => 'Return to Questions',
        'delete_confirm'          => 'Do you really want to delete this question?',
        'delete_selected_success' => 'Successfully deleted the selected questions.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'category'      => [
        'new'           => 'New Category',
        'label'         => 'Category',
        'create_title'  => 'Create Category',
        'update_title'  => 'Edit Category',
        'update_description' => 'Edit Category title',
        'preview_title' => 'Preview Category',
        'list_title'    => 'Manage Category',
        'description'   => 'Category list of Faqs'
    ],
    'categories'     => [
        'delete_selected_confirm' => 'Delete the selected categories?',
        'menu_label'              => 'Categories',
        'return_to_list'          => 'Return to Categories',
        'delete_confirm'          => 'Do you really want to delete this category?',
        'delete_selected_success' => 'Successfully deleted the selected categories.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
];