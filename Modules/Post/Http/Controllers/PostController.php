<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Post\Models\Post;
use Modules\Post\Repositories\Contracts\PostRepositoryInterface;
use Modules\Post\Services\PostService;
use Modules\Post\Http\Requests\PostRequest;
class PostController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    private $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function postIndex()
    {
       return view('post::index');
    }
    public function index()
    {
        return Post::orderBy('created_at','desc')->paginate(10);
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $data['user_id'] = rand(1,10);
        $post = Post::create($data);
        
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Post created successfully',
                'data' => $post
            ], 201);
        }
        
        return redirect()->route('posts.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $post = $this->postService->find($id);
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->postService->find($id);
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id) {
        $data = $request->validated();
        $result = $this->postService->update($id, $data);
        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $result
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->postService->destroy($id);
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
