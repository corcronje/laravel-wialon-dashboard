<x-select-input name="tank_id" title="Tank" :value="old('tank_id', $transaction?->tank_id ?? '')" placeholder="Select..." :options="$tanks" />
<x-text-input name="volume_in_litres" title="Litres" :value="old('volume_in_litres', $transaction?->volume_in_litres ?? '')" placeholder="Litres" />
