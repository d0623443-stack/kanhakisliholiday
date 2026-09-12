<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'key_name';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'key_name',
        'value_content',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = 'updated_at';

    public function getAllSettings(): array
    {
        $rows = $this->findAll();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key_name']] = $row['value_content'];
        }
        return $settings;
    }

    public function getSetting(string $key, ?string $default = null): ?string
    {
        $row = $this->where('key_name', $key)->first();
        return $row ? $row['value_content'] : $default;
    }

    public function setSetting(string $key, ?string $value): bool
    {
        $existing = $this->where('key_name', $key)->first();
        if ($existing) {
            return $this->update($key, ['value_content' => $value]);
        }
        return (bool) $this->insert(['key_name' => $key, 'value_content' => $value]);
    }
}
