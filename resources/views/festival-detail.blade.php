<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                            {{ $Festival->title }}
                        </h1>
                        <a href="{{ route('festivals') }}"
                           class="inline-flex items-center px-4 py-2 bg-white text-blue-700 rounded-md hover:bg-blue-50 transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Festival Details
                        </h2>
                        <p class="text-gray-600">
                            {{ $Festival->description }}
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                            Available Buses
                        </h2>
                        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($Festival->buses as $bus)
                                <a href="{{ route('ride', $bus->id) }}" class="block group">
                                    <div
                                        class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-lg p-4 transition-all duration-200 hover:shadow-md hover:border-blue-300">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-8 w-8 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-600">Departure</p>
                                                    <p class="text-lg font-semibold text-blue-700">{{ $bus->departure_time }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-medium text-gray-600">Arrival</p>
                                                <p class="text-lg font-semibold text-blue-700">{{ $bus->arrival_time }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
