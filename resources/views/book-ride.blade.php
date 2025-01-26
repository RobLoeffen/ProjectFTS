<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative">
                    <div class="h-48 w-full object-cover bg-gradient-to-r from-blue-500 to-indigo-600">
                        <div class="absolute inset-0 bg-black opacity-50"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h1 class="text-4xl font-bold text-white">Book Your Ride</h1>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('ride-order', ['bus'=>$bus->id]) }}" class="p-6">
                    @csrf
                    @method('POST')

                    <div class="max-w-3xl mx-auto">
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Bus Information</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Departure Time</p>
                                            <p class="text-lg font-semibold text-gray-900">{{$bus->departure_time}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Arrival Time</p>
                                            <p class="text-lg font-semibold text-gray-900">{{$bus->arrival_time}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Departure Location</p>
                                            <p class="text-lg font-semibold text-gray-900">{{$bus->departure_location}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Price per Ticket</p>
                                            <p class="text-lg font-semibold text-gray-900">€<span
                                                    id="basePrice">{{$bus->price}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="bg-indigo-50 rounded-lg p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500">Use Points for Free
                                                    Ticket</p>
                                                <p class="text-xs text-gray-500">You have {{auth()->user()->points}}
                                                    points</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox"
                                                   id="usePoints"
                                                   name="usePoints"
                                                   data-required-points="100"
                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                   onchange="updateTotalPrice()">
                                            <span class="text-sm text-gray-500">(100 points needed)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="space-y-1">
                                            <label for="ticketCount" class="block text-sm font-medium text-gray-700">
                                                Number of Tickets
                                            </label>
                                            <input type="number"
                                                   name="ticketCount"
                                                   id="ticketCount"
                                                   min="1"
                                                   value="1"
                                                   class="w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                   onchange="updateTotalPrice()">
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-500">Total Amount</p>
                                            <p class="text-2xl font-bold text-indigo-600">€<span
                                                    id="totalPrice">{{$bus->price}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-between items-center">
                                <a href="{{ route('festivals') }}"
                                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Back to List
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateTotalPrice() {
            const basePrice = parseFloat(document.getElementById('basePrice').textContent);
            const ticketCount = parseInt(document.getElementById('ticketCount').value);
            const usePoints = document.getElementById('usePoints').checked;
            const userPoints = {{ auth()->user()->points }};

            let totalPrice;

            if (usePoints) {
                if (userPoints >= 100) {
                    // When using points and has enough points, subtract the base price from total
                    totalPrice = ((basePrice * ticketCount) - basePrice).toFixed(2);
                } else {
                    // If not enough points, uncheck the checkbox and show error
                    document.getElementById('usePoints').checked = false;
                    alert('You need at least 100 points to get a free ticket!');
                    totalPrice = (basePrice * ticketCount).toFixed(2);
                }
            } else {
                // Regular calculation without points
                totalPrice = (basePrice * ticketCount).toFixed(2);
            }

            document.getElementById('totalPrice').textContent = totalPrice;
        }
    </script>
</x-app-layout>
