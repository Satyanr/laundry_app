<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MetodePembayaranTbl;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Pembayaran extends Component
{
    public $id_mtdbyr, $mtdbyr, $searchmtdbyr;
    public $updatemode = false;
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'PembayaranPage';
    public function paginationView()
    {
        return 'components.pagination_custom';
    }

    public function resetMtdpmbyrnPage()
    {
        $this->gotoPage(1, 'PembayaranPage');
    }

    public function render()
    {
        return view('livewire.admin.pembayaran', [
            'mtdbyrs' => MetodePembayaranTbl::where('metode_pembayaran', 'like', '%' . $this->searchmtdbyr . '%')
                ->orderBy('id', 'DESC')
                ->paginate(5, ['*'], $this->paginationName),
        ]);
    }

    public function resetInput()
    {
        $this->id_mtdbyr = '';
        $this->mtdbyr = '';

        $this->updatemode = false;
    }

    public function store()
    {
        $this->validate([
            'mtdbyr' => 'required',
        ]);

        MetodePembayaranTbl::create([
            'metode_pembayaran' => $this->mtdbyr,
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
        $mtdbyrval = MetodePembayaranTbl::find($id);
        $this->id_mtdbyr = $id;
        $this->mtdbyr = $mtdbyrval->metode_pembayaran;
        $this->updatemode = true;
    }

    public function update()
    {
        $this->validate([
            'mtdbyr' => 'required',
        ]);

        MetodePembayaranTbl::find($this->id_mtdbyr)->update([
            'metode_pembayaran' => $this->mtdbyr,
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
        MetodePembayaranTbl::find($id)->delete();
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
