<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SidebarComposer
{
    public function compose(View $view)
    {
        $sidebar = 'layouts.sidebar'; // Default sidebar

        $user = Auth::user();

        if ($user && $user->role) {
            $role = is_object($user->role) ? $user->role->value : $user->role;

            if ($role === 'SUPER_ADMIN') {
                $sidebar = 'layouts.AdminSidebar';
            }
        }

        $view->with('sidebar', $sidebar);
    }
}
