<?php
namespace Modules\Post\Repositories;
use Modules\Post\Repositories\Contracts\PostRepositoryInterface;    
use Modules\Post\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function destroy($id)
    {
        return Post::find($id)->delete();
    }
    public function find($id)
    {
        return Post::findOrFail($id);
    }
    public function update($id, array $data)
    {
        $post = Post::find($id);

        if($post){
            $post->update($data);
            return $post;
        }
        
    }
}