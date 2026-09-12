<?php

namespace App\Models;

use CodeIgniter\Model;

class EnquiryModel extends Model
{
    protected $table            = 'enquiries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'enquiry_code',
        'type',
        'name',
        'phone',
        'email',
        'date_requested',
        'timing',
        'zone_room',
        'vehicle_type',
        'adults',
        'children',
        'meal_plan',
        'nationality',
        'notes',
        'status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generateEnquiryCode(): string
    {
        do {
            $code = 'ENQ-' . rand(1000, 9999);
            $exists = $this->where('enquiry_code', $code)->first();
        } while ($exists);

        return $code;
    }

    public function getFiltered(?string $type = null, ?string $status = null, ?string $search = null): array
    {
        $builder = $this->orderBy('created_at', 'DESC');

        if ($type && $type !== 'all') {
            $builder->where('type', $type);
        }

        if ($status && $status !== 'all') {
            $builder->where('status', $status);
        }

        if ($search && trim($search) !== '') {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('phone', $search)
                    ->orLike('email', $search)
                    ->orLike('enquiry_code', $search)
                    ->groupEnd();
        }

        return $builder->findAll();
    }

    public function getSummaryCounts(): array
    {
        $db = \Config\Database::connect();
        
        $total = $db->table('enquiries')->countAllResults();
        $new   = $db->table('enquiries')->where('status', 'new')->countAllResults();
        $safari = $db->table('enquiries')->where('type', 'safari')->countAllResults();
        $stay   = $db->table('enquiries')->where('type', 'stay')->countAllResults();

        return [
            'totalEnquiries' => $total,
            'newEnquiries'   => $new,
            'safariBookings' => $safari,
            'stayBookings'   => $stay,
        ];
    }

    public function getRecent(int $limit = 5): array
    {
        return $this->orderBy('created_at', 'DESC')->findAll($limit);
    }
}
