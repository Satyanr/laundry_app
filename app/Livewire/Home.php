<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderTbl;
use App\Models\LayananTbl;
use App\Models\KonsumenTbl;
use Livewire\WithPagination;
use App\Models\PembayaranTbl;

class Home extends Component
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
        return view('livewire.home', [
            'orders' => OrderTbl::where('kode_laundry', 'LIKE', $searchorder)
                ->orderBy('id', 'DESC')
                ->paginate(5, ['*'], $this->paginationName),
        ]);
    }
}
