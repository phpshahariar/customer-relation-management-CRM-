<?php

namespace App\Imports;

use App\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'group_name'     => $row[1],
            'name'     => $row[2],
            'phone'     => $row[3],
            'email'    => $row[4],

        ]);
    }
}
