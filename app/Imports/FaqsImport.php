<?php

namespace App\Imports;

use App\Faq;
use Maatwebsite\Excel\Concerns\ToModel;

class FaqsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Faq([
            'ask' => $row[0],
            'answer' =>$row[1],
            'status' =>$row[2],

        ]);
    }
}
