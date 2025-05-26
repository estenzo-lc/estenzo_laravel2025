<?php

// app/Exports/UsersExport.php

namespace App\Exports;

use App\Models\Usersinfo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;

// This class is used to export user data to an Excel file
class UsersExport implements FromCollection
{
    // Holds the request object to access filter inputs
    protected $request;

    // Constructor to inject the current HTTP request
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // This method returns a collection of users based on filter criteria
    public function collection()
    {
        // Start a query on the Usersinfo model
        $query = Usersinfo::query();

        // Filter by name if provided in the request
        if ($this->request->filled('name')) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->request->name . '%')
                  ->orWhere('last_name', 'like', '%' . $this->request->name . '%');
            });
        }

        // Filter by email if provided in the request
        if ($this->request->filled('email')) {
            $query->where('email', 'like', '%' . $this->request->email . '%');
        }

        // Return the filtered collection with selected columns
        return $query->get(['first_name', 'last_name', 'email', 'username', 'user_type']);
    }
}
