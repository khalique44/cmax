<?php

return [
    'limit_laundry_booking' => env('LIMIT_LAUNDRY_BOOKING', 3),
    'issue_status' => [
    					'close' => env('ISSUE_CLOSE', 'Closed'),
    					'inprogress' => env('ISSUE_INPROGRESS', 'Inprogress'),
    					'new' => env('ISSUE_NEW', 'New'),
    					'verification' => env('ISSUE_VERIFICATION', 'Verification'),
						
						],
	'user_types' => [
    					'vendor' => env('VENDOR', 'vendor'),
    					'admin' => env('ADMIN', 'admin'),
    					'member' => env('Member', 'member'),   					
						
						],
    'send_types' => [
                        'apartment' => env('APARTMENT', 'Apartment'),
                        'all_apartments' => env('ALL_APARTMENTS', 'All Apartments'),
                        'vendor' => env('VENDOR', 'Vendor'),                    
                        'all_vendors' => env('ALL_VENDORS', 'All Vendors'),                    
                        
                        ],
    'date_format' => env('DATE_FROMAT', 'd-M-Y'),
];