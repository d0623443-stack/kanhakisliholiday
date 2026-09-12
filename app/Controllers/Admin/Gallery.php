<?php

namespace App\Controllers\Admin;

use App\Models\GalleryModel;

class Gallery extends AdminBaseController
{
    protected GalleryModel $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $selectedCategory = $this->request->getGet('category') ?? 'all';

        $builder = $this->galleryModel->orderBy('order_num', 'ASC')->orderBy('id', 'DESC');
        if ($selectedCategory !== 'all') {
            $builder->where('category', $selectedCategory);
        }
        $items = $builder->findAll();

        $data = array_merge($this->adminData, [
            'metaTitle'        => 'Photo Gallery Manager — Kanha Kisli Holiday Admin',
            'pageHeading'      => 'Photo Gallery Manager',
            'activeNav'        => 'gallery',
            'items'            => $items,
            'selectedCategory' => $selectedCategory,
            'categories'       => [
                'all'      => 'All Photos',
                'wildlife' => 'Wildlife',
                'safari'   => 'Safari Trails',
                'birdlife' => 'Birdlife',
                'stay'     => 'Stays & Grounds',
                'forest'   => 'Forest Canopies',
            ],
        ]);

        return view('admin/gallery', $data);
    }

    public function save()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $id = $this->request->getPost('id');
        $data = [
            'category'  => $this->request->getPost('category') ?? 'wildlife',
            'title'     => trim((string)$this->request->getPost('title')),
            'subtitle'  => trim((string)$this->request->getPost('subtitle')),
            'image'     => trim((string)$this->request->getPost('image')),
            'aspect'    => $this->request->getPost('aspect') ?? 'wide',
            'order_num' => (int)($this->request->getPost('order_num') ?? 1),
            'status'    => $this->request->getPost('status') ?? 'active',
        ];

        if (empty($data['title']) || empty($data['image'])) {
            session()->setFlashdata('error', 'Title and Image path are required.');
            return redirect()->back();
        }

        if ($id && is_numeric($id)) {
            $this->galleryModel->update($id, $data);
            session()->setFlashdata('success', 'Gallery photo updated successfully!');
        } else {
            $data['views'] = 0;
            $this->galleryModel->insert($data);
            session()->setFlashdata('success', 'New gallery photo added successfully!');
        }

        return redirect()->to(base_url('admin/gallery'));
    }

    public function deleteItem($id)
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $item = $this->galleryModel->find($id);
        if ($item) {
            $this->galleryModel->delete($id);
            session()->setFlashdata('success', 'Gallery photo deleted successfully.');
        } else {
            session()->setFlashdata('error', 'Photo not found.');
        }

        return redirect()->to(base_url('admin/gallery'));
    }
}
