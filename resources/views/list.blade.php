<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            {{ __('Festival Bus Routes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($Festivals as $Festival)
                    <a href="{{ route('festival.detail', $Festival->id) }}" class="block transform hover:scale-105 transition-transform duration-200">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-1">
                                <div class="bg-white p-6">
                                    <div class="flex items-center">
                                        <div class="bg-blue-600 rounded-full p-3 mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800">
                                                {{$Festival->title}}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                Click to view route details
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $Festivals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
