<x-text-input name="name" title="Name" :value="old('name', $tank?->name ?? '')" placeholder="Name" />
<x-text-input name="volume_in_liters" title="Volume Litres" :value="old('volume_in_liters', $tank?->volume_in_liters ?? '')" placeholder="Volume Litres" />
