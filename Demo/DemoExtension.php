<?php

/**
 * Demo Extension for Ticaga
 *
 * This is a comprehensive example showing how to create a Ticaga extension.
 * Use this as a template for your own extensions!
 *
 * IMPORTANT NAMING CONVENTIONS:
 * - Directory name: StudlyCase (Demo)
 * - Class name: {DirectoryName}Extension (DemoExtension)
 * - Namespace: App\Extensions\Installed\{DirectoryName}
 * - Extension ID in manifest: kebab-case (demo)
 */

namespace App\Extensions\Installed\Demo;

use App\Extensions\Extension;
use App\Extensions\Hooks\Hooks;
use App\Extensions\Hooks\HookManager;
use Illuminate\Support\Facades\Log;

class DemoExtension extends Extension
{
    /**
     * Called when the extension is first installed.
     *
     * This method runs ONCE when the extension is installed via the UI or API.
     * Use it to:
     * - Set up initial data
     * - Create default settings
     * - Initialize external services
     * - Run migrations (called automatically by parent::install())
     *
     * @return void
     */
    public function install(): void
    {
        // IMPORTANT: Always call parent::install() to run migrations
        parent::install();

        // Log the installation for debugging
        Log::info("Demo Extension installed successfully!");

        // Example: Create default settings
        // You could insert default data here if needed
        // DB::table('demo_settings')->insert(['key' => 'welcome', 'value' => 'Hello World']);
    }

    /**
     * Called when the extension is enabled.
     *
     * This method runs:
     * - After installation when user clicks "Enable"
     * - When re-enabling a previously disabled extension
     * - After successful upgrade
     *
     * Use it to:
     * - Register event hooks
     * - Start background jobs
     * - Enable features
     * - Connect to external services
     *
     * @return void
     */
    public function enable(): void
    {
        Log::info("Demo Extension enabled!");

        // Get the hook manager
        $hooks = app(HookManager::class);

        /**
         * REGISTERING HOOKS
         *
         * Hooks allow your extension to react to events in Ticaga.
         * Syntax: $hooks->register(HookName, Callback, Priority)
         *
         * Priority: Lower numbers run first (default: 10)
         */

        // Example 1: React when a ticket is created
        $hooks->register(Hooks::TICKET_CREATED, [$this, 'onTicketCreated'], 10);

        // Example 2: React when a ticket is assigned
        $hooks->register(Hooks::TICKET_ASSIGNED, [$this, 'onTicketAssigned'], 10);

        // Example 3: React when a user logs in
        $hooks->register(Hooks::USER_LOGIN, function ($user) {
            Log::info("User logged in: {$user->name} (ID: {$user->id})");
        }, 10);

        // Example 4: Filter ticket data before saving
        // Note: For filter hooks, the callback should return the modified value
        $hooks->register(Hooks::FILTER_TICKET_DATA, [$this, 'filterTicketData'], 10);

        /**
         * ADDITIONAL SETUP
         *
         * You can also:
         * - Start scheduled tasks
         * - Register event listeners
         * - Initialize caches
         * - Connect to APIs
         */
    }

    /**
     * Called when the extension is disabled.
     *
     * This method runs when:
     * - User clicks "Disable" in the Extensions UI
     * - Before uninstalling
     * - Before upgrading
     *
     * Use it to:
     * - Clean up temporary data
     * - Stop background jobs
     * - Disconnect from services
     * - Clear caches
     *
     * NOTE: Do NOT delete user data here! Save that for uninstall()
     *
     * @return void
     */
    public function disable(): void
    {
        Log::info("Demo Extension disabled!");

        /**
         * CLEANUP EXAMPLES
         *
         * - Clear caches
         * - Stop scheduled jobs
         * - Close connections
         * - Remove temporary files
         */

        // Example: Clear cache
        // Cache::forget('demo-extension-cache');

        // Example: Stop a scheduled job
        // You might set a flag in the database or config
    }

    /**
     * Called when the extension is uninstalled.
     *
     * This method runs when:
     * - User clicks "Uninstall" in the Extensions UI
     *
     * Use it to:
     * - Delete extension-specific data
     * - Remove files
     * - Clean up external resources
     *
     * IMPORTANT NOTES:
     * - Extension is automatically disabled before this runs
     * - Database migrations are NOT automatically rolled back
     * - You must manually drop tables if needed
     * - Be careful not to delete user data accidentally
     *
     * @return void
     */
    public function uninstall(): void
    {
        Log::info("Demo Extension uninstalled!");

        /**
         * CLEANUP EXAMPLES
         */

        // Example 1: Drop extension tables
        // Schema::dropIfExists('demo_extension_logs');

        // Example 2: Delete files
        // Storage::deleteDirectory('demo-extension');

        // Example 3: Clean up settings
        // DB::table('extensions_settings')->where('extension_id', 'demo')->delete();
    }

