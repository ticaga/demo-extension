{{--
    Demo Extension - About Page

    A simpler example view showing basic structure.
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            About Demo Extension
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Demo Extension v1.0.0</h3>

                    <p class="mb-4">
                        This extension demonstrates all the features available in the Ticaga extension system.
                        It serves as a comprehensive template for developers building their own extensions.
                    </p>

                    <h4 class="text-xl font-semibold mb-3">Features Demonstrated</h4>
                    <ul class="list-disc list-inside space-y-2 mb-6">
                        <li>Extension manifest configuration (extension.json)</li>
                        <li>Lifecycle methods (install, enable, disable, upgrade, uninstall)</li>
                        <li>Hook system integration (ticket events, user events, etc.)</li>
                        <li>Custom routes and controllers</li>
                        <li>Blade views and templates</li>
                        <li>Database migrations</li>
                        <li>Configuration management</li>
                        <li>Settings storage and retrieval</li>
                    </ul>

                    <h4 class="text-xl font-semibold mb-3">File Structure</h4>
                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded overflow-x-auto text-sm"><code>app/Extensions/Installed/Demo/
├── extension.json              # Manifest
├── DemoExtension.php           # Main class
├── routes/
│   └── web.php                 # Routes
├── views/
│   ├── index.blade.php        # Main view
│   └── about.blade.php        # This view
├── database/migrations/
│   └── 2024_01_01_...php      # Migrations
├── config/
│   └── config.php             # Configuration
└── README.md                  # Documentation</code></pre>

                    <div class="mt-6">
                        <a href="{{ route('demo.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition">
                            ← Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
