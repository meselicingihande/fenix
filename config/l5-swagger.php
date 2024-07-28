<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'ChatGPT Application API',
            ],

            'routes' => [
                /*
                 * Route for accessing api documentation interface
                 */
                'api' => 'api/documentation',

                /*
                 * Route for accessing parsed annotations.
                 */
                'docs' => 'docs',

                /*
                 * Middleware allows to prevent unexpected access to API documentation
                 */
                'middleware' => [
                    'api' => [],
                    'docs' => [],
                ],

                /*
                 * The default base path for the generated documentation, this will be used by the
                 * api generated docs in case no base path is provided in the `api` configuration.
                 */
                'base' => null,
            ],
            'paths' => [
                /*
                 * Absolute path to location where parsed swagger annotations will be stored
                 */
                'docs' => storage_path('api-docs'),

                /*
                 * Absolute path to directory where to export views
                 */
                'views' => base_path('resources/views/vendor/l5-swagger'),

                /*
                 * Edit to trust proxies e.g. load balancers
                 */
                'base' => env('L5_SWAGGER_BASE_PATH', null),

                /*
                 * List of directories to exclude from swagger generation.
                 */
                'excludes' => [],

                /*
                 * Absolute path to directory where swagger ui will be exported
                 */
                'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

                /*
                 * Absolute path to directory where swagger yaml will be stored
                 */
                'swagger_yaml_path' => storage_path('api-docs'),

                /*
                 * Define where to get swagger json file
                 */
                'swagger_json_path' => env('L5_SWAGGER_JSON_PATH', 'docs'),

                /*
                 * Define where to get swagger yaml file
                 */
                'swagger_yaml_path' => env('L5_SWAGGER_YAML_PATH', 'docs'),

                /*
                 * List of directories that will be used for generating docs
                 */
                'annotations' => [
                    base_path('app'),
                ],
            ],
        ],
    ],
];
