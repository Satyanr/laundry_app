<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\LayananTbl;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Layanan extends Component
{
    public $id_layanan, $nama_layanan, $harga, $searchlayanan;
    public $updatemode = false;
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'Page';
    public function paginationView()
    {
        return 'components.pagination_custom';
    }

    public function resetLayananPage()
    {
        $this->gotoPage(1, 'Page');
    }

    public function render()
    {
        return view('livewire.admin.layanan', [
            'layanans' => LayananTbl::where('nama_layanan', 'like', '%' . $this->searchlayanan . '%')
                ->orderBy('id', 'DESC')
                ->paginate(5, ['*'], $this->paginationName),
        ]);
    }

    public function resetInput()
    {
        $this->id_layanan = '';
        $this->nama_layanan = '';
        $this->harga = '';

        $this->updatemode = false;
    }

    public function store()
    {
        $this->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        LayananTbl::create([
            'nama_layanan' => $this->nama_layanan,
            'harga' => $this->harga,
        ]);

        $this->resetInput();
        $this->alert('success', 'Berhasil Ditambahkan!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function edit($id)
    {
        $layanan = LayananTbl::find($id);
        $this->id_layanan = $id;
        $this->nama_layanan = $layanan->nama_layanan;
        $this->harga = $layanan->harga;
        $this->updatemode = true;
    }

    public function update()
    {
        $this->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        LayananTbl::find($this->id_layanan)->update([
            'nama_layanan' => $this->nama_layanan,
            'harga' => $this->harga,
        ]);

        $this->resetInput();
        $this->alert('success', 'Berhasil Diubah!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);

    }

    public function destroy($id)
    {
        LayananTbl::find($id)->delete();
        $this->alert('success', 'Berhasil Dihapus!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);

    }

    public function cancel()
    {
        $this->resetInput();
    }
}
