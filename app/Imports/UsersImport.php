<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    private $data = array();

    public function collection(Collection $collection)
    {
        foreach($collection as $row)
        {
            $user = array(
                'idx'=>$row[0],
                'id'=>$row[1],
            );
            array_push($this->data, $user);
        }
    }
    public function userList()
    {
        array_splice($this->data, 0, 1);
        return $this->data;
    }
}
