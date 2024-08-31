<x-select-input name="tank_id" title="Tank" :value="old('tank_id', $adjustment?->tank_id ?? '')" placeholder="Select..." :options="$tanks" />
<x-text-input name="volume_in_litres" title="Litres" :value="old('volume_in_litres', $adjustment?->volume_in_litres ?? '')" placeholder="Litres" />
