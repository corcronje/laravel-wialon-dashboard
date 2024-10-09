<x-text-input name="tag_id" title="Tag Number" :value="old('tag_id', $attendant?->tag_id ?? '')" placeholder="Tag Number" />
<x-text-input name="employee_number" title="Employee Number" :value="old('employee_number', $attendant?->employee_number ?? '')" placeholder="Employee Number" />
<x-text-input name="name" title="Name" :value="old('name', $attendant?->name ?? '')" placeholder="Name" />
<x-text-input name="lastname" title="Name" :value="old('lastname', $attendant?->lastname ?? '')" placeholder="Lastname" />
