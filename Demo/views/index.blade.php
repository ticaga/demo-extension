{{--
    Demo Extension - Main Dashboard View

    This view demonstrates how to create extension views in Ticaga.

    ACCESSING THIS VIEW:
    - URL: /extensions/demo
    - View Name: extension.demo::index
    - Registered in: routes/web.php

    BLADE TEMPLATING:
    - Use Ticaga's layout: <x-app-layout>
    - Access variables passed from routes: {{ $title }}, {{ $message }}
    - Use Blade directives: @if, @foreach, @auth, etc.
    - Include partials: @include('extension.demo::partials.header')
--}}

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title ?? 'Demo Extension' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message (from session flash data) --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Main Content Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">
                        Welcome to the Demo Extension!
                    </h3>

                    <p class="mb-4">
                        {{ $message ?? 'This is a demonstration extension showing all the features of the Ticaga extension system.' }}
                    </p>

                    {{-- Example: Display current user info --}}
                    @auth
                        <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded">
                            <h4 class="font-semibold mb-2">Current User Information</h4>
                            <ul class="list-disc list-inside">
                                <li><strong>Name:</strong> {{ auth()->user()->name }}</li>
                                <li><strong>Email:</strong> {{ auth()->user()->email }}</li>
                                <li><strong>ID:</strong> {{ auth()->user()->id }}</li>
                            </ul>
                        </div>
                    @endauth

                    {{-- Example: Feature Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        {{-- Feature 1 --}}
                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                            <h5 class="font-semibold mb-2">📋 Hooks</h5>
                            <p class="text-sm mb-3">React to ticket creation, user login, and more.</p>
                            <a href="#hooks" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">
                                Learn more →
                            </a>
                        </div>

                        {{-- Feature 2 --}}
                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                            <h5 class="font-semibold mb-2">🗄️ Database</h5>
                            <p class="text-sm mb-3">Create custom tables with migrations.</p>
                            <a href="#database" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">
                                Learn more →
                            </a>
                        </div>

                        {{-- Feature 3 --}}
                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                            <h5 class="font-semibold mb-2">⚙️ Settings</h5>
                            <p class="text-sm mb-3">Store and manage configuration.</p>
                            <a href="#settings" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">
                                Learn more →
                            </a>
                        </div>
                    </div>

                    {{-- Example: Action Buttons --}}
                    <div class="flex gap-4">
                        <a href="{{ route('demo.about') }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition">
                            About Extension
                        </a>

                        @can('role:superadmin')
                            <a href="{{ route('demo.admin') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-md transition">
                                Admin Panel
                            </a>
                        @endcan
                    </div>
                </div>
            </div>

            {{-- Example: Data Table --}}
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Example Data Table</h3>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Feature
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Hooks</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Enabled
                                    </span>
                                </td>
                                <td class="px-6 py-4">React to system events</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Database</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Enabled
                                    </span>
                                </td>
                                <td class="px-6 py-4">Custom tables with migrations</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Routes</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Enabled
                                    </span>
                                </td>
                                <td class="px-6 py-4">Custom URLs and controllers</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Example: Settings Form --}}
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Example Settings Form</h3>

                    <form method="POST" action="{{ route('demo.settings.save') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="setting_name" class="block text-sm font-medium mb-2">
                                Setting Name
                            </label>
                            <input type="text"
                                   id="setting_name"
                                   name="setting_name"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700"
                                   placeholder="e.g., api_key"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="setting_value" class="block text-sm font-medium mb-2">
                                Setting Value
                            </label>
                            <input type="text"
                                   id="setting_value"
                                   name="setting_value"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700"
                                   placeholder="Enter value"
                                   required>
                        </div>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition">
                            Save Setting
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{--
    BLADE TIPS:

    1. Variables: {{ $variableName }}
    2. Raw HTML: {!! $htmlContent !!}
    3. Conditionals: @if, @elseif, @else, @endif
    4. Loops: @foreach, @for, @while
    5. Authentication: @auth, @guest
    6. Permissions: @can('permission-name')
    7. Includes: @include('view.name')
    8. Components: <x-component-name />
    9. Slots: <x-slot name="header">Content</x-slot>
    10. CSRF Token: @csrf (required for POST forms)
--}}
