<?php

namespace App\Repositories;

use App\Models\User;

class UserService extends Repository
{
    public $requestUser;

    public function __construct()
    {
        $this->requestUser = new User;
    }

    public function all()
    {
        return $this->requestUser->all();
    }

    public function customer()
    {
        return $this->requestUser->all()->where('role_id',3);
    }

    public function freelance()
    {
        return $this->requestUser->all()->where('role_id',2);
    }

    public function save($data)
    {
        return $this->requestUser->create($data);
    }

    public function delete($id)
    {
        $user = $this->requestUser->destroy($id);
        return $user;
    }

    public function update($data, $id)
    {
        $user = $this->requestUser->find($id)->update($data);
        return $user;
    }
}
