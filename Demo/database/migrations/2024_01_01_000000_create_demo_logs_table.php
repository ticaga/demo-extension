<?php

/**
 * Demo Extension - Database Migration Example
 *
 * This migration creates a sample table for the demo extension.
 *
 * MIGRATION BASICS:
 * - Migrations run automatically when extension is installed
 * - Use up() to create tables/columns
 * - Use down() to drop tables/columns (for rollback)
 * - Follow Laravel migration conventions
 *
 * NAMING CONVENTION:
 * - Format: YYYY_MM_DD_HHMMSS_description.php
 * - Example: 2024_01_01_000000_create_demo_logs_table.php
 *
 * TABLE NAMING:
 * - Prefix tables with extension name to avoid conflicts
 * - Example: demo_logs, demo_settings, demo_cache
 *
 * RUNNING MIGRATIONS:
 * - Automatically run during install()
 * - Can be run manually: php artisan migrate --path=app/Extensions/Installed/Demo/database/migrations
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the table structure.
     */
    public function up(): void
    {
        /**
         * Create demo_logs table
         *
         * This table demonstrates common column types and constraints.
         */
        Schema::create('demo_logs', function (Blueprint $table) {
            // Primary Key
            // Auto-incrementing ID column
            $table->id();

            /**
             * FOREIGN KEYS
             *
             * Link to other tables (Ticaga or your own)
             */

            // Link to Ticaga users table
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade'); // Delete logs when user is deleted

            // Link to Ticaga tickets table (optional)
            $table->foreignId('ticket_id')
                ->nullable()
                ->constrained('tickets', 'id')
                ->onDelete('set null'); // Set to null when ticket is deleted

            /**
             * STRING COLUMNS
             */

            // Short strings (max 255 chars)
            $table->string('action', 100);              // Required, max 100 chars
            $table->string('level', 20)->default('info'); // With default value

            // Longer strings (max 65,535 chars)
            $table->text('message')->nullable();        // Nullable text field

            // Very long text (max 4GB)
            $table->longText('details')->nullable();    // For JSON or large data

            /**
             * NUMERIC COLUMNS
             */

            $table->integer('severity')->default(0);    // Integer with default
            $table->unsignedInteger('count')->default(1); // Unsigned integer
            $table->decimal('duration', 8, 2)->nullable(); // Decimal (8 digits, 2 decimal places)

            /**
             * BOOLEAN COLUMNS
             */

            $table->boolean('is_processed')->default(false);
            $table->boolean('is_critical')->default(false);

            /**
             * DATE/TIME COLUMNS
             */

            $table->timestamp('occurred_at')->nullable();
            $table->dateTime('processed_at')->nullable();

            /**
             * JSON COLUMNS
             */

            // Store JSON data (automatically encoded/decoded by Laravel)
            $table->json('metadata')->nullable();

            /**
             * ENUM COLUMNS
             */

            // Define allowed values
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])
                ->default('pending');

            /**
             * IP ADDRESS
             */

            $table->ipAddress('ip_address')->nullable();

            /**
             * TIMESTAMPS
             *
             * Automatically creates 'created_at' and 'updated_at' columns
             * Laravel automatically manages these
             */
            $table->timestamps();

            /**
             * SOFT DELETES (OPTIONAL)
             *
             * Add a 'deleted_at' column for soft deleting records
             * Records aren't actually deleted, just marked as deleted
             */
            // $table->softDeletes();

            /**
             * INDEXES
             *
             * Speed up queries by creating indexes on frequently searched columns
             */

            $table->index('action');                    // Single column index
            $table->index(['user_id', 'action']);      // Compound index
            $table->index('occurred_at');              // Index for date queries

            // Unique constraint (ensure no duplicates)
            // $table->unique(['user_id', 'action', 'occurred_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method removes the table structure.
     * Called when rolling back or uninstalling.
     */
    public function down(): void
    {
        // Drop the table if it exists
        Schema::dropIfExists('demo_logs');
    }
};

/**
 * ========================================
 * COMMON COLUMN TYPES
 * ========================================
 *
 * Strings:
 * - $table->string('name', 255)            // VARCHAR(255)
 * - $table->text('description')            // TEXT
 * - $table->longText('content')            // LONGTEXT
 *
 * Numbers:
 * - $table->integer('count')               // INT
 * - $table->bigInteger('big_number')       // BIGINT
 * - $table->decimal('price', 8, 2)         // DECIMAL(8,2)
 * - $table->float('rating', 8, 2)          // FLOAT
 * - $table->double('precise', 8, 2)        // DOUBLE
 *
 * Booleans:
 * - $table->boolean('active')              // TINYINT(1)
 *
 * Dates:
 * - $table->date('birth_date')             // DATE
 * - $table->dateTime('event_time')         // DATETIME
 * - $table->timestamp('created_at')        // TIMESTAMP
 * - $table->time('start_time')             // TIME
 * - $table->year('year')                   // YEAR
 *
 * JSON:
 * - $table->json('options')                // JSON
 *
 * Binary:
 * - $table->binary('data')                 // BLOB
 *
 * ========================================
 * COLUMN MODIFIERS
 * ========================================
 *
 * - ->nullable()                           // Allow NULL
 * - ->default($value)                      // Set default value
 * - ->unsigned()                           // Unsigned (no negative numbers)
 * - ->unique()                             // Must be unique
 * - ->index()                              // Create index
 * - ->primary()                            // Primary key
 * - ->comment('description')               // Add comment
 * - ->after('column')                      // Position after column
 *
 * ========================================
 * FOREIGN KEY EXAMPLES
 * ========================================
 *
 * Standard foreign key:
 * $table->foreignId('user_id')
 *     ->constrained()
 *     ->onDelete('cascade');
 *
 * Custom table/column:
 * $table->foreignId('author_id')
 *     ->constrained('users', 'id')
 *     ->onDelete('set null');
 *
 * On Delete Actions:
 * - cascade: Delete related records
 * - set null: Set FK to NULL
 * - restrict: Prevent deletion
 * - no action: Do nothing
 *
 * ========================================
 * INDEX EXAMPLES
 * ========================================
 *
 * Single column:
 * $table->index('email');
 *
 * Multiple columns:
 * $table->index(['user_id', 'status']);
 *
 * Unique constraint:
 * $table->unique('email');
 * $table->unique(['user_id', 'ticket_id']);
 *
 * ========================================
 * USING YOUR TABLE
 * ========================================
 *
 * In your extension code:
 *
 * use Illuminate\Support\Facades\DB;
 *
 * // Insert
 * DB::table('demo_logs')->insert([
 *     'user_id' => auth()->id(),
 *     'action' => 'ticket.created',
 *     'message' => 'Ticket created successfully',
 *     'occurred_at' => now(),
 * ]);
 *
 * // Query
 * $logs = DB::table('demo_logs')
 *     ->where('user_id', auth()->id())
 *     ->orderBy('occurred_at', 'desc')
 *     ->limit(10)
 *     ->get();
 *
 * // Update
 * DB::table('demo_logs')
 *     ->where('id', $logId)
 *     ->update(['is_processed' => true]);
 *
 * // Delete
 * DB::table('demo_logs')
 *     ->where('id', $logId)
 *     ->delete();
 *
 * Or create an Eloquent model:
 * See: https://laravel.com/docs/eloquent
 */
