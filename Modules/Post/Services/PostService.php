<?php
namespace Modules\Post\Services;
use Modules\Post\Repositories\Contracts\PostRepositoryInterface;

class PostService
{
    public function __construct(private PostRepositoryInterface $postRepository){}
    public function destroy($id)
    {
        return $this->postRepository->destroy($id);
    }
    public function find($id)
    {
        return $this->postRepository->find($id);
    }
    public function update($id, $data)
    {
        return  $this->postRepository->update($id, $data);
    }
}