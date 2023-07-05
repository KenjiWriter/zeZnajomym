<div>
    <style>
        @keyframes loading-animation {
            0% {
                content: 'Trwa obliczanie kosztów';
            }

            33% {
                content: 'Trwa obliczanie kosztów.';
            }

            66% {
                content: 'Trwa obliczanie kosztów..';
            }

            100% {
                content: 'Trwa obliczanie kosztów...';
            }
        }

        #loading-dots::after {
            content: 'Trwa obliczanie kosztów...';
            animation: loading-animation 1s infinite;
        }
    </style>
    @if ($finish == true)
        Koszt podrózy z uwzględnieme wsyztskich danych podanych przed {{ $profile['name'] }} oraz Ciebie wynosi:
        {{ $total_cost }}zł i obejmuje on łaczny przejazd auta przez {{ $total_distance }}km.
    @else
        @if (!$isSubmitting)
            <div>
                Cześć! {{ $profile['name'] }} wysłał Ci ten formularz, żebyś w szybki sposób mógł zobaczyć ile chciałby
                żebyś oddał mu za tę podwózkę! A więc do dzieła
                <form class="form-container" wire:submit.prevent="submit">
                    <label for="name">Zacznijmy od tego jak masz na imię (Jeśli nie chcesz, nie musisz tego
                        podawać!)</label>
                    <input @error('friend_name') style="border-color:red; font-style:bold;" @enderror class="form-input"
                        type="text" wire:model="driver_name" placeholder="Twoje imię">
                    <label for="location">Wpisz, gdzie się aktualnie znajdujesz</label>
                    <input @error('postcode') style="border-color:red; font-style:bold;" @enderror class="form-input"
                        type="text" wire:model="from_postcode" placeholder="Kod pocztowy">
                    <input @error('city') style="border-color:red; font-style:bold;" @enderror class="form-input"
                        type="text" wire:model="from_city" placeholder="Miasto">
                    <input @error('street') style="border-color:red; font-style:bold;" @enderror class="form-input"
                        type="text" wire:model="from_street" placeholder="Ulica">

                    <label for="location">A teraz gdzie chcesz się dostać</label>
                    <input @error('postcode') style="border-color:red; font-style:bold;" @enderror class="form-input"
                        type="text" wire:model="to_postcode" placeholder="Kod pocztowy">
                    <input @error('city') style="border-color:red; font-style:bold;" @enderror class="form-input"
                        type="text" wire:model="to_city" placeholder="Miasto">
                    <input @error('street') style="border-color:red; font-style:bold;" @enderror class="form-input"
                        type="text" wire:model="to_street" placeholder="Ulica">
                    <input class="form-submit" type="submit" value="Zakończ">
                </form>
            </div>
        @else
            <div>
                <span style="font-size: 40px;" id="loading-dots"></span>
            </div>
        @endif
    @endif
    <script>
        window.addEventListener('livewire:load', function() {
            Livewire.hook('element.initialized', (el, component) => {
                if (el.id === 'loading-dots') {
                    el.style.display = 'inline-block';
                    el.style.animation = 'loading-animation 1s infinite';
                }
            });

            Livewire.hook('element.removed', (el, component) => {
                if (el.id === 'loading-dots') {
                    el.style.display = 'none';
                    el.style.animation = '';
                }
            });
        });
    </script>
</div>
