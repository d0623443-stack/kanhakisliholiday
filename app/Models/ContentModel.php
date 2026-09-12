<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $table            = 'site_content';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'page_key',
        'section_key',
        'content_key',
        'content_value',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = 'updated_at';

    /**
     * Get content for a specific page as a flat associative array: ['content_key' => 'content_value']
     */
    public function getPageContent(string $page): array
    {
        $rows = $this->where('page_key', $page)->findAll();
        $content = [];
        foreach ($rows as $row) {
            $content[$row['content_key']] = $row['content_value'];
        }
        return $content;
    }

    /**
     * Get all content grouped by page: ['home' => [...], 'safari' => [...]]
     */
    public function getAllContentGrouped(): array
    {
        $rows = $this->findAll();
        $grouped = [];
        foreach ($rows as $row) {
            $grouped[$row['page_key']][$row['content_key']] = $row['content_value'];
        }
        return $grouped;
    }

    /**
     * Update or insert a key value
     */
    public function setContent(string $pageKey, string $sectionKey, string $contentKey, ?string $contentValue): bool
    {
        $existing = $this->where('page_key', $pageKey)
                         ->where('content_key', $contentKey)
                         ->first();

        if ($existing) {
            return $this->update($existing['id'], ['content_value' => $contentValue]);
        }

        return (bool) $this->insert([
            'page_key'      => $pageKey,
            'section_key'   => $sectionKey,
            'content_key'   => $contentKey,
            'content_value' => $contentValue,
        ]);
    }
}
