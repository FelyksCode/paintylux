<?php

return [
    "CONTACT" => [
        "ADDRESS" => [
            "Chevoil Tower, Ruko Alam Sutera",
            "Jalan Raya Serpong No. 1 KM 7",
            "Tangerang–Banten",
            "Indonesia 15325",
        ],
        "PHONE" => [
            "+62 815 8535 2222",
            "+62 813 9916 9956",
        ],
        "EMAIL" => [
            "osnikkjaya@gmail.com",
        ],
    ],
    "REGEXP" => [
        'email' => "/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/",
        'phone' => "/^\d{7,13}$/"
    ]
];
