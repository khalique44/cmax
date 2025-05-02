<?php

return [
   
    'area_types' => [

					'Marla',
                    'Sq. Ft.',
                    'Sq. M.',
                    'Sq. Yd.',
                    'Kanal'                        					
						
					],

    'property_types' => [
                            'home', 
                            'plot', 
                            'commercial'
                        ],
    'purpose' => [
                            'sell' => 'Sell', 
                            'rent' => 'Rent', 
                        ],
    'progress' => [
                            'under_construction' => 'Under Construction ', 
                            'new_launch' => 'New Launch ', 
                            'ready' => 'Ready/Close to Possession '
                        ],

	'user_types' => [
    					'vendor' => env('VENDOR', 'vendor'),
    					'admin' => env('ADMIN', 'admin'),
    					'member' => env('Member', 'member'),   					
						
						],
    
    'date_format' => env('DATE_FROMAT', 'd-M-Y'),

    'bedrooms' => ['Studio',1,2,3,4,5,6,7,8,9,10,'10+'],
    'bathrooms' => [1,2,3,4,5,6,'6+']
];