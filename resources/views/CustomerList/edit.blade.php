<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            {{ __('Edit a customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-2 border-blue-200">
                <div class="p-6 text-blue-900">
                    <div class="border-l-4 border-blue-500 pl-4 mb-6">
                        <p class="text-blue-600 text-sm font-medium">Update customer information below</p>
                    </div>
                    <form method="POST" action="{{ route('CustomerList.update', $CustomerList) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <div>
                                <label for="name" class="text-blue-700 font-medium flex items-center">
                                    <i class="fas fa-user mr-2"></i>Name:
                                </label>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name', $CustomerList->name) }}"
                                   class="w-full rounded-md shadow-sm border-blue-200 focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div class="mt-4">
                            <div>
                                <label for="email" class="text-blue-700 font-medium flex items-center">
                                    <i class="fas fa-envelope mr-2"></i>Email:
                                </label>
                            </div>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email', $CustomerList->email) }}"
                                   class="w-full rounded-md shadow-sm border-blue-200 focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <div>
                                <label for="role" class="text-blue-700 font-medium flex items-center">
                                    <i class="fas fa-id-badge mr-2"></i>Role:
                                </label>
                            </div>
                            <select name="role" id="role"
                                    class="w-full rounded-md shadow-sm border-blue-200 focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option
                                    value="customer" {{ old('role', $CustomerList->role) === 'customer' ? 'selected' : '' }}>
                                    Customer
                                </option>
                                <option
                                    value="employee" {{ old('role', $CustomerList->role) === 'employee' ? 'selected' : '' }}>
                                    Employee
                                </option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <div>
                                <label for="points" class="text-blue-700 font-medium flex items-center">
                                    <i class="fas fa-star mr-2"></i>Points:
                                </label>
                            </div>
                            <input type="number"
                                   step="1"
                                   pattern="\d+"
                                   name="points"
                                   id="points"
                                   value="{{ old('points', $CustomerList->points) }}"
                                   class="w-full rounded-md shadow-sm border-blue-200 focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-4 text-blue-800 border-b-2 border-blue-100 pb-2 flex items-center">
                                <i class="fas fa-bus mr-2"></i> Planned Rides
                            </h3>
                            @if($CustomerList->buses && $CustomerList->buses->count() > 0)
                                <div class="space-y-4">
                                    @foreach($CustomerList->buses as $bus)
                                        <div
                                            class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-100 hover:bg-blue-100 transition duration-200">
                                            <div class="flex items-center">
                                                <i class="fas fa-bus text-blue-500 mr-3"></i>
                                                <span class="font-medium text-blue-700">Bus #{{ $bus->id }}</span>
                                                <span class="text-blue-600 ml-2">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ \Carbon\Carbon::parse($bus->departure_time)->format('d/m/Y H:i') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-blue-600 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    No planned rides found.
                                </p>
                            @endif
                        </div>

                        <div class="flex justify-between mt-6">
                            <a href="{{ route('CustomerList.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-white border border-blue-300 rounded-md font-semibold text-sm text-blue-700 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
