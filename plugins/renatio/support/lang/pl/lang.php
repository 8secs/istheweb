<?php

return [
    'plugin'       => [
        'name'        => 'Renatio Backend Support',
        'description' => 'System wsparcia oparty na zgłoszeniach.'
    ],
    'navigation'   => [
        'support'         => 'Support',
        'tickets'         => 'Zgłoszenia',
        'ticket_types'    => 'Typy zgłoszeń',
        'ticket_statuses' => 'Statusy zgłoszeń',
    ],
    'field'        => [
        'name'                => 'Nazwa',
        'subject'             => 'Temat',
        'content'             => 'Wiadomość',
        'content_comment'     => 'Możesz używać składni Markdown.',
        'reply'               => 'Odpowiedź',
        'attachments'         => 'Załączniki',
        'type'                => 'Typ',
        'description'         => 'Opis',
        'created_at'          => 'Data utworzenia',
        'updated_at'          => 'Data modyfikacji',
        'is_active'           => 'Aktywne',
        'id'                  => 'Id',
        'user'                => 'Właściciel',
        'ticket'              => 'Zgłoszenie',
        'status'              => 'Status',
        'is_closed'           => 'Zamknięte',
        'email'               => 'E-mail',
        'attachments_comment' => 'Załącz zrzuty ekranu/pliki zawierające błędy lub inne problemy.',
    ],
    'tickettype'   => [
        'label'                   => 'Typy zgłoszeń',
        'return_to_list'          => 'Powrót do listy typów zgłoszeń',
        'edit'                    => 'Edytyj typ zgłoszenia',
        'create'                  => 'Nowy typ zgłoszenia',
        'manage'                  => 'Zarządzaj typami zgłoszeń',
        'name'                    => 'Typ zgłoszenia',
        'delete_confirm'          => 'Na pewno chcesz usunać ten typ zgłoszenia?',
        'new'                     => 'Nowy typ zgłoszenia',
        'delete_selected_confirm' => 'Na pewno chcesz usunąć zaznaczone typy zgłoszeń?',
        'delete_selected_empty'   => 'Nie ma zaznaczonych typów zgłoszeń do usunięcia.',
        'delete_selected_success' => 'Prawidłowo usunięto zaznaczone typy zgłoszeń.',
    ],
    'ticketstatus' => [
        'label'                   => 'Statusy zgłoszeń',
        'return_to_list'          => 'Powrót do listy statusów zgłoszeń',
        'edit'                    => 'Edytuj status zgłoszenia',
        'create'                  => 'Nowy status zgłoszenia',
        'manage'                  => 'Zarządzaj statusami zgłoszeń',
        'name'                    => 'Status zgłoszenia',
        'delete_confirm'          => 'Na pewno chcesz usunać ten status zgłoszenia?',
        'new'                     => 'Nowy status zgłoszenia',
        'delete_selected_confirm' => 'Na pewno chcesz usunąć zaznaczone statusy zgłoszeń?',
        'delete_selected_empty'   => 'Nie ma zaznaczonych statusów zgłoszeń do usunięcia.',
        'delete_selected_success' => 'Prawidłowo usunięto zaznaczone statusy zgłoszeń.',
    ],
    'ticket'       => [
        'label'                   => 'Zgłoszenia',
        'return_to_list'          => 'Powrót do listy zgłoszeń',
        'edit'                    => 'Edycja zgłoszenia',
        'create'                  => 'Nowe zgłoszenie',
        'manage'                  => 'Zarządzaj zgłoszeniami',
        'name'                    => 'Zgłoszenie',
        'delete_confirm'          => 'Na pewno chcesz usunać to zgłoszenie?',
        'new'                     => 'Nowe zgłoszenie',
        'delete_selected_confirm' => 'Na pewno chcesz usunąć zaznaczone zgłoszenia?',
        'delete_selected_empty'   => 'Nie ma zaznaczonych zgłoszeń do usunięcia.',
        'delete_selected_success' => 'Prawidłowo usunięto zaznaczone zgłoszenia.',
        'refresh'                 => 'Odśwież listę',
        'all_complete'            => 'Zamknij zaznaczone',
        'close_selected_confirm'  => 'Na pewno chcesz zamknąć zaznaczone zgłoszenia?',
        'close_selected_empty'    => 'Nie ma zaznaczonych zgłoszeń do zamknięcia.',
        'close_selected_success'  => 'Prawidłowo zamknięto zaznaczone zgłoszenia.',
        'open'                    => 'Otwarte zgłoszenia',
        'closed'                  => 'Zamknięte zgłoszenia',
        'close'                   => 'Zamknij zgłoszenie',
        'toolbar'                 => 'Toolbar dla zgłoszeń',
        'messages'                => 'Wiadomości dla zgłoszeń',
        'preview'                 => 'Podgląd zgłoszenia',
        'close_confirm'           => 'Na pewno chcesz zamknąć to zgłoszenie?',
        'open_confirm'            => 'Na pewno chcesz otworzyć to zgłoszenie?',
        'close_success'           => 'Prawidłowo zamknięto zgłoszenie.',
        'open_success'            => 'Prawidłowo otwarto zgłoszenie.',
    ],
    'message'      => [
        'send'    => 'Wyślij',
        'success' => 'Wiadomość została wysłana.',
        'reply'   => 'Wpisz odpowiedź tutaj...',
        'at'      => 'dnia',
    ],
    'toolbar'      => [
        'owner'         => 'Utworzone przez',
        'created'       => 'utworzono',
        'id'            => 'Numer zgłoszenia',
        'status'        => 'Status',
        'since'         => 'od',
        'update_status' => 'Zmień status na...',
        'open'          => 'Otwórz zgłoszenie',
    ],
    'tab'          => [
        'details'      => 'Szczegóły',
        'messages'     => 'Wiadomości',
        'support_team' => 'Support Team',
    ],
    'status'       => [
        'success' => 'Status został zmieniony prawidłowo.'
    ],
    'filters'      => [
        'hide_closed' => 'Ukryj zamknięte zgłoszenia'
    ],
    'settings'     => [
        'category'    => 'Support',
        'label'       => 'Ustawienia',
        'description' => 'Zarządzaj ustawieniami'
    ],
    'permissions'  => [
        'tab'             => 'Support',
        'ticket_types'    => 'Zarządzaj typami zgłoszeń',
        'ticket_statuses' => 'Zarządzaj statusami zgłoszeń',
        'tickets'         => 'Zarządzaj zgłoszeniami',
        'other_tickets'   => 'Zarządzaj zgłoszeniem jako support',
        'settings'        => 'Zarządzaj ustawieniami',
    ],
    'messages'     => [
        'empty' => 'Aktualnie nie ma odpowiedzi do tego zgłoszenia.'
    ]
];