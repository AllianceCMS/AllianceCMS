<?php
$moduleRoutes['VenueManager']['Create Venue Start'] = [
    'name' => 'venue_create_start', // Required: Route name
    'path' => '/venues/create/start/{:venue_name}/{:return_code*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
            'values' => [
            'namespace' => 'VenueManager',
            'controller' => 'Venues',
            'action' => 'venueCreateStart',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['VenueManager']['Create Venue Process'] = [
    'name' => 'venue_create_process', // Required: Route name
    'path' => '/venues/create/process/{:venue_name*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'VenueManager',
            'controller' => 'Venues',
            'action' => 'venueCreateProcess',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['VenueManager']['Create Venue Complete'] = [
    'name' => 'venue_create_complete', // Required: Route name
    'path' => '/venues/create/complete/{:venue_name}/{:return_code}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
        'specs' => [
        'values' => [
            'namespace' => 'VenueManager',
            'controller' => 'Venues',
            'action' => 'venueCreateComplete',
        ] // Required: namespace/controller/action
    ]
];