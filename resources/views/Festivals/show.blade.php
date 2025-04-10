<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h1 class="text-lg leading-6 font-medium text-gray-900">
                    <dt class="text-sm font-medium text-gray-500">
                        Title
                    </dt>
                    {{ $Festival->title }}
                </h1>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Description
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $Festival->description }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="px-4 py-4 sm:px-6">
                <a href="{{ route('festivals') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Back to List
                </a>

                <div class="mt-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Available Buses</h3>
                    <div class="space-y-2">
                        @foreach($Festival->buses as $bus)
                            <a href="{{ route('ride', $bus->id) }}"
                               class="block px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Bus {{ $bus->arrival_time }} - {{ $bus->departure_time }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
