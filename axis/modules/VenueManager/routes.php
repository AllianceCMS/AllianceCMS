<?php
$moduleRoutes['VenueManager']['Create Venue Start'] = [
    'name' => 'venue_create_start', // Required: Route name
    'path' => '/venues/create/start/{:venue_name}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
            'values' => [
            'namespace' => 'VenueManager',
            'controller' => 'Venues',
            'action' => 'venueCreateStart',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['VenueManager']['Create Venue Select Type'] = [
    'name' => 'venue_create', // Required: Route name
    'path' => '/venues/create/select_type/{:venue_name}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
            'values' => [
            'namespace' => 'VenueManager',
            'controller' => 'Venues',
            'action' => 'venueCreateSelectType',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['VenueManager']['Create Venue'] = [
    'name' => 'venue_create', // Required: Route name
    'path' => '/venues/create/{:venue_name}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'VenueManager',
            'controller' => 'Venues',
            'action' => 'venueCreate',
        ] // Required: namespace/controller/action
    ]
];