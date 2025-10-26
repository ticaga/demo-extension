# Demo Extension for Ticaga

A comprehensive demonstration extension showcasing all features of the Ticaga extension system. Use this as a template for building your own extensions!

## Overview

This extension demonstrates:
- ✅ Extension manifest configuration
- ✅ Lifecycle methods (install, enable, disable, upgrade, uninstall)
- ✅ Hook system integration
- ✅ Custom routes and views
- ✅ Database migrations
- ✅ Configuration management
- ✅ Settings storage
- ✅ Permission-based access control
- ✅ Comprehensive code comments

## Features

### 1. Lifecycle Management
The extension properly implements all lifecycle methods:
- **Install**: Sets up the database and initializes settings
- **Enable**: Registers hooks and starts features
- **Disable**: Cleans up temporary data
- **Uninstall**: Removes all extension data
- **Upgrade**: Handles version upgrades smoothly

### 2. Hook System
Demonstrates hooking into Ticaga events:
- Ticket created/updated/assigned
- User login
- Data filtering

### 3. Routes & Views
Includes example pages:
- Dashboard (`/extensions/demo`)
- About page (`/extensions/demo/about`)
- Admin panel (`/extensions/demo/admin`) - Superadmin only
- API endpoint (`/extensions/demo/api/status`)

### 4. Database
Creates a `demo_logs` table showing:
- All common column types
- Foreign keys
- Indexes
- Timestamps
- Comprehensive comments

### 5. Configuration
Extensive config file with examples of:
- API settings
- Feature flags
- Logging configuration
- Cache settings
- Notifications
- Security settings

## Installation

### Requirements
- Ticaga 2.2.0 or higher
- PHP 8.2 or higher
- Laravel 12.0 or higher

### Steps

1. **Copy Extension**
   ```bash
   # Extension is already in: app/Extensions/Installed/Demo/
   ```

2. **Install via UI**
   - Navigate to `/extensions` (Superadmin only)
   - Find "Demo Extension" in the list
   - Click **Install**
   - Click **Enable**

3. **Verify Installation**
   - Visit `/extensions/demo`
   - You should see the demo dashboard

## File Structure

```
app/Extensions/Installed/Demo/
├── extension.json                    # Extension manifest
├── DemoExtension.php                 # Main extension class
├── README.md                         # This file
├── routes/
│   └── web.php                       # Route definitions
├── views/
│   ├── index.blade.php              # Main dashboard
│   ├── about.blade.php              # About page
│   └── admin.blade.php              # Admin panel
├── database/
│   └── migrations/
│       └── 2024_01_01_000000_create_demo_logs_table.php
├── config/
│   └── config.php                    # Configuration file
```

## Usage

### Accessing the Extension

Visit any of these URLs:
- **Dashboard**: `/extensions/demo`
- **About**: `/extensions/demo/about`
- **Admin Panel**: `/extensions/demo/admin` (Superadmin only)
- **API Status**: `/extensions/demo/api/status`

### Working with Settings

```php
// Get extension manager
$manager = app(\App\Extensions\ExtensionManager::class);

// Save settings
$manager->updateSettings('demo', [
    'api_key' => 'your-api-key',
    'enabled_features' => ['logging', 'caching']
]);

// Retrieve settings
$settings = $manager->getSettings('demo');
echo $settings['api_key'];
```

### Using Hooks

The extension registers hooks in the `enable()` method:

```php
use App\Extensions\Hooks\Hooks;
use App\Extensions\Hooks\HookManager;

$hooks = app(HookManager::class);
$hooks->register(Hooks::TICKET_CREATED, function($ticket) {
    // Your custom logic here
    \Log::info("Ticket created: {$ticket->subject}");
});
```

### Database Operations

```php
use Illuminate\Support\Facades\DB;

// Insert a log
DB::table('demo_logs')->insert([
    'user_id' => auth()->id(),
    'action' => 'ticket.created',
    'message' => 'Ticket created successfully',
    'severity' => 1,
    'occurred_at' => now(),
]);

// Query logs
$logs = DB::table('demo_logs')
    ->where('user_id', auth()->id())
    ->orderBy('occurred_at', 'desc')
    ->limit(10)
    ->get();
```

## Configuration

### Environment Variables

Add these to your `.env` file:

```env
# Demo Extension
DEMO_EXTENSION_ENABLED=true
DEMO_EXTENSION_DEBUG=false
DEMO_EXTENSION_API_KEY=your-api-key
DEMO_EXTENSION_API_ENDPOINT=https://api.example.com
DEMO_EXTENSION_LOG_LEVEL=info
```

### Config File

Edit `config/config.php` to customize:
- API settings
- Feature flags
- Logging behavior
- Cache settings
- Notifications
- And more!

## Development Guide

### Creating Your Own Extension

1. **Copy this demo extension** as a template
2. **Rename** directory and files:
   - Directory: `Demo` → `YourExtension`
   - Class: `DemoExtension` → `YourExtensionExtension`
   - Namespace: Update to match directory name
3. **Update** `extension.json`:
   - Change `id`, `name`, `description`, `author`
   - Update `version` to `1.0.0`
