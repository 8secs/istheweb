<?php

return [
    'plugin'       => [
        'name'        => 'Mailgun List Manager',
        'description' => 'Este plugin gestiona las listas de correo con la API de Mailgun.',
    ],
    'sidebar'      => [

    ],
    'components'   => [
        'manage_mail_lists'      => [
            'name'        => 'Gestión de listas de correo',
            'description' => 'Gestiona listas de correo.',
        ]
    ],
    'descriptions' => [
        'maxItems' => 'Selecciona la cantidad máxima de resultados para tu componente',
        'itemId'   => 'Selecciona un sólo resultado basado en el número id',
        'orderBy'  => 'Ordena los resultados por columna',
        'sort'     => 'Ordena resultado en sentido ascendente o descendente',
    ],
    'labels'       => [

    ],

];