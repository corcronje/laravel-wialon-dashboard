<x-select-input name="role_id" title="Role" :value="old('role_id', $user->role_id ?? 0)" :options="$roles" placeholder="Select a role" />
<x-text-input name="name" title="Name" :value="old('name', $user->name ?? '')" placeholder="Name" />
<x-email-input name="email" title="Email" :value="old('email', $user->email ?? '')" placeholder="Email" />
<x-password-input name="password" title="Password" placeholder="Password" />
<x-password-input name="password_confirmation" title="Confirm Password" :value="old('name', $user->name ?? '')" placeholder="Confirm password" />
