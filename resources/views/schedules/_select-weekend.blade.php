<div class="flex flex-wrap gap-3 mb-6">
    @foreach($dates as $weekIndex => $week)
        @php
            $startDate = \Carbon\Carbon::parse($week[0]['date']);
            $endDate = \Carbon\Carbon::parse($week[6]['date']);
            $isCurrentWeek = $weekIndex === 0;
        @endphp
        <button type="button" data-week="{{ $weekIndex }}" class="week-selector group relative flex-1 min-w-[200px] max-w-[250px] px-4 py-3 
                                        rounded-lg border shadow-sm transition-all duration-300 ease-in-out
                                        {{ $isCurrentWeek
            ? 'bg-gradient-to-b from-blue-50 to-blue-100 border-blue-300 shadow-inner'
            : 'bg-gradient-to-b from-white to-gray-50 border-gray-200 hover:border-blue-400 hover:from-blue-50 hover:to-white hover:shadow-md hover:-translate-y-0.5' }}
                                        focus:outline-none focus:ring-2 focus:ring-blue-500/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0 relative">
                        <div
                            class="absolute inset-0 bg-blue-100 rounded-lg transform -rotate-6 transition-transform group-hover:rotate-6">
                        </div>
                        <svg class="relative w-6 h-6 text-blue-600 transform transition-transform group-hover:scale-110"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.5 9.09H20.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="12" cy="13" r="1" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="flex flex-col items-start">
                        <span
                            class="text-xs font-medium text-blue-600 bg-white/80 px-2 py-0.5 rounded-full mb-0.5 shadow-sm">
                            Semana {{ $weekIndex + 1 }}
                        </span>
                        <span
                            class="text-sm font-semibold {{ $isCurrentWeek ? 'text-blue-800' : 'text-gray-800 group-hover:text-blue-700' }}">
                            {{ $startDate->format('d') }}
                            {{ $startDate->format('M') != $endDate->format('M') ? $startDate->format('M') : '' }}
                            - {{ $endDate->format('d M') }}
                        </span>
                    </div>
                </div>
                <div class="transform transition-all duration-300 group-hover:translate-x-1">
                    <svg class="w-5 h-5 {{ $isCurrentWeek ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.91016 19.92L15.4302 13.4C16.2002 12.63 16.2002 11.37 15.4302 10.6L8.91016 4.07999"
                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <!-- Barra de progreso solo visible en semana activa -->
            @if($isCurrentWeek)
                <div class="absolute left-0 right-0 bottom-0 h-0.5 overflow-hidden rounded-b-lg">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600
                                                transform origin-left scale-x-100
                                                transition-transform duration-500 ease-out"></div>
                </div>
            @endif
        </button>
    @endforeach
</div>