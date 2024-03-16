<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\LayananTbl;
use Livewire\WithPagination;

class Layanan extends Component
{
    public $id_layanan, $nama_layanan, $harga, $searchlayanan;
    public $updatemode = false;
    use WithPagination;
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
        session()->flash('message', 'Data Layanan Berhasil Ditambahkan');
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
        session()->flash('message', 'Data Layanan Berhasil Diubah');

    }

    public function destroy($id)
    {
        LayananTbl::find($id)->delete();
        session()->flash('message', 'Data Layanan Berhasil Dihapus');

    }

    public function cancel()
    {
        $this->resetInput();
    }
}
