<?php

return [
    'plugin'       => [
        'name'        => 'FAQ',
        'description' => 'Plugin de Faq interactiva que permite a los usuarios hacer preguntas directamente desde tu website.',
    ],
    'sidebar'      => [
        'questions'             => 'Preguntas y respuestas',
        'categories'            => 'Categorías',
    ],
    'components'   => [
        'question'  => [
            'name'          => 'Pregunta',
            'description'   => '',
        ],
    ],
    'descriptions' => [

    ],
    'labels'       => [
        'answer'            => 'Respuesta',
        'edit_answer'       => 'Edita la respuesta aquí',
        'featured'          => 'Destacado',
        'public'            => 'Público',
        'replay_email'      => 'Email respuesta',
        'created_at'        => 'Creado',
        'creation_date'     => 'Fecha de creación',
        'creation_date_description' => 'Cuando fue creada la pregunta',
        'is_public'         => 'Es público?',
        'is_featured'       => 'Es destacado?',
        'make_featured'     => 'Hacer una pregunta destacada',
        'notification_email'    => 'Notificación por email',

    ],
    'question'      => [
        'new'           => 'Nueva pregunta',
        'label'         => 'Pregunta',
        'create_title'  => 'Crear pregunta',
        'update_title'  => 'Editar pregunta',
        'update_description' => 'Edita el título de esta pregunta',
        'preview_title' => 'Ver pregunta',
        'list_title'    => 'Gestionar pregunta',
        'description'   => 'Preguntas y respuestas de FAQ'
    ],
    'questions'     => [
        'delete_selected_confirm' => 'Eliminar las preguntas seleccionadas?',
        'menu_label'              => 'Preguntas',
        'return_to_list'          => 'Volver a preguntas',
        'delete_confirm'          => 'Realmente quieres eliminar esta pregunta?',
        'delete_selected_success' => 'Las preguntas seleccionadas se han eliminado correctamente.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'category'      => [
        'new'           => 'Nueva categoría',
        'label'         => 'Categoría',
        'create_title'  => 'Crear Categoría',
        'update_title'  => 'Editar Categoría',
        'update_description' => 'Edita el título de la Categoría',
        'preview_title' => 'Ver Categoría',
        'list_title'    => 'Gestionar Categoría',
        'description'   => 'Listado de categorías de las FAQS'
    ],
    'categories'     => [
        'delete_selected_confirm' => 'Eliminar las categorías seleccionadas?',
        'menu_label'              => 'Categorías',
        'return_to_list'          => 'Volver a categorías',
        'delete_confirm'          => 'Realmente quieres eliminar esta categoría?',
        'delete_selected_success' => 'Las categorías seleccionadas se han eliminado correctamente.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
];