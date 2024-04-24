<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\OrderTbl;
use App\Models\KonsumenTbl;
use Livewire\WithPagination;
use App\Models\PembayaranTbl;

class Dashboard extends Component
{
    public $searchorder;
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
    public function render()
    {
        $searchorder = '%' . $this->searchorder . '%';
        return view('livewire.admin.dashboard', [
            'totalkonsumen' => KonsumenTbl::count(),
            'totalmskbulann' => OrderTbl::whereMonth('created_at', date('m'))->sum('total_harga'),
            'totalorder' => OrderTbl::whereMonth('created_at', date('m'))->count(),
            'orders' => OrderTbl::where('kode_laundry', 'LIKE', $searchorder)
                ->orderBy('id', 'DESC')
                ->paginate(5, ['*'], $this->paginationName),
        ]);
    }
}
