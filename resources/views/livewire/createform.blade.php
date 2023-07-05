<div>
    <form class="form-container" wire:submit.prevent="submit">
        <label for="name">Jak masz na imie?</label>
        <input @error('driver_name') style="border-color:red; font-style:bold;" @enderror class="form-input"
            type="text" wire:model="driver_name" placeholder="Twoje imie">
        <label for="location">Wprowadź swoja lokalizacje</label>
        <input @error('postcode') style="border-color:red; font-style:bold;" @enderror class="form-input" type="text"
            wire:model="postcode" placeholder="Kod pocztowy">
        <input @error('city') style="border-color:red; font-style:bold;" @enderror class="form-input" type="text"
            wire:model="city" placeholder="Miasto">
        <input @error('street') style="border-color:red; font-style:bold;" @enderror class="form-input" type="text"
            wire:model="street" placeholder="Ulica">
        <label for="location">typ naliczania</label>
        <select class="form-input" id="pricing_type" wire:model="price_type">
            <option value="1">Cena za przejechany km.</option>
            <option value="2">Cena uwzgledniajaca zużycie paliwa</option>
        </select>
        @if ($price_type == 1)
            <div class="">
                <label for="price">Cena za kilometr</label>
                <input class="form-input" type="text" wire:model="price_per_km" placeholder="Cena za kilometr">
            </div>
        @else
            <div class="">
                <label for="price">Twoje zużycie paliwa</label>
                <input class="form-input" type="text" wire:model="avg_fuel_con" placeholder="paliwo...">
                <label for="price">Cena za litr paliwa</label>
                <input class="form-input" type="text" wire:model="fuel_price" placeholder="cena za litr...">
            </div>
        @endif
        <label for="zones">Czy chcesz naliczać z uwzględnieniem stref?</label>
        <select class="form-input" id="zones" wire:model="zones">
            <option value="0">Nie</option>
            <option value="1">Jedna strefa</option>
            <option value="2">Dwie strefy</option>
            <option value="3">Trzy strefy</option>
            <option value="4">Cztery strefy</option>
            <option value="5">Pieć stref</option>
        </select>

        @if ($zones > 0)
            @for ($i = 1; $i <= $zones; $i++)
                <div class="zone-container">
                    <label class="zone-label">Strefa {{ $i }}</label>
                    <div class="input-group">
                        <input wire:model="zonesInfo.{{ $i }}.from_range" type="text"
                            placeholder="Od ilu kilometrów od Ciebie" class="zone-input">
                        <input wire:model="zonesInfo.{{ $i }}.multiplier" type="text"
                            placeholder="mnożnik (np. 1.1, 3.1 | jeśli 1.1 to wtedy cena za km 4zł * 1.1 = 4.1zł za km po przekroczeniu strefy)"
                            class="zone-input">
                    </div>
                </div>
            @endfor
        @endif


        <input class="form-submit" type="submit" value="Stwórz formularz">
    </form>
</div>
