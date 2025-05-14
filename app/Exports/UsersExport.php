<?php

// app/Exports/UsersExport.php

namespace App\Exports;

use App\Models\Usersinfo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;

class UsersExport implements FromCollection
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Usersinfo::query();

        if ($this->request->filled('name')) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->request->name . '%')
                  ->orWhere('last_name', 'like', '%' . $this->request->name . '%');
            });
        }

        if ($this->request->filled('email')) {
            $query->where('email', 'like', '%' . $this->request->email . '%');
        }

        return $query->get(['first_name', 'last_name', 'email', 'username', 'user_type']);
    }
}