<?php

namespace App\Repository;


class SystemRepository
{
    const authors = [
        [
            'email' =>  'martin@classaxe.com',
            'name' =>   'Martin Francis',
            'role' =>   '(Software Development)'
        ],
        [
            'email' =>  '',
            'name' =>   'Andy Robins',
            'role' =>   '(Initial Concept)'
        ],
    ];
    const awards = [
        [
            'email' =>  '',
            'name' =>   'Joseph Miller, KJ8O',
            'role' =>   '(Awards Coordinator)'
        ]
    ];

    const systems = [
        'rna' =>    [
            'authors' =>    self::authors,
            'awards' =>     self::awards,
            'editors' =>    [
                [
                    'email' =>  'peterconway@talktalk.net',
                    'name' =>   'Peter Conway',
                    'role' =>   '(for DSC signals)'
                ],
                [
                    'email' =>  'smoketronics@comcast.net',
                    'name' =>   'S M O\'Kelley',
                    'role' =>   '(for NDBs and Ham Beacons)'
                ],
                [
                    'email' =>  'roelof@ndb.demon.nl',
                    'name' =>   'Roelof Bakker',
                    'role' =>   '(for DGPS and Navtex signals)'
                ],
            ],
            'menu' =>       'North America (RNA)',
            'title' =>      'Signals Received in N & C America + Hawaii',
        ],
        'reu' =>    [
            'authors' =>    self::authors,
            'awards' =>     self::awards,
            'editors' =>    [
                [
                    'email' =>  'aunumero73@gmail.com',
                    'name' =>   'Pat Vignoud',
                    'role' =>   '(for NDBs)'
                ],
                [
                    'email' =>  'peterconway@talktalk.net',
                    'name' =>   'Peter Conway',
                    'role' =>   '(for DSC signals)'
                ],
                [
                    'email' =>  'smoketronics@comcast.net',
                    'name' =>   'S M O\'Kelley',
                    'role' =>   '(for Ham Beacons)'
                ],
                [
                    'email' =>  'roelof@ndb.demon.nl',
                    'name' =>   'Roelof Bakker',
                    'role' =>   '(for DGPS and Navtex signals)'
                ],
            ],
            'menu' =>       'Europe (REU)',
            'title' =>      'Signals Received in Europe',
        ],
        'rww' =>    [
            'authors' =>    self::authors,
            'awards' =>     self::awards,
            'editors' =>    [
                [
                    'email' =>  'peterconway@talktalk.net',
                    'name' =>   'Peter Conway',
                    'role' =>   '(for DSC signals)'
                ],
                [
                    'email' =>  'smoketronics@comcast.net',
                    'name' =>   'S M O\'Kelley',
                    'role' =>   '(for NDBs and Ham Beacons)'
                ],
                [
                    'email' =>  'roelof@ndb.demon.nl',
                    'name' =>   'Roelof Bakker',
                    'role' =>   '(for DGPS and Navtex signals)'
                ],
            ],
            'menu' =>       'Worldwide (RWW)',
            'title' =>      'Signals Received Worldwide',
        ]
    ];

    public function get($code)
    {
        return self::systems[$code];
    }

    public function getAll()
    {
        return self::systems;
    }

}
