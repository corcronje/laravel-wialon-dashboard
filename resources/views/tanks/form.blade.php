<x-text-input name="name" title="Name" :value="old('name', $tank?->name ?? '')" placeholder="Name" />
<x-text-input name="volume_in_litres" title="Volume Litres" :value="old('volume_in_litres', $tank?->volume_in_litres ?? '')" placeholder="Volume Litres" />
