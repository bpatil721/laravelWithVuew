<?php

namespace Modules\Product\Repositories;
use Modules\Product\Models\Product;
use Modules\Product\Interfaces\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{
   
        public function getNewProducts(){
            return Product::orderBy('created_at', 'desc')->take(10)->get();
        }

        public function find($id){
            return Product::with('category')->findOrFail($id);
        }
   
}
