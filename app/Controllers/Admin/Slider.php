<?php

namespace App\Controllers\Admin;

use App\Models\SliderModel;
use CodeIgniter\HTTP\RedirectResponse;

class Slider extends AdminBaseController
{
    protected SliderModel $sliderModel;

    public function __construct()
    {
        $this->sliderModel = new SliderModel();
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $rawSlides = $this->sliderModel->getAllSlides();
        $slides = [];
        foreach ($rawSlides as $s) {
            $slides[] = array_merge($s, [
                'order' => $s['order_num'],
            ]);
        }

        $data = array_merge($this->adminData, [
            'metaTitle' => 'Hero Slider Manager — Kanha Kisli Holiday Admin',
            'activeNav' => 'slider',
            'slides'    => $slides,
        ]);

        return view('admin/slider', $data);
    }

    public function save(): RedirectResponse
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $id = $this->request->getPost('id');
        $imagePath = trim((string)$this->request->getPost('existing_image'));

        // Process uploaded image from file explorer
        $imageFile = $this->request->getFile('slide_image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/slider';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $ext = $imageFile->guessExtension() ?: 'webp';
            $newName = 'hero_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $imageFile->move($uploadDir, $newName);
            $imagePath = 'uploads/slider/' . $newName;
        }

        if (empty($imagePath)) {
            $imagePath = 'assets/images/slider/1.webp';
        }

        $data = [
            'eyebrow'         => trim((string)$this->request->getPost('eyebrow')),
            'title'           => trim((string)$this->request->getPost('title')),
            'subtitle_italic' => trim((string)$this->request->getPost('subtitle_italic')),
            'description'     => trim((string)$this->request->getPost('description')),
            'image'           => $imagePath,
            'btn1_text'       => trim((string)($this->request->getPost('btn1_text') ?? 'WhatsApp')),
            'btn1_link'       => trim((string)($this->request->getPost('btn1_link') ?? 'https://wa.me/919425100000')),
            'btn2_text'       => trim((string)($this->request->getPost('btn2_text') ?? 'Call Now')),
            'btn2_link'       => trim((string)($this->request->getPost('btn2_link') ?? 'tel:+919425100000')),
            'phone_text'      => trim((string)($this->request->getPost('phone_text') ?? '+91 94251 00000')),
        ];

        if (empty($id)) {
            $count = $this->sliderModel->countAllResults();
            $data['order_num'] = $count + 1;
            $data['alt'] = $data['title'];
            $data['status'] = 'active';
            $this->sliderModel->insert($data);
            $msg = 'New hero slide added successfully!';
        } else {
            $this->sliderModel->update($id, $data);
            $msg = 'Slide #' . $id . ' updated successfully!';
        }

        return redirect()->to(base_url('admin/slider'))->with('success', $msg);
    }

    public function toggle(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $slide = $this->sliderModel->find($id);
        if ($slide) {
            $newStatus = ($slide['status'] === 'active') ? 'inactive' : 'active';
            $this->sliderModel->update($id, ['status' => $newStatus]);
            return redirect()->to(base_url('admin/slider'))->with('success', "Slide #{$id} status changed to {$newStatus}.");
        }

        return redirect()->to(base_url('admin/slider'))->with('error', 'Slide not found.');
    }

    public function deleteSlide(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $this->sliderModel->delete($id);
        return redirect()->to(base_url('admin/slider'))->with('success', "Slide #{$id} has been removed.");
    }
}
