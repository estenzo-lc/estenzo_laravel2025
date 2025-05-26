<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Upload;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a paginated list of users with optional filtering.
     * Only accessible by users with 'Admin' user_type.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $currentUser = session('user');

        // Authorization: only admins allowed
        if (!$currentUser || $currentUser->user_type !== 'Admin') {
            abort(403, 'Access denied');
        }

        $query = Usersinfo::query();

        // Filter by name (first or last)
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->name}%")
                  ->orWhere('last_name', 'like', "%{$request->name}%");
            });
        }

        // Filter by email
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // Paginate results and keep query string for filters
        $users = $query->paginate(10)->withQueryString();

        // Return the user list view with users data
        return view('user-list', compact('users'));
    }

    /**
     * Delete a user by ID.
     * Only admins can delete users.
     * Admins cannot delete their own accounts.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $currentUser = session('user');

        // Authorization: only admins allowed
        if (!$currentUser || $currentUser->user_type !== 'Admin') {
            abort(403, 'Access denied');
        }

        // Prevent admins from deleting their own account
        if ($currentUser->id == $id) {
            return back()->withErrors(['delete' => 'You cannot delete your own account.']);
        }

        $user = Usersinfo::find($id);

        if ($user) {
            $user->delete();
            return back()->with('success', 'User deleted successfully.');
        }

        return back()->withErrors(['delete' => 'User not found.']);
    }

    /**
     * Export users to a CSV file.
     * Only admins are allowed to export.
     * Uses the UsersExport class to generate the file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        $currentUser = session('user');

        // Authorization: only admins allowed
        if (!$currentUser || $currentUser->user_type !== 'Admin') {
            abort(403, 'Access denied');
        }

        // Trigger Excel export with applied filters in UsersExport
        return Excel::download(new UsersExport($request), 'users.csv');
    }
}
