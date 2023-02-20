<?php

namespace App\Blade\Directives;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class RoleDirective
{
    public function handle($role)
    {
        if (! Auth::check()) {
            return '';
        }
        $user = Auth::user();
        
        if ($user->role === $role) {
            return "<?php echo e(\$__env->make('partials.nav.' . $role, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render()); ?>";
        }
        
        return '';
    }
}