<?php

namespace App\Exports;

use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityLogExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Activity::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Log name',
            'Description',
            'Subject ID',
            'Subject Type',
            'Causer ID',
            'Causer Type',
            'Properties',
            'Created At',
            'Updated At',
            'Batch ID',
        ];
    }
}