4. **Customize** the code:
   - Add your lifecycle logic
   - Register your hooks
   - Create your routes/views
   - Design your database schema
5. **Test** thoroughly:
   - Install/uninstall
   - Enable/disable
   - Upgrade process
   - All features work

### Key Points to Remember

#### File Naming
- **Directory**: StudlyCase (e.g., `MyExtension`)
- **Class**: `{Directory}Extension` (e.g., `MyExtensionExtension.php`)
- **Extension ID**: kebab-case (e.g., `my-extension`)
- **Namespace**: `App\Extensions\Installed\{Directory}`

#### Best Practices
1. **Always** call `parent::install()` in install method
2. **Register hooks** in `enable()` method
3. **Clean up** in `disable()` method
4. **Handle upgrades** in `upgrade()` method
5. **Log important** actions for debugging
6. **Validate** all user input
7. **Check permissions** before sensitive operations
8. **Test** on a development environment first

#### Available Hooks
See `app/Extensions/Hooks/Hooks.php` for all available hooks:
- Ticket hooks (created, updated, assigned, closed, etc.)
- User hooks (login, logout, created, updated, etc.)
- Response hooks
- Email hooks
- UI hooks
- Filter hooks

## Troubleshooting

### Extension Not Showing Up
1. Check directory name matches StudlyCase of ID
2. Verify `extension.json` is valid JSON
3. Ensure class name is correct: `{Directory}Extension`
4. Check namespace matches directory
5. Clear cache: `php artisan cache:clear`

### Installation Fails
1. Check compatibility requirements
2. Verify migrations are valid
3. Check Laravel logs: `storage/logs/laravel.log`
4. Ensure database connection is working

### Hooks Not Firing
1. Verify extension is **enabled** (not just installed)
2. Check hook name matches constant in `Hooks` class
3. Ensure hook is registered in `enable()` method
4. Confirm Ticaga core is firing the hook

### Settings Not Persisting
1. Ensure extension is installed
2. Check database connection
3. Verify settings are valid JSON
4. Look for validation errors in logs

## API Reference

### ExtensionManager Methods

```php
$manager = app(\App\Extensions\ExtensionManager::class);

// Discovery
$manager->discover();                        // Find all extensions
$manager->all();                            // Get all extensions
$manager->get('demo');                      // Get specific extension

// Lifecycle
$manager->install('demo');                  // Install extension
$manager->enable('demo');                   // Enable extension
$manager->disable('demo');                  // Disable extension
$manager->upgrade('demo');                  // Upgrade extension
$manager->uninstall('demo');               // Uninstall extension

// Status
$manager->isInstalled('demo');             // Check if installed
$manager->isEnabled('demo');               // Check if enabled
$manager->hasUpgrade('demo');              // Check for updates

// Settings
$manager->getSettings('demo');             // Get settings
$manager->updateSettings('demo', $array);  // Update settings
```

### Extension Base Methods

```php
// Available in your extension class
$this->getPath();                           // Get extension path
$this->getId();                            // Get extension ID
$this->getName();                          // Get extension name
$this->getVersion();                       // Get version
$this->getConfig();                        // Get all config
$this->getConfigValue('key', 'default');  // Get config value
$this->isCompatible();                     // Check compatibility
```

## Examples

### Example 1: Send Slack Notification on Ticket Creation

```php
public function enable(): void
{
    $hooks = app(HookManager::class);
    $hooks->register(Hooks::TICKET_CREATED, [$this, 'notifySlack']);
}

public function notifySlack($ticket): void
{
    $settings = $this->getExtensionSettings();

    if (!empty($settings['slack_webhook'])) {
        Http::post($settings['slack_webhook'], [
            'text' => "New ticket: #{$ticket->id} - {$ticket->subject}",
        ]);
    }
}
```

### Example 2: Auto-Assign Tickets

```php
public function onTicketCreated($ticket): void
{
    // Auto-assign based on department
    $assignments = [
        1 => 5,  // Department 1 → User 5
        2 => 7,  // Department 2 → User 7
    ];

    if (isset($assignments[$ticket->department_id])) {
        $ticket->update([
            'assigned' => $assignments[$ticket->department_id]
        ]);
    }
}
```

### Example 3: Log All User Logins

```php
public function enable(): void
{
    $hooks = app(HookManager::class);
    $hooks->register(Hooks::USER_LOGIN, function($user) {
        DB::table('demo_logs')->insert([
            'user_id' => $user->id,
            'action' => 'user.login',
            'message' => "User {$user->name} logged in",
            'ip_address' => request()->ip(),
            'occurred_at' => now(),
        ]);
    });
}
```

## Support

For questions or issues:
- **Documentation**: See [EXTENSIONS.md](../../../EXTENSIONS.md)
- **Issues**: Report on GitHub
- **Community**: Join Ticaga community forums

## License

This demo extension is provided as-is for educational purposes.

## Credits

Created by the Ticaga Team as a comprehensive example for extension developers.

---

**Happy coding!** 🚀

Use this demo as a foundation for building amazing Ticaga extensions!
