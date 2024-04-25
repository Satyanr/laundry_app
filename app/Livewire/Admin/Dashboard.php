<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\OrderTbl;
use App\Models\KonsumenTbl;
use Livewire\WithPagination;
use App\Models\PembayaranTbl;

class Dashboard extends Component
{
    public $searchorder, $filterorder, $filterbyr;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'Page';
    public function paginationView()
    {
        return 'components.pagination_custom';
    }
    public function resetPageOrder()
    {
        $this->gotoPage(1, 'Page');
    }

    public function setValueStatus()
    {
        if ($this->filterbyr != 'Belum Lunas') {
            $this->filterbyr = 'Belum Lunas';
        } else {
            $this->filterbyr = '';
        }
    }
    public function render()
    {
        $searchorder = '%' . $this->searchorder . '%';
        $filterorder = '%' . $this->filterorder . '%';
        return view('livewire.admin.dashboard', [
            'totalkonsumen' => KonsumenTbl::count(),
            'totalmskbulann' => OrderTbl::whereMonth('created_at', date('m'))->sum('total_harga'),
            'totalorder' => OrderTbl::whereMonth('created_at', date('m'))->count(),
            'orders' => OrderTbl::where('kode_laundry', 'LIKE', $searchorder)
                ->where('status', 'LIKE', $filterorder)
                ->whereHas('pembayaran', function ($query) {
                    $filterbyr = '%' . $this->filterbyr . '%';
                    $query->where('status_pembayaran', 'LIKE', $filterbyr);
                })
                ->orderBy('id', 'DESC')
                ->paginate(5, ['*'], $this->paginationName),
        ]);
    }
}
