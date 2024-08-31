<x-text-input name="name" title="Name" :value="old('name', $pump?->name ?? '')" placeholder="Name" />
<x-textarea-input name="description" title="Description" :value="old('description', $pump?->description ?? '')" placeholder="Description" />
<x-text-input name="cents_per_litre" title="Cents Per Litre" :value="old('cents_per_litre', $pump?->cents_per_litre ?? '')" placeholder="Cents Per Litre" />
<x-text-input name="volume_litres" title="Volume Litres" :value="old('volume_litres', $pump?->volume_litres ?? '')" placeholder="Volume Litres" />
<x-text-input name="pulses_per_litre" title="Pulses Per Litre" :value="old('pulses_per_litre', $pump?->pulses_per_litre ?? '')" placeholder="Pulses Per Litre" />
<x-select-input name="status" title="Status" :value="old('status', $pump?->status ?? '')" placeholder="Select..." :options="['active' => 'Active', 'inactive' => 'Inactive']" />
