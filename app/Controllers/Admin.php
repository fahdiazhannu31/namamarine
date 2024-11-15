<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index(): string
    {
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();
        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join ('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join ('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        return view('admin/index', $data);
    }

    public function detailuser($id = 0): string
    {
        $this->builder->select('users.id as userid, username, email, fullname, user_image, name');
        $this->builder->join ('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join ('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if(empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detailuser', $data);
    }

    public function crudlistpackage(): string
    {
        return view('admin/crudlistpackage');
    }

    public function crudhome(): string
    {
        return view('admin/crudhome');
    }

    public function crudaboutus(): string
    {
        return view('admin/crudaboutus');
    }

    public function crudfooter(): string
    {
        return view('admin/crudfooter');
    }
}
