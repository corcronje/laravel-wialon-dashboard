<x-text-input name="employee_number" title="Employee Number" :value="old('employee_number', $driver?->employee_number ?? '')" placeholder="Employee number" />
<x-text-input name="name" title="Name" :value="old('name', $driver?->name ?? '')" placeholder="Name" />
