<?php

namespace Modules\Banner\Repositories;
use Modules\Banner\Interfaces\BannerRepositoryInterface;
use Modules\Banner\Models\Banner;
class BannerRepository implements BannerRepositoryInterface
{
    public function getBanners() {
        return Banner::all();
    }
}
