<?php

namespace App\Exports;

use App\Models\Offer\Offer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class OfferExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $vendorId;
    protected $vendorCache = [];

    public function __construct($vendorId = null)
    {
        $this->vendorId = $vendorId;
    }

    public function collection()
    {
        $query = Offer::orderBy('id', 'desc');
        if (!empty($this->vendorId)) {
            $userId = session()->get('userId');
            $vendorId = $this->vendorId;
            $query->where(function($q) use ($vendorId, $userId) {
                $q->where('created_by_id', $vendorId);
                if ($userId) {
                    $q->orWhere('created_by_id', $userId);
                }
            });
        }
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Shop Name',
            'Offer Title',
            'Offer Type',
            'Discount Type',
            'Value',
            'Threshold',
            'Created By',
            'Status',
            'Created Date'
        ];
    }

    public function map($row): array
    {
        $shop_name = 'N/A';
        $created_by = 'Shop';

        if ($row->created_by_id == 'admin' || $row->created_by_id === '1' || $row->created_by_id === 1) {
            $shop_name = 'Admin';
            $created_by = 'Admin';
        } else {
            $vendor = null;
            $createdById = $row->created_by_id;

            if ($createdById) {
                if (array_key_exists($createdById, $this->vendorCache)) {
                    $vendor = $this->vendorCache[$createdById];
                } else {
                    $vendor = DB::table('vendor_details')
                        ->where(function($q) use ($createdById) {
                            $q->where('vendor_details.user_id', $createdById)
                              ->orWhere('vendor_details.id', $createdById)
                              ->orWhere('vendor_details.vendor_id', $createdById);
                        })
                        ->leftJoin('zonals', 'zonals.id', '=', 'vendor_details.zone')
                        ->select('zonals.name as zone_name', 'vendor_details.shop_name')
                        ->first();

                    if (!$vendor) {
                        $u = DB::table('users')->where('id', $createdById)->first();
                        if ($u && !empty($u->login_id)) {
                            $vendor = DB::table('vendor_details')
                                ->where(function($q) use ($u) {
                                    $q->where('vendor_details.user_id', $u->login_id)
                                      ->orWhere('vendor_details.id', $u->login_id)
                                      ->orWhere('vendor_details.vendor_id', $u->login_id);
                                })
                                ->leftJoin('zonals', 'zonals.id', '=', 'vendor_details.zone')
                                ->select('zonals.name as zone_name', 'vendor_details.shop_name')
                                ->first();
                        }
                    }
                    $this->vendorCache[$createdById] = $vendor;
                }
            }

            if ($vendor != null && !empty($vendor->shop_name)) {
                $shop_name = $vendor->shop_name;
            } elseif (!empty($row->title) && str_contains($row->title, ' - ')) {
                $parts = explode(' - ', $row->title);
                if (!empty($parts[0]) && strlen($parts[0]) < 30) {
                    $shop_name = trim($parts[0]);
                }
            } else {
                $shop_name = 'N/A';
            }
        }

        $added_by = trim((string) ($row->added_by ?? ''));
        if ($added_by === 'Admin' || $row->created_by_id === 'Admin') {
            $created_by = 'Admin';
        } elseif (!empty($added_by) && $added_by !== 'Shop') {
            $created_by = $added_by;
        } else {
            if ($shop_name !== 'N/A' && $shop_name !== '-') {
                $created_by = $shop_name;
            } else {
                $created_by = 'Shop';
            }
        }

        $discountType = $row->cashbacktype;
        if (empty($discountType)) {
            if (!empty($row->discount_type)) {
                $discountType = $row->discount_type;
            } elseif (!empty($row->buy)) {
                $discountType = 'Buy (' . $row->buy . ')';
            } else {
                $discountType = '';
            }
        }

        $value = !empty($row->value) ? $row->value : (!empty($row->cashbackvalue) ? $row->cashbackvalue : '');
        $threshold = !empty($row->types) ? $row->types : '';

        return [
            str_pad($row->id, 4, '0', STR_PAD_LEFT),
            $shop_name,
            $row->title ?? '',
            $row->type ?? '',
            $discountType,
            $value,
            $threshold,
            $created_by,
            $row->status == 1 ? 'Active' : 'Inactive',
            $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF183543']
                ]
            ],
        ];
    }
}
