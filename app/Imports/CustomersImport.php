<?php

namespace App\Imports;

use App\CustomerContact;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $id;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function model(array $row)
    {
        return new CustomerContact([
            'group_id'     => $this->name,
            'name'     => $row[1],
            'phone'     => $row[2],
            'email'    => $row[3],
        ]);
    }
}
