<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Pengguna extends Component
{
    public $searchuser, $name, $email, $role, $password, $password_confirmation, $user_id;
    public $updateMode = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'Page';
    public function paginationView()
    {
        return 'components.pagination_custom';
    }
    public function resetPageUser()
    {
        $this->gotoPage(1, 'Page');
    }

    public function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->role = null;
        $this->password = null;
        $this->password_confirmation = null;
    }
    public function render()
    {
        $searchuser = '%' . $this->searchuser . '%';
        return view('livewire.admin.pengguna', [
            'penggunas' => User::where('name', 'LIKE', $searchuser)
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], $this->paginationName),
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => bcrypt($this->password),
        ]);
        session()->flash('message', 'Pengguna berhasil ditambahkan');
        $this->resetInput();
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $this->user_id = $id;
        $pengguna = User::where('id', $id)->first();
        $this->name = $pengguna->name;
        $this->email = $pengguna->email;
        $this->role = $pengguna->role;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        $roleMapping = [
            'Petugas' => 0,
            'Pimpinan' => 1,
            'Admin' => 2,
        ];
        $roleInteger = $roleMapping[$this->role];

        $pengguna = User::find($this->user_id);
        if ($this->password != null) {
            $this->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $pengguna->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $roleInteger,
                'password' => bcrypt($this->password),
            ]);
        } else {
            $pengguna->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $roleInteger,
            ]);
        }
        $this->updateMode = false;
        session()->flash('message', 'Data Berhasil Di Edit');
        $this->resetInput();
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInput();
    }
    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Pengguna berhasil dihapus');
    }
}
