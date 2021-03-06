<?php

class pets {

    //Basic activation data
    public $basic = [
        'name' => 'Mascotas',
        'description' => 'Módulo de mascotas para el ERP sephora orientado a veterinarios',
        'version' => '0.0.1',
        'vendor' => 'Inforfenix',
        'package' => 'sephora.pets.pets',
        'min-sephora' => '0.0.1',
        'max-sephora' => '0.0.1',
        'icon' => '',
        'has_triggers' => 0,
        'has_hooks' => 1
    ];
    //Routes data
    public $routes = [
        0 => [
            'type' => 'POST',
            'url' => '/pet/new',
            'action' => '\App\modules\pets\core\controllers\PetController@actionCreate'
        ],
        1 => [
            'type' => 'GET',
            'url' => '/pet/delete/{id}',
            'action' => '\App\modules\pets\core\controllers\PetController@actionDelete'
        ],
        2 => [
            'type' => 'GET',
            'url' => '/pet/fetch/{id}',
            'action' => '\App\modules\pets\core\controllers\PetController@actionFetch'
        ],
        3 => [
            'type' => 'POST',
            'url' => '/pet/upload',
            'action' => '\App\modules\pets\core\controllers\PetController@ajaxUploadFile'
        ]
    ];
    //Menus
    public $menus = [
    ];
    //Hooks declaration
    public $hooks = [
        0 => [
            'container' => 'afterCustomer',
        ],
        1 => [
            'container' => 'headerCss',
        ]
    ];

}
