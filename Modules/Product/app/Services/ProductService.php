<?php

namespace Modules\Product\Services;
use Modules\Product\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getProductById($id) {
       return $this->productRepository->find($id);
    }
}
