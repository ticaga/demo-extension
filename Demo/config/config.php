<?php

/**
 * Demo Extension Configuration File
 *
 * This file defines default configuration for the extension.
 * These values can be accessed in your extension code.
 *
 * USAGE IN CODE:
 *
 * In your extension class:
 * $config = $this->getConfig();
 * $apiEndpoint = $config['api']['endpoint'];
 *
 * Or access specific value with helper:
 * $timeout = $this->getConfigValue('api.timeout', 30);
 *
 * CONFIGURATION SOURCES (Priority order):
 * 1. Database settings (via ExtensionManager::getSettings())
 * 2. Environment variables (via env())
 * 3. This config file (defaults)
 *
 * ENVIRONMENT VARIABLES:
 * Define in your .env file:
 * DEMO_EXTENSION_API_KEY=your-key-here
 * DEMO_EXTENSION_ENABLED=true
 */

return [
    /**
     * ========================================
     * GENERAL SETTINGS
     * ========================================
     */

    // Enable/disable extension features
    'enabled' => env('DEMO_EXTENSION_ENABLED', true),

    // Debug mode (more verbose logging)
    'debug' => env('DEMO_EXTENSION_DEBUG', false),

    // Extension name (used in logs, notifications, etc.)
    'name' => 'Demo Extension',

    // Version (should match extension.json)
    'version' => '1.0.0',

    /**
     * ========================================
     * API CONFIGURATION
     * ========================================
     */

    'api' => [
        // External API endpoint
        'endpoint' => env('DEMO_EXTENSION_API_ENDPOINT', 'https://api.example.com'),

        // API authentication key
        'key' => env('DEMO_EXTENSION_API_KEY', ''),

        // API secret (never hardcode sensitive data!)
        'secret' => env('DEMO_EXTENSION_API_SECRET', ''),

        // Request timeout (seconds)
        'timeout' => env('DEMO_EXTENSION_API_TIMEOUT', 30),

        // Retry failed requests
        'retry' => [
            'enabled' => true,
            'max_attempts' => 3,
            'delay' => 1000, // milliseconds
        ],

        // Rate limiting
        'rate_limit' => [
            'enabled' => true,
            'max_requests' => 100,
            'per_minutes' => 60,
        ],
    ],

    /**
     * ========================================
     * FEATURE FLAGS
     * ========================================
     */

    'features' => [
        // Enable ticket hooks
        'ticket_hooks' => true,

        // Enable user hooks
        'user_hooks' => true,

        // Enable email notifications
        'email_notifications' => false,

        // Enable webhook notifications
        'webhook_notifications' => false,

        // Enable logging
        'logging' => true,

        // Enable caching
        'caching' => true,
    ],

    /**
     * ========================================
     * LOGGING CONFIGURATION
     * ========================================
     */

    'logging' => [
        // Enable logging
        'enabled' => true,

        // Log channel (from config/logging.php)
        'channel' => env('DEMO_EXTENSION_LOG_CHANNEL', 'stack'),

        // Minimum log level
        // Options: debug, info, notice, warning, error, critical, alert, emergency
        'level' => env('DEMO_EXTENSION_LOG_LEVEL', 'info'),

        // Log to database table
        'database' => [
            'enabled' => true,
            'table' => 'demo_logs',
        ],

        // Log retention (days)
        'retention_days' => 30,
    ],

    /**
     * ========================================
     * CACHE CONFIGURATION
     * ========================================
     */

    'cache' => [
        // Enable caching
        'enabled' => true,

        // Cache driver (from config/cache.php)
        'driver' => env('CACHE_DRIVER', 'file'),

        // Cache key prefix
        'prefix' => 'demo_extension',

        // Default TTL (seconds)
        'ttl' => 3600, // 1 hour

        // Specific cache TTLs
        'ttls' => [
            'settings' => 3600,      // 1 hour
            'api_response' => 300,   // 5 minutes
            'user_data' => 1800,     // 30 minutes
        ],
    ],

    /**
     * ========================================
     * NOTIFICATION SETTINGS
     * ========================================
     */

    'notifications' => [
        // Email notifications
        'email' => [
            'enabled' => false,
            'from' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
            'recipients' => [
                // 'admin@example.com',
            ],
        ],

        // Slack notifications
        'slack' => [
            'enabled' => false,
            'webhook_url' => env('DEMO_EXTENSION_SLACK_WEBHOOK', ''),
            'channel' => env('DEMO_EXTENSION_SLACK_CHANNEL', '#general'),
            'username' => 'Ticaga Demo',
            'icon' => ':robot_face:',
        ],

        // Discord notifications
        'discord' => [
            'enabled' => false,
            'webhook_url' => env('DEMO_EXTENSION_DISCORD_WEBHOOK', ''),
        ],
    ],

    /**
     * ========================================
     * SECURITY SETTINGS
     * ========================================
     */

    'security' => [
        // Require authentication for all routes
        'require_auth' => true,

        // Allowed roles (Spatie permissions)
        'allowed_roles' => ['superadmin', 'admin', 'employee'],

        // Rate limiting
        'rate_limit' => [
            'enabled' => true,
            'max_attempts' => 60,
            'decay_minutes' => 1,
        ],

        // IP whitelist (empty = allow all)
        'ip_whitelist' => [
            // '127.0.0.1',
            // '192.168.1.0/24',
        ],

        // Encrypt sensitive data
        'encryption' => [
            'enabled' => true,
            'algorithm' => 'AES-256-CBC',
        ],
    ],

    /**
     * ========================================
     * HOOKS CONFIGURATION
     * ========================================
     */

    'hooks' => [
        // Enable all hooks
        'enabled' => true,

        // Specific hook settings
        'ticket_created' => [
            'enabled' => true,
            'async' => false, // Run asynchronously in queue
            'priority' => 10,
        ],

        'ticket_assigned' => [
            'enabled' => true,
            'async' => false,
            'priority' => 10,
        ],

        'user_login' => [
            'enabled' => true,
            'async' => false,
            'priority' => 10,
        ],
    ],

    /**
     * ========================================
     * QUEUE CONFIGURATION
     * ========================================
     */

    'queue' => [
        // Use queue for background jobs
        'enabled' => env('DEMO_EXTENSION_QUEUE_ENABLED', false),

        // Queue name
        'name' => env('DEMO_EXTENSION_QUEUE_NAME', 'default'),

        // Queue connection (from config/queue.php)
        'connection' => env('QUEUE_CONNECTION', 'sync'),
    ],

    /**
     * ========================================
     * UI CUSTOMIZATION
     * ========================================
     */

    'ui' => [
        // Extension icon (Heroicon name)
        'icon' => 'heroicon-o-light-bulb',

        // Color theme
        'color' => 'indigo',

        // Show in navigation menu
        'show_in_menu' => true,

        // Menu position (higher = lower in menu)
        'menu_position' => 100,
    ],

    /**
     * ========================================
     * CUSTOM SETTINGS
     * ========================================
     *
     * Add your own custom settings here
     */

    'custom' => [
        // Example: Auto-assign tickets based on rules
        'auto_assign' => [
            'enabled' => false,
            'rules' => [
                // [
                //     'condition' => 'department_id',
                //     'value' => 1,
                //     'assign_to' => 5, // User ID
                // ],
            ],
        ],

        // Example: Auto-tagging
        'auto_tag' => [
            'enabled' => false,
            'rules' => [
                // [
                //     'keyword' => 'urgent',
                //     'priority' => 'high',
                // ],
            ],
        ],
    ],
];

