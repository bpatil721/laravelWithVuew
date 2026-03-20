<?php

namespace Modules\Banner\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Banner\Services\BannerService;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    public function index()
    {
        return view('banner::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banner::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('banner::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('banner::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function getCollection(){

        $collection = $this->bannerService->getBanners();
        
      
        return response()->json($collection);
    }
}
