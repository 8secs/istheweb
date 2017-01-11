<?php

return [
    'plugin'       => [
        'name'        => 'Tienda',
        'description' => 'A eCommerce plugin that let you set up an online shop.',
    ],
    'sidebar'      => [
        'catalog'                       => 'Catalog',
        'localisation'                  => 'Localisation',
        'marketing'                     => 'Marketing',
        'orders'                        => 'Orders',
    ],
    'components'   => [


    ],
    'menuitem' => [
        'product_category'              => 'Product category',
        'all_product_categories'        => 'All Product categories'
    ],
    'descriptions' => [

    ],
    'labels'       => [
        'name'                          => 'Nombre',
        'code'                          => 'Código',
        'updated_at'                    => 'Actualizado en',
        'type'                          => 'Tipo',
        'slug'                          => 'Slug (Cola de URL)',
        'enabled'                       => 'Activo',
        'available_on'                  => 'Disponible desde',
        'available_until'               => 'Disponible hasta',
        'published_at'                  => 'Publicado el',
        'description'                   => 'Descripción',
        'picture'                       => 'Imagen',
        'pictures'                      => 'Imágenes',
        'make_subcategory'              => 'Hacerla subcategoría?',
        'parent_category'               => 'Parent Category',
        'media'                         => 'Media',

    ],
    'product'      => [
        'new'                               => 'Nuevo producto',
        'label'                             => 'Producto',
        'create_title'                      => 'Crear producto',
        'update_title'                      => 'Editar producto',
        'preview_title'                     => 'Ver producto',
        'list_title'                        => 'Gestionar productos',
        'create_title'                      => 'Crear productos',
        'delete_title'                      => 'Eliminar productos',
        'description'                       => 'Listado de productos de tu tienda',
        'access_import_export'              => 'Permitir importar / exportar productos'
    ],
    'products'     => [
        'delete_selected_confirm'           => 'Eliminar los productos seleccionados?',
        'menu_label'                        => 'Productos',
        'return_to_list'                    => 'Volver a productos',
        'delete_confirm'                    => 'Realmente quieres eliminar este producto?',
        'delete_selected_success'           => 'Se han eliminado los productos seleccionados.',
        'delete_selected_empty'             => 'No hay seleccionado :name para eliminarlo.',
        'icon_comment'                      => 'Selecciona el icono de conjunto de iconos en http://fontawesome.io',
        'product_pagination'                => 'Número de página',
        'product_pagination_description'    => 'Este valor es utilizado para determinar en qué página está el usuario.',
        'product_filter'                    => 'Filtro por categoría',
        'product_filter_description'        => 'Introduce una cola de categoría o un parámetro de URL por el que filtrar. Déjalo vacío para mostrar todos los productos.',
        'product_per_page'                  => 'productos por página',
        'product_per_page_validation'       => 'Formato incorrecto de productos por página',
        'product_no_products'               => 'Mensaje de no productos',
        'product_no_products_description'   => 'Mensaje a mostrar cuando la lista de productos está vacía. Esta propiedad se utiliza por defecto por el componente.',
        'product_order'                     => 'Orden del producto',
        'product_order_description'         => 'Atributo por el que debería ordenarse el listado de productos',
        'product_category'                  => 'Página de la categoría',
        'product_category_description'      => 'Nombre del archivo de la página de la categoría. Esta propiedad es la que se utiliza por defecto por el componente.',
        'product_page'                      => 'Página del producto',
        'product_page_description'          => 'Nombre del archivo de la página de productos. Esta propiedad es la que se utiliza por defecto por el componente.',
        'import_product'                    => 'Importar productos',
        'export_products'                   => 'Exportar    product0s',
    ],
    'category'      => [
        'new'                               => 'Nueva Categoría',
        'label'                             => 'Categoría',
        'create_title'                      => 'Crear categoría',
        'update_title'                      => 'Editar categoría',
        'preview_title'                     => 'Ver categoría',
        'list_title'                        => 'Getionar categoría',
        'description'                       => 'Listado de categoría de productos'
    ],
    'categories'     => [
        'delete_selected_confirm'           => 'Eliminar las categorías seleccionadas?',
        'menu_label'                        => 'Categorías',
        'return_to_list'                    => 'Volver a categorías',
        'delete_confirm'                    => 'Realmente quieres eliminar esta categoría?',
        'delete_selected_success'           => 'Se han eliminado las categorías seleccionadas.',
        'delete_selected_empty'             => 'No existe ningún elemento con nombre :name para eliminarlo.',
    ],
    'attributes'     => [
        'delete_selected_confirm'           => 'Eliminar los atributos seleccionadas?',
        'menu_label'                        => 'Atributos',
        'return_to_list'                    => 'Volver a atributos',
        'delete_confirm'                    => 'Realmente quieres eliminar esta categoría?',
        'delete_selected_success'           => 'Se han eliminado las atributos seleccionadas.',
        'delete_selected_empty'             => 'No existe ningún elemento con nombre :name para eliminarlo.',
        'description'                       => 'Listado de atributos de productos'
    ],
    'options'     => [
        'delete_selected_confirm'           => 'Eliminar los opciones seleccionadas?',
        'menu_label'                        => 'Opciones',
        'return_to_list'                    => 'Volver a opciones',
        'delete_confirm'                    => 'Realmente quieres eliminar esta categoría?',
        'delete_selected_success'           => 'Se han eliminado las opciones seleccionadas.',
        'delete_selected_empty'             => 'No existe ningún elemento con nombre :name para eliminarlo.',
        'description'                       => 'Listado de opciones de productos'
    ]
];