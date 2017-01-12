<?php

return [
    'plugin'       => [
        'name'        => 'Empresa',
        'description' => 'Este plugin muestra información general de tu empresa.',
    ],
    'sidebar'      => [
        'team'          => 'Equipo',
        'projects'      => 'Proyectos',
        'media'         => 'Media',
        'clients'       => 'Clientes',
        'providers'     => 'Proveedores',
        'catalog'       => 'Proyectos'
    ],
    'components'   => [

    ],
    'descriptions' => [
        'maxItems' => 'Selecciona la cantidad máxima de resultados para tu componente',
        'itemId'   => 'Selecciona un sólo resultado basado en el número id',
        'orderBy'  => 'Ordena los resultados por columna',
        'sort'     => 'Ordena resultado en sentido ascendente o descendente',
    ],
    'templates' => [
        'preview'           => 'Previsualizar'
    ],
    'fields'    => [
        'company'           => 'Empresa',
        'activity'          => 'Actividad',
        'content'           => 'Contenido',
        'url'               => 'URL',
        'payment_method'    => 'Método de pago',
        'notes'             => 'Observaciones',
        'state'             => 'Estado',
        'state_comment'     => 'Este switch activa este cliente.',
        'bank'              => 'Banco',
        'branch_office'     => 'Sucursal',
        'dc'                => 'DC',
        'account'           => 'Cuenta',
        'options_elements'  => 'Opciones y Elementos'
    ],
    'labels'       => [
        'name'                      => 'Nombre',
        'email'                     => 'Email',
        'phone'                     => 'Teléfono',
        'address'                   => 'Dirección',
        'city'                      => 'Ciudad',
        'description'               => 'Descripción',
        'created_at'                => 'Creado',
        'updated_at'                => 'Actualizado',
        'published_at'              => 'Publicado',
        'enabled'                   => 'Activo',
        'value'                     => 'Valor',
        'values'                    => 'Valores',
        'code'                      => 'Código',
        'slug'                      => 'Cola url',
        'price'                     => 'Precio',
        'prices'                    => 'Precios',
        'prices_section_comment'    => 'Esta seccion contiene los precios de este elemento.',
        'pricing_calculator'        => 'Calculadora de precios',
        'reason'                    => 'Motivo',
        'caption'                   => 'Subtítulo',
        'descripition'              => 'Descripción',
        'meta_keywords'              => 'Meta-Keyword',
        'meta_description'          => 'Meta-Description',
        'short_description'         => 'Descripción Corta',
        'seo'                       => 'SEO',
        'pictures'                  => 'Imágenes',
        'attachments'               => 'Adjuntos',
        'media'                     => 'Media',
        'delivery_date'             => 'Fecha entrega',
        'delivery_notes'            => 'Observaciones entrega',
        'reason_rejected'           => 'Motivo de no aceptación',
        'available_on'              => 'Fecha de inicio',
        'available_until'           => 'Fecha de finalización',

    ],
    'employee'     => [
        'new'           => 'Nuevo empleado',
        'label'         => 'Empleado',
        'create_title'  => 'Crear empleado',
        'update_title'  => 'Editarar empleado',
        'preview_title' => 'Ver empleado',
        'list_title'    => 'Gestionar empleado',
        'description'   => 'Listado de empleados'
    ],
    'employees'    => [
        'delete_selected_confirm' => 'Eliminar los empleados seleccionados?',
        'controller_label'        => 'empleados',
        'menu_label'              => 'Empleados',
        'return_to_list'          => 'Volver a empleados',
        'delete_confirm'          => 'Realmente quieres eliminar este empleado?',
        'delete_selected_success' => 'Se han eliminado correctamente los empleados seleccionados.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'role'         => [
        'new'           => 'Nuevo Perfil',
        'label'         => 'Perfil',
        'create_title'  => 'Crear Perfil',
        'update_title'  => 'Editarar Perfil',
        'preview_title' => 'Ver Perfil',
        'list_title'    => 'Gestionar Perfil',
        'description'   => 'Cargo de los empleados dentro de una empresa',
    ],
    'roles'        => [
        'delete_selected_confirm' => 'Eliminar los perfiles seleccionados?',
        'controller_label'        => 'perfiles',
        'menu_label'              => 'Perfiles',
        'return_to_list'          => 'Volver a perfiles',
        'delete_confirm'          => 'Realmente quieres eliminar este perfil?',
        'delete_selected_success' => 'Se han eliminado correctamente los perfiles seleccionados.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
        'comment'                 => 'Asigna la posición / departamento del empleado'
    ],
    'client'         => [
        'new'           => 'Nuevo Cliente',
        'label'         => 'Cliente',
        'create_title'  => 'Crear Cliente',
        'update_title'  => 'Editarar Cliente',
        'preview_title' => 'Ver Cliente',
        'list_title'    => 'Gestionar Clientes',
        'description'   => 'Gestión de los clientes de una empresa',
    ],
    'clients'        => [
        'delete_selected_confirm' => 'Eliminar los clientes seleccionados?',
        'controller_label'        => 'clientes',
        'menu_label'              => 'Clientes',
        'return_to_list'          => 'Volver a clientes',
        'delete_confirm'          => 'Realmente quieres eliminar este cliente?',
        'delete_selected_success' => 'Se han eliminado correctamente los clientes seleccionados.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'budget'         => [
        'new'           => 'Nuevo Presupuesto',
        'label'         => 'Presupuesto',
        'create_title'  => 'Crear Presupuesto',
        'update_title'  => 'Editarar Presupuesto',
        'preview_title' => 'Ver Presupuesto',
        'create_project'=> 'Crear proyecto desde presupuesto',
        'create_pdf'    => 'Crear Presupuesto en PDF',
        'list_title'    => 'Gestionar Presupuestos',
        'description'   => 'Gestión de los presupuesto de una empresa',
    ],
    'budgets'        => [
        'delete_selected_confirm' => 'Eliminar los presupuesto seleccionados?',
        'controller_label'        => 'presupuesto',
        'menu_label'              => 'Presupuestos',
        'send_email'              => 'Enviar email a cliente',
        'return_to_list'          => 'Volver a presupuesto',
        'delete_confirm'          => 'Realmente quieres eliminar este cliente?',
        'delete_selected_success' => 'Se han eliminado correctamente los presupuesto seleccionados.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'provider'         => [
        'new'           => 'Nuevo Proveedor',
        'label'         => 'Proveedor',
        'create_title'  => 'Crear Proveedor',
        'update_title'  => 'Editarar Proveedor',
        'preview_title' => 'Ver Proveedor',
        'list_title'    => 'Gestionar Proveedores',
        'description'   => 'Gestión de los proveedores de una empresa',
    ],
    'providers'        => [
        'delete_selected_confirm' => 'Eliminar los proveedores seleccionados?',
        'controller_label'        => 'proveedores',
        'menu_label'              => 'Proveedores',
        'return_to_list'          => 'Volver a proveedores',
        'delete_confirm'          => 'Realmente quieres eliminar este proveedor?',
        'delete_selected_success' => 'Se han eliminado correctamente los proveedores seleccionados.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'project'         => [
        'new'           => 'Nuevo Proyecto',
        'label'         => 'Proyecto',
        'create_title'  => 'Crear Proyecto',
        'update_title'  => 'Editar Proyecto',
        'preview_title' => 'Ver Proyecto',
        'list_title'    => 'Gestionar Proyectos',
        'description'   => 'Gestionar proyectos de la empresa',
    ],
    'projects'        => [
        'delete_selected_confirm' => 'Eliminar los proyectos seleccionados?',
        'controller_label'        => 'proyectos',
        'menu_label'              => 'Proyectos',
        'return_to_list'          => 'Volver a Proyectos',
        'delete_confirm'          => 'Realmente quieres eliminar este role?',
        'delete_selected_success' => 'Se han eliminado correctamente los proyectos.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'project_type'         => [
        'new'           => 'Nuevo Tipo de Proyecto',
        'label'         => 'Tipo de Proyecto',
        'comment'       => 'En esta sección tienes el tipo del proyecto.',
        'create_title'  => 'Crear Tipo de Proyecto',
        'update_title'  => 'Editar Tipo de Proyecto',
        'preview_title' => 'Ver Tipo de Proyecto',
        'list_title'    => 'Gestionar Tipo de Proyecto',
        'description'   => 'Gestionar los tipos de proyectos',
    ],
    'project_types'        => [
        'delete_selected_confirm' => 'Delete the selected project types?',
        'controller_label'        => 'Tipos de Proyecto',
        'menu_label'              => 'Tipos de Proyecto',
        'return_to_list'          => 'Volver a Tipo de Proyectos',
        'delete_confirm'          => 'Realmente quieres eliminar este role?',
        'delete_selected_success' => 'Successfully deleted the selected project types.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'option'         => [
        'new'           => 'Nueva Opción de Proyecto',
        'label'         => 'Opción del Proyecto',
        'create_title'  => 'Crear Opción de Proyecto',
        'update_title'  => 'Editar Opción de Proyecto',
        'preview_title' => 'Ver Opción de Proyecto',
        'list_title'    => 'Gestionar Opción de Proyectos',
        'description'   => 'Gestionar las opciones del proyecto',
    ],
    'options'        => [
        'delete_selected_confirm' => 'Delete the selected project options?',
        'controller_label'        => 'Opciones de Proyecto',
        'menu_label'              => 'Opciones de Proyecto',
        'comment'                 => 'En esta sección puedes gestionar las opciones de este elemento.',
        'return_to_list'          => 'Volver a Opciones de Proyectos',
        'delete_confirm'          => 'Realmente quieres eliminar este role?',
        'delete_selected_success' => 'Successfully deleted the selected project options.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'variant'         => [
        'new'           => 'Nuevo Elemento de proyecto',
        'label'         => 'Elemento de proyecto',
        'create_title'  => 'Crear Elemento de proyecto',
        'update_title'  => 'Editar Elemento de proyecto',
        'preview_title' => 'Ver Elemento de proyecto',
        'list_title'    => 'Gestionar Elemento de proyectos',
        'description'   => 'Gestionar los elementos del proyecto',
    ],
    'variants'        => [
        'delete_selected_confirm' => 'Eliminar los elementos seleccionados?',
        'controller_label'        => 'Elementos de proyecto',
        'menu_label'              => 'Elementos de proyecto',
        'return_to_list'          => 'Volver a Elementos de proyecto',
        'delete_confirm'          => 'Realmente quieres eliminar este elemento?',
        'delete_selected_success' => 'Se han eliminado correctamente los elementos seleccionados.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
        'comment'                 => 'Esta seccion contiene los elementos que contiene el proyecto. Para poder acceder a elementos, primero tienes que crear un proyecto y sus opciones.',
    ],

];