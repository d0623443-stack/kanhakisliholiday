<?php

namespace App\Controllers;

use App\Models\GalleryModel;

class Gallery extends BaseController
{
    public function index(): string
    {
        $galleryModel = new GalleryModel();
        $galleryItems = $galleryModel->getActiveItems('all');

        $data = [
            'metaTitle'           => 'Kanha Wildlife & Forest Gallery — Moments in Nature',
            'metaDescription'     => 'Explore authentic glimpses of Kanha National Park: Royal Bengal tigers, barasingha deer, vibrant birdlife, and serene forest stays.',
            'activeNav'           => 'gallery',
            'isTransparentHeader' => true,
            'items'               => $galleryItems,
        ];

        return view('pages/gallery', $data);
    }
}
