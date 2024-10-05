<x-text-input name="tag_id" title="Tag Number" :value="old('tag_id', $driver?->tag_id ?? '')" placeholder="Tag Number" />
<x-text-input name="employee_number" title="Employee Number" :value="old('employee_number', $driver?->employee_number ?? '')" placeholder="Employee Number" />
<x-text-input name="name" title="Name" :value="old('name', $driver?->name ?? '')" placeholder="Name" />