    /**
     * Called when the extension is upgraded to a new version.
     *
     * This method runs when:
     * - User clicks "Upgrade" in the Extensions UI
     * - Version in extension.json is higher than installed version
     *
     * Use it to:
     * - Migrate data to new format
     * - Update settings
     * - Run version-specific upgrade logic
     *
     * NOTE: New migrations are automatically run by the system
     *
     * @param string $fromVersion The currently installed version (e.g., "1.0.0")
     * @param string $toVersion The new version being upgraded to (e.g., "1.1.0")
     * @return void
     */
    public function upgrade(string $fromVersion, string $toVersion): void
    {
        Log::info("Demo Extension upgrading from {$fromVersion} to {$toVersion}");

        /**
         * VERSION-SPECIFIC UPGRADE LOGIC
         *
         * Use version_compare() to run logic only for specific version upgrades
         */

        // Example 1: Upgrade from 1.x to 2.0
        if (version_compare($fromVersion, '2.0.0', '<')) {
            Log::info("Running v2.0.0 upgrade tasks...");
            // $this->migrateDataToV2();
        }

        // Example 2: Upgrade from any version before 1.5.0
        if (version_compare($fromVersion, '1.5.0', '<')) {
            Log::info("Running v1.5.0 upgrade tasks...");
            // $this->addNewFeature();
        }

        // Example 3: Always run on any upgrade
        // $this->clearCache();
    }

    /**
     * ========================================
     * CUSTOM HOOK HANDLERS
     * ========================================
     *
     * These methods are called when their respective hooks fire.
     * They are registered in the enable() method above.
     */

    /**
     * Handle ticket creation event.
     *
     * This is called whenever a new ticket is created in Ticaga.
     *
     * @param \App\Models\Tickets $ticket The newly created ticket
     * @return void
     */
    public function onTicketCreated($ticket): void
    {
        // Log the event
        Log::info("Demo Extension: Ticket #{$ticket->id} created", [
            'subject' => $ticket->subject,
            'user_id' => $ticket->user_id,
            'department_id' => $ticket->department_id,
        ]);

        /**
         * WHAT YOU CAN DO HERE:
         *
         * - Send notifications to external services (Slack, Discord, etc.)
         * - Update external CRM systems
         * - Track analytics
         * - Auto-assign tickets based on rules
         * - Create related records
         */

        // Example: Send to external service
        // $this->notifyExternalService($ticket);

        // Example: Auto-tag tickets
        // if (str_contains($ticket->subject, 'urgent')) {
        //     $ticket->update(['priority' => 'high']);
        // }
    }

    /**
     * Handle ticket assignment event.
     *
     * This is called whenever a ticket is assigned to an employee.
     *
     * @param \App\Models\Tickets $ticket The ticket being assigned
     * @return void
     */
    public function onTicketAssigned($ticket): void
    {
        Log::info("Demo Extension: Ticket #{$ticket->id} assigned to user #{$ticket->assigned}");

        /**
         * EXAMPLE USE CASES:
         *
         * - Send notification to assigned employee
         * - Update workload metrics
         * - Log to external system
         * - Start SLA timer
         */
    }

    /**
     * Filter ticket data before it's saved.
     *
     * This demonstrates how to modify data using filter hooks.
     *
     * IMPORTANT: Filter hooks must return the (possibly modified) value!
     *
     * @param array $ticketData The ticket data array
     * @return array The modified ticket data
     */
    public function filterTicketData(array $ticketData): array
    {
        // Example: Auto-add a prefix to ticket subjects
        // if (isset($ticketData['subject'])) {
        //     $ticketData['subject'] = '[Demo] ' . $ticketData['subject'];
        // }

        // Example: Force certain priority for specific departments
        // if ($ticketData['department_id'] === 1) {
        //     $ticketData['priority'] = 'high';
        // }

        // IMPORTANT: Always return the data (modified or not)
        return $ticketData;
    }

    /**
     * ========================================
     * HELPER METHODS
     * ========================================
     *
     * Add your own helper methods here.
     * These are just examples to show what's possible.
     */

    /**
     * Get extension settings from the database.
     *
     * @return array
     */
    protected function getExtensionSettings(): array
    {
        $manager = app(\App\Extensions\ExtensionManager::class);
        return $manager->getSettings('demo');
    }

    /**
     * Save extension settings to the database.
     *
     * @param array $settings
     * @return void
     */
    protected function saveExtensionSettings(array $settings): void
    {
        $manager = app(\App\Extensions\ExtensionManager::class);
        $manager->updateSettings('demo', $settings);
    }

    /**
     * Example: Send notification to external service.
     *
     * This shows how you might integrate with external APIs.
     *
     * @param mixed $ticket
     * @return void
     */
    protected function notifyExternalService($ticket): void
    {
        // Get settings
        $settings = $this->getExtensionSettings();

        // Check if API endpoint is configured
        if (empty($settings['api_endpoint'])) {
            Log::warning("Demo Extension: API endpoint not configured");
            return;
        }

        // Send HTTP request (example)
        // Http::post($settings['api_endpoint'], [
        //     'ticket_id' => $ticket->id,
        //     'subject' => $ticket->subject,
        //     'status' => $ticket->status,
        // ]);
    }

    /**
     * Example: Get configuration value.
     *
     * This shows how to access config from extension.json or config/config.php
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function getConfigValue(string $key, $default = null)
    {
        $config = $this->getConfig();
        return $config[$key] ?? $default;
    }

    /**
     * ========================================
     * DEBUGGING HELPERS
     * ========================================
     */

    /**
     * Log debug information (only if debug mode is enabled).
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    protected function debug(string $message, array $context = []): void
    {
        if (config('app.debug')) {
            Log::debug("Demo Extension: {$message}", $context);
        }
    }
}
