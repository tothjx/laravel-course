<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show profile edit form
     */
    public function profile()
    {
        return view('admin.profile', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('admin.profile')->with('success', 'Profil sikeresen frissítve!');
    }

    /**
     * Show password change form
     */
    public function password()
    {
        return view('admin.password');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'A jelenlegi jelszó nem megfelelő.'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.password')->with('success', 'Jelszó sikeresen megváltoztatva!');
    }

    /**
     * Get notifications (AJAX)
     */
    public function notifications()
    {
        $notifications = Auth::user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => Auth::user()->unreadNotifications->count()
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markNotificationRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    /**
     * List all orders
     */
    public function orders()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.orders', [
            'orders' => $orders
        ]);
    }
}
