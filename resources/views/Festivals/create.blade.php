<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            {{ __('Create a new festival') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white tracking-wide">Create a New Festival</h1>
                <div class="mt-2 h-1 w-32 bg-blue-500 mx-auto rounded-full"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-2 border-blue-200">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('Festivals.store') }}" class="space-y-6">
                        @csrf

                        <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-400">
                            <div class="mb-2">
                                <label for="title" class="block text-blue-700 font-semibold mb-2">Festival
                                    Title:</label>
                            </div>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200"
                                placeholder="Enter festival title"
                            >
                        </div>

                        <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-400">
                            <div class="mb-2">
                                <label for="description" class="block text-blue-700 font-semibold mb-2">Festival
                                    Description:</label>
                            </div>
                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                class="w-full rounded-md border-blue-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200"
                                placeholder="Describe your festival here..."
                            ></textarea>
                        </div>

                        <div class="flex justify-between mt-6">
                            <a
                                href="{{ route('Festivals.index') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-blue-600 font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19l-7-7 7-7"/>
                                </svg>
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                                Save Festival
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
