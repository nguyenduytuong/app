@props(['direction' => '', 'sortable' => false])

<th scope="col"
    {{ $attributes->class(['px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider', 'cursor-pointer' => $sortable]) }}>
    @if ($sortable)
        <span class="flex w-full items-center">
            <span class="flex min-w-0 items-center justify-between space-x-3">
                {{ $slot }}
            </span>

            @switch($direction)
                @case('asc')
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="flex-shrink-0 h-5 w-5 text-gray-700 group-hover:text-gray-700" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                @break
                @case('desc')
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="flex-shrink-0 h-5 w-5 text-gray-700 group-hover:text-gray-700" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                @break
                @default
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-400"
                        x-description="Heroicon name: solid/selector" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
            @endswitch
        </span>
    @else
        {{ $slot }}
    @endif

</th>