/**
 * ========================================
 * ACCESSING CONFIGURATION
 * ========================================
 *
 * In your extension class (DemoExtension.php):
 *
 * // Get all config
 * $config = $this->getConfig();
 *
 * // Get specific value
 * $apiEndpoint = $this->getConfigValue('api.endpoint');
 *
 * // Get with default
 * $timeout = $this->getConfigValue('api.timeout', 30);
 *
 * // Check if feature is enabled
 * if ($this->getConfigValue('features.logging')) {
 *     // Do something
 * }
 *
 * // Access nested values
 * $retryEnabled = $this->getConfigValue('api.retry.enabled');
 *
 * ========================================
 * ENVIRONMENT VARIABLES (.env)
 * ========================================
 *
 * Add to your .env file:
 *
 * # Demo Extension
 * DEMO_EXTENSION_ENABLED=true
 * DEMO_EXTENSION_DEBUG=false
 * DEMO_EXTENSION_API_KEY=your-api-key
 * DEMO_EXTENSION_API_ENDPOINT=https://api.example.com
 * DEMO_EXTENSION_SLACK_WEBHOOK=https://hooks.slack.com/services/...
 *
 * ========================================
 * DATABASE SETTINGS
 * ========================================
 *
 * Store user-configurable settings in database:
 *
 * $manager = app(\App\Extensions\ExtensionManager::class);
 *
 * // Save settings
 * $manager->updateSettings('demo', [
 *     'api_key' => 'abc123',
 *     'notifications_enabled' => true,
 * ]);
 *
 * // Get settings
 * $settings = $manager->getSettings('demo');
 *
 * Database settings override this config file!
 */
