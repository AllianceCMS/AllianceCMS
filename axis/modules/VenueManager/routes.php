<?php
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