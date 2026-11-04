<?php

return [
    'name' => 'Sortiq Solutions API',
    'version' => '1.0',
    'status' => 'running',
    'documentation_path' => '/api/docs',
    'doc_source' => 'config/api-docs.php',
    'frontend_called_endpoints' => [
        [
            'name' => 'contact_form_submission',
            'method' => 'POST',
            'path' => '/api/contact-messages',
            'source' => 'public/frontend-assets/js/main.js',
            'description' => 'Submits the public website contact form.',
        ],
    ],
    'endpoints' => [
        'blogs_index' => [
            'title' => 'List Blogs',
            'method' => 'GET',
            'path' => '/api/blogs',
            'description' => 'Returns all published blogs.',
            'frontend_used' => false,
            'response_type' => 'collection',
            'response_fields' => [
                'id', 'title', 'slug', 'image', 'image_url', 'category',
                'excerpt', 'content', 'published_at', 'status', 'views', 'url',
            ],
        ],
        'blogs_show' => [
            'title' => 'Show Blog',
            'method' => 'GET',
            'path' => '/api/blogs/{blog}',
            'description' => 'Returns one published blog by slug.',
            'frontend_used' => false,
            'path_parameters' => [
                'blog' => [
                    'type' => 'string',
                    'description' => 'Blog slug, because Blog model uses slug route binding.',
                ],
            ],
            'response_type' => 'resource',
            'response_fields' => [
                'id', 'title', 'slug', 'image', 'image_url', 'category',
                'excerpt', 'content', 'published_at', 'status', 'views', 'url',
            ],
        ],
        'reviews_index' => [
            'title' => 'List Reviews',
            'method' => 'GET',
            'path' => '/api/reviews',
            'description' => 'Returns all published client reviews.',
            'frontend_used' => false,
            'response_type' => 'collection',
            'response_fields' => [
                'id', 'name', 'slug', 'platform', 'position', 'rating',
                'summary', 'content', 'published_at', 'status', 'views', 'url',
            ],
        ],
        'reviews_show' => [
            'title' => 'Show Review',
            'method' => 'GET',
            'path' => '/api/reviews/{review}',
            'description' => 'Returns one published review by slug.',
            'frontend_used' => false,
            'path_parameters' => [
                'review' => [
                    'type' => 'string',
                    'description' => 'Review slug, because Review model uses slug route binding.',
                ],
            ],
            'response_type' => 'resource',
            'response_fields' => [
                'id', 'name', 'slug', 'platform', 'position', 'rating',
                'summary', 'content', 'published_at', 'status', 'views', 'url',
            ],
        ],
        'client_logos_index' => [
            'title' => 'List Client Logos',
            'method' => 'GET',
            'path' => '/api/client-logos',
            'description' => 'Returns all published client logos.',
            'frontend_used' => false,
            'response_type' => 'collection',
            'response_fields' => [
                'id', 'name', 'slug', 'logo', 'logo_url', 'website',
                'description', 'sort_order', 'status',
            ],
        ],
        'client_logos_show' => [
            'title' => 'Show Client Logo',
            'method' => 'GET',
            'path' => '/api/client-logos/{client_logo}',
            'description' => 'Returns one published client logo by slug.',
            'frontend_used' => false,
            'path_parameters' => [
                'client_logo' => [
                    'type' => 'string',
                    'description' => 'Client logo slug, because ClientLogo model uses slug route binding.',
                ],
            ],
            'response_type' => 'resource',
            'response_fields' => [
                'id', 'name', 'slug', 'logo', 'logo_url', 'website',
                'description', 'sort_order', 'status',
            ],
        ],
        'videos_index' => [
            'title' => 'List Videos',
            'method' => 'GET',
            'path' => '/api/videos',
            'description' => 'Returns all published videos.',
            'frontend_used' => false,
            'response_type' => 'collection',
            'response_fields' => [
                'id', 'title', 'slug', 'youtube_url', 'youtube_id', 'embed_url',
                'thumbnail', 'thumbnail_url', 'summary', 'published_at',
                'status', 'sort_order', 'views',
            ],
        ],
        'videos_show' => [
            'title' => 'Show Video',
            'method' => 'GET',
            'path' => '/api/videos/{video}',
            'description' => 'Returns one published video by slug.',
            'frontend_used' => false,
            'path_parameters' => [
                'video' => [
                    'type' => 'string',
                    'description' => 'Video slug, because Video model uses slug route binding.',
                ],
            ],
            'response_type' => 'resource',
            'response_fields' => [
                'id', 'title', 'slug', 'youtube_url', 'youtube_id', 'embed_url',
                'thumbnail', 'thumbnail_url', 'summary', 'published_at',
                'status', 'sort_order', 'views',
            ],
        ],
        'contact_messages_describe' => [
            'title' => 'Contact Message Docs',
            'method' => 'GET',
            'path' => '/api/contact-messages',
            'description' => 'Returns usage details for the contact message submission endpoint.',
            'frontend_used' => false,
            'response_type' => 'object',
        ],
        'contact_messages_store' => [
            'title' => 'Submit Contact Message',
            'method' => 'POST',
            'path' => '/api/contact-messages',
            'description' => 'Stores a contact form message and sends a notification email when configured.',
            'frontend_used' => true,
            'content_types' => [
                'application/json',
                'multipart/form-data',
                'application/x-www-form-urlencoded',
            ],
            'request_fields' => [
                'name' => ['required' => true, 'type' => 'string', 'max' => 120],
                'email' => ['required' => true, 'type' => 'email', 'max' => 160],
                'country_code' => ['required' => false, 'type' => 'string', 'max' => 10],
                'phone' => ['required' => false, 'type' => 'string', 'digits_between' => [7, 15]],
                'subject' => ['required' => true, 'type' => 'string', 'max' => 160],
                'message' => ['required' => true, 'type' => 'string', 'min' => 10, 'max' => 3000],
                'recaptcha' => ['required' => false, 'type' => 'string', 'max' => 4096],
            ],
            'success_response' => [
                'success' => true,
                'message' => 'Message sent successfully.',
            ],
            'example_request' => [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest',
                ],
                'body' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'country_code' => '+1',
                    'phone' => '9876543210',
                    'subject' => 'Need help with our website',
                    'message' => 'Please contact us about the redesign project.',
                    'recaptcha' => 'browser-generated-token',
                ],
            ],
        ],
    ],
];
