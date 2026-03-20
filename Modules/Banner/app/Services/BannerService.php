<?php

namespace Modules\Banner\Services;
use Modules\Banner\Repositories\BannerRepository;

class BannerService
{
    public function __construct(BannerRepository $bannerRepository){
        $this->bannerRepository = $bannerRepository;
    }
    public function getBanners()
    {
        
       $collection =  $this->bannerRepository->getBanners();
        $collection->map(function($item){
            $item->image = asset($item->image);
             return $item;
        });
        return $collection; 
    }
}
