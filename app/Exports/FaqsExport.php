<?php

namespace App\Exports;

use App\Faq;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FaqsExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $FaqsData = Faq::select('ask','answer','status','created_at')->get();
        return $FaqsData;
    }

    public function headings(): array{
    	return['Pregunta','Respuesta','Estado','Fecha Creacion'];
    }
}
