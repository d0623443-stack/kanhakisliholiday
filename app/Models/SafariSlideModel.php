<?php

namespace App\Models;

use CodeIgniter\Model;

class SafariSlideModel extends Model
{
    protected $table            = 'safari_slides';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_num',
        'image',
        'tag',
        'caption',
        'status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActiveSlides(): array
    {
        return $this->where('status', 'active')
                    ->orderBy('order_num', 'ASC')
                    ->findAll();
    }

    public function getAllSlides(): array
    {
        return $this->orderBy('order_num', 'ASC')
                    ->findAll();
    }
}
