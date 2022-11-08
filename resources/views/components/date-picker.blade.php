<div>
    <div class="flatpickr flatpickr-{{ $attributes['id'] }} relative">
        @if(!isset($attributes['required']))
            <div class="absolute inset-y-0 left-0 flex items-center">
                <button id="clear-{{ $attributes['id'] }}" type="button" class="text-rose-600 w-10 h-full" data-clear>
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
        @endif

        <input type="text" class="form-control" {{ $attributes }} data-input>
    </div>
</div>

{{-- @push('scripts') --}}
    <script>
        if (typeof flatpickr === 'function') {
            console.log('===')
            run();
        } 
        document.addEventListener("livewire:load", () => {
            function update(value) {
                let el = document.getElementById('clear-{{ $attributes['id'] }}')

                if (value === '') {
                    value = null

                    if (el !== null) {
                        el.classList.add('invisible')
                    }
                } else if (el !== null) {
                    el.classList.remove('invisible')
                }

            @this.set('{{ $attributes['wire:model'] }}', value)
        }
            @if($attributes['picker'] === 'date')
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                dateFormat: "{{ config('project.flatpickr_date_format') }}",
                wrap: true,
                onChange: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })
            @elseif($attributes['picker'] === 'time')
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                enableTime: true,
                // enableSeconds: true,
                noCalendar: true,
                time_24hr: true,
                wrap: true,
                dateFormat: "{{ config('project.flatpickr_time_format') }}",
                onChange: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })

            @elseif($attributes['picker'] === 'range')
            let dateRange = getDateRangeDefault();
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                mode: "range",
                defaultDate: [dateRange[0], dateRange[1]],
                dateFormat: "{{ config('project.flatpickr_date_format') }}",
                allowInput: false,
                wrap: true,
                onClose: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })

            @else
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                enableTime: true,
                time_24hr: true,
                wrap: true,
                // enableSeconds: true,
                dateFormat: "{{ config('project.flatpickr_datetime_format') }}",
                onChange: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })
            @endif
        });
        

        function update(value) {
                let el = document.getElementById('clear-{{ $attributes['id'] }}')

                if (value === '') {
                    value = null

                    if (el !== null) {
                        el.classList.add('invisible')
                    }
                } else if (el !== null) {
                    el.classList.remove('invisible')
                }

            @this.set('{{ $attributes['wire:model'] }}', value)
        }
        function run () {
            @if($attributes['picker'] === 'date')
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                dateFormat: "{{ config('project.flatpickr_date_format') }}",
                wrap: true,
                onChange: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })
            @elseif($attributes['picker'] === 'time')
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                enableTime: true,
                // enableSeconds: true,
                noCalendar: true,
                time_24hr: true,
                wrap: true,
                dateFormat: "{{ config('project.flatpickr_time_format') }}",
                onChange: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })

            @elseif($attributes['picker'] === 'range')
            let dateRange = getDateRangeDefault();
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                mode: "range",
                defaultDate: [dateRange[0], dateRange[1]],
                dateFormat: "{{ config('project.flatpickr_date_format') }}",
                allowInput: false,
                wrap: true,
                onClose: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })

            @else
            let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
                enableTime: true,
                time_24hr: true,
                wrap: true,
                // enableSeconds: true,
                dateFormat: "{{ config('project.flatpickr_datetime_format') }}",
                onChange: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                },
                onReady: (SelectedDates, DateStr, instance) => {
                    update(DateStr)
                }
            })
            @endif
        }

        function getDateRangeDefault() {
            let date = new Date();
            date.setMonth(date.getMonth() - 1);
            let startDate = date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0')
                + '-' + String(date.getDate()).padStart(2, '0');

            date.setMonth(date.getMonth() + 2);
            let endDate = date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0')
                + '-' + String(date.getDate()).padStart(2, '0');

            return [startDate, endDate];
        }
    </script>
{{-- @endpush --}}