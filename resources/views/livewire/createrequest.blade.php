<div>

    @if ($finish == true)
    @else
        <div class="">
            Cześć! {{ $profile['name'] }} wysłał Ci ten formualrz żebyś w szybki sposób mógł zobaczyć ile chciałby zebyś
            oddał
            mu za tą podwózkę! A więc do dzieła

            <form class="form-container" wire:submit.prevent="submit">
                <label for="name">Zacznijmy od tego jak masz na imie (Jeśli nie chcesz nie musisz tego
                    podawać!)</label>
                <input @error('driver_name') style="border-color:red; font-style:bold;" @enderror class="form-input"
                    type="text" wire:model="driver_name" placeholder="Twoje imie">
                <label for="location">Wpisz gdzie sie aktualnie znajdujesz</label>
                <input @error('postcode') style="border-color:red; font-style:bold;" @enderror class="form-input"
                    type="text" wire:model="postcode" placeholder="Kod pocztowy">
                <input @error('city') style="border-color:red; font-style:bold;" @enderror class="form-input"
                    type="text" wire:model="city" placeholder="Miasto">
                <input @error('street') style="border-color:red; font-style:bold;" @enderror class="form-input"
                    type="text" wire:model="street" placeholder="Ulica">

                <label for="location">A teraz gdzie chcesz sie dostać</label>
                <input @error('postcode') style="border-color:red; font-style:bold;" @enderror class="form-input"
                    type="text" wire:model="postcode" placeholder="Kod pocztowy">
                <input @error('city') style="border-color:red; font-style:bold;" @enderror class="form-input"
                    type="text" wire:model="city" placeholder="Miasto">
                <input @error('street') style="border-color:red; font-style:bold;" @enderror class="form-input"
                    type="text" wire:model="street" placeholder="Ulica">
                <input class="form-submit" type="submit" value="Zakończ">
            </form>
        </div>
    @endif
</div>
