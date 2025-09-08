<?php

namespace App\Exports;

use App\Models\jemaah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JemaahExport implements FromCollection, WithHeadings
{
    protected $groupId;

    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }

    public function collection()
    {
        return jemaah::with(['bioJemaah', 'infoSales']) // load relasi
            ->where('group_id', $this->groupId)
            ->get()
            ->map(function ($jemaah) {
                return [
                    'nama_lengkap'       => $jemaah->bioJemaah->nama_lengkap ?? '-',
                    'nik'                => (string) $jemaah->bioJemaah->nik ?? '-',
                    'email'              => $jemaah->bioJemaah->email ?? '-',
                    'tanggal_lahir'      => $jemaah->bioJemaah->tanggal_lahir ?? '-',
                    'jenis_kelamin'      => $jemaah->bioJemaah->jenis_kelamin ?? '-',
                    'tempat_lahir'       => $jemaah->bioJemaah->tempat_lahir ?? '-',

                    'no_hp'              => (string) $jemaah->no_hp,
                    'usia'               => $jemaah->usia,
                    'alamat'             => $jemaah->alamat,
                    'kecamatan'          => $jemaah->kecamatan,

                    'pembatalan'         => $jemaah->pembatalan ? 'Ya' : 'Tidak',
                    'tanggal_pembatalan' => $jemaah->tanggal_pembatalan ?? '-',
                    'alasan_pembatalan'  => $jemaah->alasan_pembatalan ?? '-',

                    'kantor_sales'       => $jemaah->infoSales->kantor ?? '-',
                    'label_sales'        => $jemaah->infoSales->label ?? '-',
                    'nama_sales'         => $jemaah->infoSales->nama ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NIK',
            'Email',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Tempat Lahir',
            'No HP',
            'Usia',
            'Alamat',
            'Kecamatan',
            'Status Pembatalan',
            'Tanggal Pembatalan',
            'Alasan Pembatalan',
            'Kantor Sales',
            'Label Sales',
            'Nama Sales',
        ];
    }
}
