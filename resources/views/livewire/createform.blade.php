<div>
    <form class="form-container" wire:submit.prevent="submit" method="POST">
        <label for="location">Wprowadź swoja lokalizacje</label>
        <input class="form-input" type="text" wire:model="city" placeholder="Miasto">
        <input class="form-input" type="text" wire:model="street" placeholder="Ulica">
        <label for="price">Cena za kilometr</label>
        <input class="form-input" type="text" wire:model="price_per_km" placeholder="Cena za kilometr">
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
                        <input wire:model="zonesInfo.{{ $i }}.to_range" type="text"
                            placeholder="Do ilu kilometrów od Ciebie" class="zone-input">
                        <input wire:model="zonesInfo.{{ $i }}.multiplier" type="text"
                            placeholder="mnożnik" class="zone-input">
                    </div>
                </div>
            @endfor
        @endif


        <input class="form-submit" type="submit" value="Stwórz formularz">
    </form>
</div>
