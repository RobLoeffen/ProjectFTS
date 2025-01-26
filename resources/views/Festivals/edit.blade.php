<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            {{ __('Edit a festival') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-2 border-blue-200">
                <div class="p-8 text-gray-900">
                    <div class="border-l-4 border-blue-500 pl-4 mb-6">
                        <p class="text-blue-600 text-sm font-medium">Update your festival information below</p>
                    </div>

                    <form method="POST" action="{{ route('Festivals.update', $Festival) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-blue-700">Festival Title</label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ $Festival->title }}"
                                class="w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-blue-700">Festival
                                Description</label>
                            <textarea
                                name="description"
                                id="description"
                                rows="4"
                                class="w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition"
                            >{{ $Festival->description }}</textarea>
                        </div>

                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('Festivals.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-white border border-blue-300 rounded-md font-semibold text-sm text-blue-700 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition"
                            >
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
