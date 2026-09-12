<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table            = 'gallery_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category',
        'title',
        'subtitle',
        'image',
        'aspect',
        'order_num',
        'views',
        'status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActiveItems(?string $category = null): array
    {
        $builder = $this->where('status', 'active');
        if ($category && $category !== 'all') {
            $builder->where('category', $category);
        }
        return $builder->orderBy('order_num', 'ASC')->findAll();
    }

    public function getPreviewItems(int $limit = 3): array
    {
        return $this->where('status', 'active')
                    ->orderBy('order_num', 'ASC')
                    ->findAll($limit);
    }
}
