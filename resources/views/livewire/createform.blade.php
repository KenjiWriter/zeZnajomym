<div>
    <form class="form-container" wire:submit.prevent="submit" method="POST">
        <label for="location">Wprowadź swoja lokalizacje</label>
        <input class="form-input" type="text" wire:model="city" placeholder="Miasto">
        <input class="form-input" type="text" wire:model="street" placeholder="Ulica">
        <label for="price">Cena za kilometr</label>
        <input class="form-input" type="text" wire:model="price_per_km" placeholder="Cena za kilometr">
        <label for="type">Czy chcesz naliczać z uwzględnieniem stref?</label>
        <select class="form-input" id="type" wire:model="type">
            <option value="0">Nie</option>
            <option value="1">Jedna strefa</option>
            <option value="2">Dwie strefy</option>
            <option value="3">Trzy strefy</option>
            <option value="4">Cztery strefy</option>
            <option value="5">Pieć stref</option>
        </select>
        

        <input class="form-submit" type="submit" value="Stwórz formularz">
    </form>
</div>
