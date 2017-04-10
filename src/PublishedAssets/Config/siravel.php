<?php

/*
 * --------------------------------------------------------------------------
 * Siravel Config
 * --------------------------------------------------------------------------
*/

return [

    /*
     * --------------------------------------------------------------------------
     * Analytics
     * --------------------------------------------------------------------------
    */

    'analytics' => 'internal',   // google, internal

    /*
     * --------------------------------------------------------------------------
     * Pixabay
     * --------------------------------------------------------------------------
    */

    'pixabay' => env('PIXABAY'),

    /*
     * --------------------------------------------------------------------------
     * Database prefix
     * --------------------------------------------------------------------------
    */

    'db-prefix' => 'siravel',

    /*
     * --------------------------------------------------------------------------
     * Live preview in editor
     * --------------------------------------------------------------------------
    */

    'live-preview' => false,

    /*
     * --------------------------------------------------------------------------
     * Front-end
     * --------------------------------------------------------------------------
    */

    'frontend-namespace' => '\App\Http\Controllers\Siravel',
    'frontend-theme' => 'default',

    /*
     * --------------------------------------------------------------------------
     * Modules
     * --------------------------------------------------------------------------
    */

    'load-modules' => true,
    'module-directory' => 'siravel/modules',
    'active-core-modules' => [
        'blog',
        'menus',
        'files',
        'images',
        'pages',
        'widgets',
        'events',
        'faqs',
    ],

    /*
     * --------------------------------------------------------------------------
     * Languages
     * --------------------------------------------------------------------------
    */

    'auto-translate' => true,

    'default-language' => 'pt',

    'languages' => [
        'en' => 'english',
        'pt' => 'portuguese',
    ],

    /*
     * --------------------------------------------------------------------------
     * Images and File Storage
     * --------------------------------------------------------------------------
    */

    'storage-location' => 'local', // s3, local
    'max-file-upload-size' => 6291456, // 6MB

    /*
     * --------------------------------------------------------------------------
     * Admin management
     * --------------------------------------------------------------------------
    */

    'backend-title' => 'Siravel',
    'backend-theme' => 'united', // cosmo, cyborg, flatly, lumen, paper, sandstone, simplex, united, yeti
    'registration-available' => false,
    'pagination' => 25,

    /*
     * --------------------------------------------------------------------------
     * API key and token
     * --------------------------------------------------------------------------
    */

    'api-key' => env('SIRAVEL_API_KEY', 'apis-are-cool'),
    'api-token' => env('SIRAVEL_API_TOKEN', 'siravel-token'),

    /*
     * --------------------------------------------------------------------------
     * Core Module Forms
     * --------------------------------------------------------------------------
    */

    'forms' => [
        'blog' => [
            'title' => [
                'type' => 'string',
            ],
            'url' => [
                'type' => 'string',
            ],
            'tags' => [
                'type' => 'string',
                'class' => 'tags',
            ],
            'entry' => [
                'type' => 'text',
                'class' => 'redactor',
                'alt_name' => 'Content',
            ],
            'seo_description' => [
                'type' => 'text',
                'alt_name' => 'SEO Description',
            ],
            'seo_keywords' => [
                'type' => 'string',
                'class' => 'tags',
                'alt_name' => 'SEO Keywords',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
            'published_at' => [
                'type' => 'string',
                'class' => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],

        'images' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
                'custom' => 'checked',
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
        ],

        'images-edit' => [
            'location' => [
                'type' => 'file',
                'alt_name' => 'File',
            ],
            'name' => [
                'type' => 'string',
            ],
            'alt_tag' => [
                'type' => 'string',
                'alt_name' => 'Alt Tag',
            ],
            'title_tag' => [
                'type' => 'string',
                'alt_name' => 'Title Tag',
            ],
            'tags' => [
                'type' => 'string',
                'class' => 'tags',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
        ],

        'files' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'file-edit' => [
            'name' => [],
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'event' => [
            'title' => [
                'type' => 'string',
            ],
            'start_date' => [
                'type' => 'string',
                'class' => 'datepicker',
            ],
            'end_date' => [
                'type' => 'string',
                'class' => 'datepicker',
            ],
            'details' => [
                'type' => 'text',
                'class' => 'redactor',
                'alt_name' => 'Details',
            ],
            'seo_description' => [
                'type' => 'text',
                'alt_name' => 'SEO Description',
            ],
            'seo_keywords' => [
                'type' => 'string',
                'class' => 'tags',
                'alt_name' => 'SEO Keywords',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
            'published_at' => [
                'type' => 'string',
                'class' => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],
    ],
];
