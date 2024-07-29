<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProjectsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $index = 0;

    public function collection()
    {
        return Project::with(['type', 'sbu', 'status', 'technician'])->get();
    }

    public function map($project): array
    {
        $this->index++;
        return [
            $this->index,
            $project->project_name,
            $project->olt_hostname,
            $project->no_sp2k_spa,
            $project->ip_olt,
            $project->type->type_name ?? '',
            $project->sbu->sbu_name ?? '',
            $project->kendala,
            $project->progress,
            $project->status->status_name ?? '',
            $project->start_date,
            $project->target,
            $project->end_date,
            $project->latitude,
            $project->longitude,
            $project->radius,
            $project->is_active ? 'Yes' : 'No',
            $project->technician->name ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            'No.',
            'Project Name',
            'OLT Hostname',
            'No SP2K/SPA',
            'IP OLT',
            'Type',
            'SBU',
            'Kendala',
            'Progress',
            'Status',
            'Start Date',
            'Target',
            'End Date',
            'Latitude',
            'Longitude',
            'Radius',
            'Is Active',
            'Technician',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $centerAlignColumns = ['A', 'E', 'F', 'G', 'J', 'K', 'L', 'M', 'Q'];
        foreach ($centerAlignColumns as $column) {
            $sheet->getStyle($column . '2:' . $column . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        $sheet->getDefaultRowDimension()->setRowHeight(20);

        $sheet->freezePane('A2');

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}