{{--
    Demo Extension - Admin Panel

    This view demonstrates permission-based access.
    Only superadmins can access this page (protected in routes/web.php)
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Demo Extension - Admin Panel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Admin Notice --}}
            <div class="mb-6 bg-yellow-100 dark:bg-yellow-900 border-l-4 border-yellow-500 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700 dark:text-yellow-300">
                            <strong>Admin Area:</strong> This page is only accessible to superadmins.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Admin Dashboard Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                {{-- Stat Card 1 --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Total Hooks</div>
                    <div class="text-3xl font-bold mt-2">4</div>
                    <div class="text-xs text-gray-500 mt-1">Registered</div>
                </div>

                {{-- Stat Card 2 --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Routes</div>
                    <div class="text-3xl font-bold mt-2">8</div>
                    <div class="text-xs text-gray-500 mt-1">Active</div>
                </div>

                {{-- Stat Card 3 --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Views</div>
                    <div class="text-3xl font-bold mt-2">3</div>
                    <div class="text-xs text-gray-500 mt-1">Templates</div>
                </div>

                {{-- Stat Card 4 --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold">Status</div>
                    <div class="text-3xl font-bold mt-2 text-green-600">✓</div>
                    <div class="text-xs text-gray-500 mt-1">Enabled</div>
                </div>
            </div>

            {{-- Extension Info --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Extension Information</h3>

                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Extension ID</dt>
                            <dd class="mt-1 text-sm">demo</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Version</dt>
                            <dd class="mt-1 text-sm">1.0.0</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Author</dt>
                            <dd class="mt-1 text-sm">Ticaga Team</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Enabled
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Admin Actions --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Admin Actions</h3>

                    <div class="space-y-3">
                        <button class="w-full md:w-auto px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition">
                            View Extension Logs
                        </button>

                        <button class="w-full md:w-auto px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-md transition ml-0 md:ml-2">
                            Clear Extension Cache
                        </button>

                        <button class="w-full md:w-auto px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-md transition ml-0 md:ml-2">
                            Test Hooks
                        </button>

                        <a href="{{ route('extensions') }}"
                           class="inline-block w-full md:w-auto px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-md transition ml-0 md:ml-2 text-center">
                            Manage All Extensions
                        </a>
                    </div>
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mt-6">
                <a href="{{ route('demo.index') }}"
                   class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:underline">
                    ← Back to Demo Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

{{--
    PERMISSION CHECKING:

    In Routes (routes/web.php):
    Route::middleware(['role:superadmin'])->group(function () { ... });

    In Blade:
    @can('role:superadmin')
        <div>Admin content</div>
    @endcan

    In Controllers:
    $this->authorize('role:superadmin');

    Available Ticaga permissions:
    - superadmin
    - admin
    - employee
    - view tickets
    - view customers
    - view assigned to me
    etc.
--}}
