<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\User;

class FreelanceRepository
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $user = $this->user->all()->where('role_id',2);
        return $user;
    }

    public function getOne($id)
    {
        $user = $this->user->find($id);
        return $user;
    }

    public function save($data)
    {
        $user = $this->user->create($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->user->destroy($id);
        return $user;
    }

    public function update($data, $id)
    {
        $user = $this->user->find($id)->update($data);
        return $user;
    }
}
