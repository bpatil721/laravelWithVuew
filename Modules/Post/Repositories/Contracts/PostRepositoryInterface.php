<?php
namespace Modules\Post\Repositories\Contracts;

interface PostRepositoryInterface
{
    public function destroy($id);
    // public function store(array $data);
    public function find($id);
    public function update($id, array $data);
}