<?php

/*
 * This file is part of the Laravel Cloudinary package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | An HTTP or HTTPS URL to notify your application (a webhook) when the process of uploads, deletes, and any API
    | that accepts notification_url has completed.
    |
    |
    */
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Cloudinary settings. Cloudinary is a cloud hosted
    | media management service for all file uploads, storage, delivery and transformation needs.
    |
    |
    */
    'cloud_name' => env('CLOUDINARY_CLOUD_NAME', 'djp8xcc65'),
    'api_key' => env('CLOUDINARY_API_KEY', '267458531667766'),
    'api_secret' => env('CLOUDINARY_API_SECRET', 'yMHlOw9R4W3TaVvq_htQ8iY-rYU'),
    'url' => env('CLOUDINARY_URL', 'cloudinary://267458531667766:yMHlOw9R4W3TaVvq_htQ8iY-rYU@djp8xcc65'),
    'secure' => true,
    'cdn_subdomain' => true,

    /**
     * Upload Preset From Cloudinary Dashboard
     */
    'upload_preset' => null,

    /**
     * Route to get cloud_image_url from Blade Upload Widget
     */
    'upload_route' => env('CLOUDINARY_UPLOAD_ROUTE'),

    /**
     * Controller action to get cloud_image_url from Blade Upload Widget
     */
    'upload_action' => env('CLOUDINARY_UPLOAD_ACTION'),

    // Additional configuration options
    'default_folder' => 'portfolio',
    'max_file_size' => 2048, // in KB
    'allowed_file_types' => ['jpg', 'jpeg', 'png', 'gif'],
    
    // Transformation options
    'transformation' => [
        'quality' => 'auto',
        'fetch_format' => 'auto',
        'width' => 800,
        'height' => 600,
        'crop' => 'limit'
    ],
    
    // Logging options
    'logging' => true,
    'log_level' => 'info'
];
