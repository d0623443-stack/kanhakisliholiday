<?php

namespace App\Controllers;

use App\Models\SliderModel;
use App\Models\GalleryModel;
use App\Models\ContentModel;
use App\Models\SettingModel;

class Home extends BaseController
{
    public function index(): string
    {
        $sliderModel  = new SliderModel();
        $galleryModel = new GalleryModel();
        $contentModel = new ContentModel();
        $settingModel = new SettingModel();

        $slides         = $sliderModel->getActiveSlides();
        $galleryPreview = $galleryModel->getPreviewItems(3);
        $content        = $contentModel->getPageContent('home');
        $settings       = $settingModel->getAllSettings();

        $data = [
            'metaTitle'           => 'Kanha Kisli Holiday — Discover the Wild. Feel Closer to Nature.',
            'metaDescription'     => 'Experience memorable safaris and peaceful stays in the heart of Kanha National Park, Madhya Pradesh. Unhurried wildlife journeys and thoughtful hospitality.',
            'activeNav'           => 'home',
            'isTransparentHeader' => true,
            'slides'              => $slides,
            'galleryPreview'      => $galleryPreview,
            'content'             => $content,
            'settings'            => $settings,
        ];

        return view('pages/home', $data);
    }
}
