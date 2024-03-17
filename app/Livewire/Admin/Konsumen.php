<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\KonsumenTbl;
use Livewire\WithPagination;

class Konsumen extends Component
{
    public $searchkonsumen, $nama, $no_telp, $konsumen_id;
    public $updateMode = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'Page';
    public function paginationView()
    {
        return 'components.pagination_custom';
    }

    public function resetKonsumenPage()
    {
        $this->gotoPage(1, 'Page');
    }
    public function render()
    {
        $searchkosumen = '%' . $this->searchkonsumen . '%';
        return view('livewire.admin.konsumen', [
            'konsumens' => KonsumenTbl::where('nama', 'LIKE', $searchkosumen)
                ->orderBy('id', 'DESC')
                ->paginate(5, ['*'], $this->paginationName),
        ]);
    }

    public function resetInput()
    {
        $this->nama = '';
        $this->no_telp = '';
        $this->konsumen_id = '';
    }
    public function edit($id)
    {
        $konsumen = KonsumenTbl::find($id);
        $this->nama = $konsumen->nama;
        $this->no_telp = $konsumen->no_telp;
        $this->konsumen_id = $konsumen->id;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required',
            'no_telp' => 'required',
        ]);
        if ($this->konsumen_id) {
            $konsumen = KonsumenTbl::find($this->konsumen_id);
            $konsumen->update([
                'nama' => $this->nama,
                'no_telp' => $this->no_telp,
            ]);
        }
        $this->resetInput();
        $this->updateMode = false;
    }
    public function destroy($id)
    {
        $konsumen = KonsumenTbl::find($id);
        $konsumen->delete();
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInput();
    }
}
