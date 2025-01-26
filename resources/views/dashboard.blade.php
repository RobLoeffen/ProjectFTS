<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TransitHub Dashboard') }}
        </h2>
    </x-slot>

    <div class="relative w-full max-w-2xl mx-auto mt-8">
        <h3 class="text-2xl font-bold text-center mb-4 text-gray-800 dark:text-white flex items-center justify-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.5V10c0-1.7-1.3-3-3-3h-1V4c0-.6-.4-1-1-1s-1 .4-1 1v3h-2V4c0-.6-.4-1-1-1s-1 .4-1 1v3H9V4c0-.6-.4-1-1-1S7 3.4 7 4v3H6c-1.7 0-3 1.3-3 3v5.5c0 1.9 1.3 3.5 3 3.5h12c1.7 0 3-1.6 3-3.5zM6 16V10h12v6H6z"></path>
            </svg>
            Available Festivals
        </h3>
    </div>

    <div class="relative w-full max-w-2xl mx-auto h-80" x-data="festivalSlider">
          <div class="relative h-full overflow-hidden rounded-lg shadow-xl">
            @if(count($festivals) === 0)
                <div class="absolute w-full h-full bg-gradient-to-r from-indigo-600 to-blue-700 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-white">No Upcoming Festivals</h2>
                        <p class="mt-2 text-white/80">Check back later for new events!</p>
                    </div>
                </div>
            @else
                <template x-for="(festival, index) in festivals.slice(0, 4)" :key="index">
                    <div
                        x-show="currentIndex === index"
                        x-transition:enter="transition transform duration-300"
                        x-transition:enter-start="translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="-translate-x-full"
                        class="absolute w-full h-full bg-gradient-to-r from-indigo-600 to-blue-700 flex items-center justify-center"
                    >
                        <div class="text-center">
                            <h2 x-text="festival.title" class="text-4xl font-bold text-white"></h2>
                        </div>
                    </div>
                </template>

                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                    <template x-for="(festival, index) in festivals.slice(0, 4)" :key="index">
                        <button
                            @click="currentIndex = index"
                            :class="{'bg-white': currentIndex === index, 'bg-white/50': currentIndex !== index}"
                            class="w-2 h-2 rounded-full transition-colors duration-300"
                        ></button>
                    </template>
                </div>
            @endif
        </div>
    </div>

    @if(auth()->user()->role === 'customer')
        <div class="flex justify-center mt-4">
            <a href="{{ route('festivals') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition-colors duration-200 flex items-center space-x-2">
                <span>View All Festivals</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    @endif

    @if(auth()->user()->role === 'employee')
        <div class="flex justify-center mt-4">
            <a href="{{ route('Festivals.index') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition-colors duration-200 flex items-center space-x-2">
                <span>Manage Festivals</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    @endif

    @if(auth()->user()->role === 'customer')
        <div class="relative w-full max-w-2xl mx-auto mt-8">
            <h3 class="text-2xl font-bold text-center mb-4 text-gray-800 dark:text-white flex items-center justify-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Your Upcoming Rides
            </h3>
            @if(auth()->user()->buses->isEmpty())
                <div class="bg-gradient-to-r from-indigo-600 to-blue-700 rounded-lg overflow-hidden shadow-lg mb-4 p-8 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <p class="text-white text-lg">No upcoming rides planned</p>
                    <p class="text-white/80 mt-2">Book your next journey today!</p>
                </div>
            @else
                @foreach(auth()->user()->buses->take(3) as $bus)
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-700 rounded-lg overflow-hidden shadow-lg mb-4 transform transition-transform hover:scale-102">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Bus number
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Departure location
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Departure time
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Arrival time
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white/5 hover:bg-white/10 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                    {{ $bus->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                    {{ $bus->departure_location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                    {{ $bus->departure_time }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                    {{ $bus->arrival_time }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endif

            <div class="flex justify-center mt-4">
                <a href="{{ route('profile.edit') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition-colors duration-200 flex items-center space-x-2">
                    <span>View All Rides</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    @endif

    @if(auth()->user()->role === 'employee')
        <div class="max-w-2xl mx-auto mt-8">
            <h3 class="text-2xl font-bold text-center mb-4 text-gray-800 dark:text-white flex items-center justify-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Recent Customers
            </h3>
            <div class="grid grid-cols-2 gap-4">
                @foreach($users->take(4) as $user)
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-700 rounded-lg p-4 text-center cursor-pointer hover:from-indigo-700 hover:to-blue-800 transition-colors duration-200 transform hover:scale-102">
                        <div class="font-bold text-white">{{ $user->name }}</div>
                        <div class="text-sm text-white/80">{{ $user->email }}</div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center mt-4">
                <a href="{{ route('CustomerList.index') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition-colors duration-200 flex items-center space-x-2">
                    <span>View All Customers</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('festivalSlider', () => ({
                currentIndex: 0,
                festivals: @json($festivals),
                init() {
                    if (this.festivals.length > 0) {
                        this.autoSlide = setInterval(() => {
                            this.nextSlide()
                        }, 3000)
                    }
                },
                nextSlide() {
                    this.currentIndex = this.currentIndex === 3 ? 0 : this.currentIndex + 1
                }
            }))
        })
    </script>
</x-app-layout>
