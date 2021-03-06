<?php

return [
    'plugin'       => [
        'name'        => 'Carousel de imágenes',
        'description' => 'Slider de images con integración de Twitter.',
    ],
    'sidebar'      => [
        'slider'            => 'Slider',
        'Slide'             => 'Slide',
    ],
    'components'   => [
        'slider'  => [
            'name'          => 'Slider',
            'description'   => 'Slider de images con integración de Twitter',
        ],
    ],
    'descriptions' => [
        'maxItems' => 'Selecciona la cantidad máxima de resultados para tu componente',
        'itemId'   => 'Selecciona un sólo resultado basado en el número id',
        'orderBy'  => 'Ordena los resultados por columna',
        'sort'     => 'Ordena resultado en sentido ascendente o descendente',
        'folder'        => 'Selecciona la carpeta contenedora de las imágenes',
        'slideWidth'    => 'Selecciona el ancho del slide',
        'minSlides'     => 'Minimun number of slides',
        'maxSlides'     => 'Maximum number of slides',
        'slideMargin'   => 'Separation between images',
    ],
    'labels'       => [
        'name'                      => 'Nombre',
        'slug'                      => 'Cola url',
        'slug_description'          => "Busca un elemento utilizando el valor de cola url.",
        'display_empty'             => 'Mostrar categorías vacías.',
        'display_empty_description' => '',
        'published_at'              => 'Publicado',
        'description'               => 'Descripción',
        'picture'                   => 'Imagen',
        'url'                       => 'Url',
        'icon'                      => 'Icono',
        'pictures'                  => 'Imágenes',
        'attachments'               => 'Archivos adjuntos',
        'files'                     => 'Archivos',
        'created_at'                => 'Creado',
        'updated_at'                => 'Actualizado',
        'source'                    => 'Fuente',
        'content'                   => 'Contenido',
        'descending'                => 'Descendente',
        'ascending'                 => 'Ascendente',
        'maxItems'                  => 'Max Elementos',
        'itemId'                    => 'Id',
        'orderBy'                   => 'Ordenar por',
        'sort'                      => 'Dirección',
        'folder'                    => 'Carpeta',
        'slider_width'              => 'Ancho imagen',
        'min_slides'                => 'Min Imágenes',
        'max_slides'                => 'Max. Imágenes',
        'slide_margin'              => 'Margen entre imágenes',


    ],
    'slider'      => [
        'new'           => 'Nuevo Slider',
        'label'         => 'Slider',
        'create_title'  => 'Crear Slider',
        'update_title'  => 'Editar Slider',
        'preview_title' => 'Ver Slider',
        'list_title'    => 'Gestionar Slider',
        'description'   => 'Visualizador de imágenes'
    ],
    'sliders'     => [
        'delete_selected_confirm' => 'Elimiar los sliders seleccionados?',
        'menu_label'              => 'Sliders',
        'return_to_list'          => 'Volver a Sliders',
        'delete_confirm'          => 'Realmente quieres eliminar este slider?',
        'delete_selected_success' => 'Se han eliminado correctamente.',
        'delete_selected_empty'   => 'No hay este elmento :name para eliminarlo.',
    ],
    'slide'      => [
        'new'           => 'Nuevo Slide',
        'label'         => 'Slide',
        'create_title'  => 'Crear Slide',
        'update_title'  => 'Editar Slide',
        'preview_title' => 'Ver Slide',
        'list_title'    => 'Gestionar Slide',
        'description'   => 'Lista de imágenes'
    ],
    'slides'     => [
        'delete_selected_confirm' => 'Realmente quieres eliminarlo?',
        'menu_label'              => 'Slides',
        'return_to_list'          => 'Volver a Slides',
        'delete_confirm'          => 'Quieres eliminarlo?',
        'delete_selected_success' => 'Se han eliminado correctamente.',
        'delete_selected_empty'   => 'No hay este elmento :name para eliminarlo.',
    ],
];