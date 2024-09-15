<x-select-input name="tank_id" title="Tank" :value="old('tank_id', $drop?->tank_id ?? '')" placeholder="Select..." :options="$tanks" />
<x-text-input name="volume_in_litres" title="Litres" :value="old('volume_in_litres', $drop?->volume_in_litres ?? '')" placeholder="Litres" />
<x-textarea-input name="reason" title="Reason" :value="old('reason', $adjustment?->reason ?? '')" placeholder="Reason" />
