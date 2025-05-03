<div class="py-24">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-24 px-8">
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @livewire('employee.employee-table')
    </div>
</div>
