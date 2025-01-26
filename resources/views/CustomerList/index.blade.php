<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-blue-200">
                <div class="p-6">
                    <a href="{{ route('CustomerList.create') }}"
                       class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add new customer
                    </a>

                    <div class="hidden md:block mt-6 bg-white rounded-lg overflow-hidden">
                        <table class="min-w-full">
                            <thead>
                            <tr class="bg-blue-800 text-white">
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Points</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Planned Rides</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider"></th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @foreach($CustomerLists as $CustomerList)
                                <tr class="bg-white hover:bg-blue-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $CustomerList->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $CustomerList->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $CustomerList->role }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $CustomerList->points }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($CustomerList->buses && count($CustomerList->buses) > 0)
                                            <div class="space-y-2">
                                                @foreach($CustomerList->buses as $bus)
                                                    <div class="flex items-center justify-between text-sm bg-white rounded px-3 py-2 border border-gray-100">
                                                        <span>Ride #{{ $bus->id }}</span>
                                                        <form method="POST" action="{{ route('CustomerList.detachBus', ['customer' => $CustomerList->id, 'bus' => $bus->id]) }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Are you sure you want to remove this planned ride?')" class="px-2 py-1 bg-red-600 hover:bg-red-500 text-white text-xs rounded transition ease-in-out duration-150">
                                                                Remove
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-500">No planned rides</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('CustomerList.edit', $CustomerList) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('CustomerList.destroy', $CustomerList) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete {{$CustomerList->name}}?')" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Responsive view -->
                    <div class="md:hidden mt-6 space-y-4">
                        @foreach($CustomerLists as $CustomerList)
                            <div class="bg-white rounded-lg shadow p-4 border border-gray-200">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $CustomerList->name }}</h3>
                                            <p class="text-sm text-gray-600">{{ $CustomerList->email }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $CustomerList->role }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Points: {{ $CustomerList->points }}</span>
                                    </div>

                                    <div class="space-y-2">
                                        <p class="text-sm font-medium text-gray-700">Planned Rides:</p>
                                        @if($CustomerList->buses && count($CustomerList->buses) > 0)
                                            @foreach($CustomerList->buses as $bus)
                                                <div class="flex items-center justify-between text-sm bg-gray-50 rounded px-3 py-2">
                                                    <span>Ride #{{ $bus->id }}</span>
                                                    <form method="POST" action="{{ route('CustomerList.detachBus', ['customer' => $CustomerList->id, 'bus' => $bus->id]) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to remove this planned ride?')" class="px-2 py-1 bg-red-600 hover:bg-red-500 text-white text-xs rounded">
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-sm text-gray-500">No planned rides</p>
                                        @endif
                                    </div>

                                    <div class="flex space-x-2 pt-3 border-t border-gray-200">
                                        <a href="{{ route('CustomerList.edit', $CustomerList) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('CustomerList.destroy', $CustomerList) }}" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete {{$CustomerList->name}}?')" class="w-full inline-flex justify-center items-center px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="px-6 py-4">
                        {{ $CustomerLists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
