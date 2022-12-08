<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RtfToCsvExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function  __construct($data)
    {
        $this->body = $data;
    }

    public function collection()
    {
        $collection = collect([]);
        $i = 0;
        foreach ($this->body as $words)
        {
            $collection[$i] =[
                $words,
            ];
            $i++;
        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            ''
        ];
    }
}
