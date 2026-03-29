<?php

namespace Modules\Cart\Services;
use Modules\Cart\Repositories\CartRepository;
class CartService
{
    protected $cartRepository;
    public function __construct(CartRepository $cartRepository){
        $this->cartRepository = $cartRepository;

    }

    public function store($request){
        $this->cartRepository->store($request);
    }
    
}
