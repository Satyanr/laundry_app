<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\OrderTbl;
use App\Models\LayananTbl;
use App\Models\KonsumenTbl;
use Livewire\WithPagination;
use App\Models\PembayaranTbl;
use Illuminate\Validation\Rule;

class Transaksi extends Component
{
    public $id_konsumen, $id_layanan, $nama, $no_telp, $jumlah, $total, $searchorder, $orderan_id, $status, $uang_bayar, $kembalian, $layanan, $laundrycode;
    public $updatemode = false,
        $listmode = false,
        $bayarfunction = false,
        $detailon = false;

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
    public function render()
    {
        $searchorder = '%' . $this->searchorder . '%';
        return view('livewire.admin.transaksi', [
            'orders' => OrderTbl::where('kode_laundry', 'LIKE', $searchorder)
                ->orderBy('id', 'DESC')
                ->paginate(5, ['*'], $this->paginationName),
            'layanans' => LayananTbl::all(),
        ]);
    }
    public function liston()
    {
        $this->listmode = true;
    }
    public function listoff()
    {
        $this->listmode = false;
    }
    public function resetInput()
    {
        $this->id_konsumen = '';
        $this->id_layanan = '';
        $this->nama = '';
        $this->no_telp = '';
        $this->jumlah = '';
        $this->total = 0;
        $this->orderan_id = null;
        $this->uang_bayar = '';
        $this->kembalian = 0;
    }
    public function calculateTotalHarga()
    {
        $layanan = LayananTbl::find($this->id_layanan);
        if ($layanan) {
            if (is_numeric($this->jumlah) && is_numeric($layanan->harga)) {
                $this->total = $layanan->harga * $this->jumlah;
            }

            if ($this->jumlah == 0 || $this->jumlah == null) {
                $this->total = 0;
            }
        } else {
            $this->total = 0;
        }
    }
    public function calculateKembalian()
    {
        if (is_numeric($this->uang_bayar)) {
            $this->kembalian = $this->uang_bayar - $this->total;
        }

        if ($this->uang_bayar == 0) {
            $this->kembalian = 0;
        }
    }

    public function store()
    {
        $this->validate([
            'id_layanan' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'nama' => 'required',
            'no_telp' => 'required',
        ]);

        $konsumen = KonsumenTbl::create([
            'nama' => $this->nama,
            'no_telp' => $this->no_telp,
        ]);

        $order = OrderTbl::create([
            'kode_laundry' => 'LDR-' . $konsumen->id . $this->id_layanan,
            'id_konsumens' => $konsumen->id,
            'id_layanans' => $this->id_layanan,
            'jumlah' => $this->jumlah,
            'total_harga' => $this->total,
        ]);

        PembayaranTbl::create([
            'id_orders' => $order->id,
        ]);

        $this->resetInput();
        session()->flash('message', 'Orderan berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $order = OrderTbl::find($id);
        $this->orderan_id = $order->id;
        $this->id_konsumen = $order->id_konsumens;
        $this->id_layanan = $order->id_layanans;
        $this->jumlah = $order->jumlah;
        $this->total = $order->total_harga;

        $konsumen = KonsumenTbl::find($order->id_konsumens);
        $this->nama = $konsumen->nama;
        $this->no_telp = $konsumen->no_telp;

        $this->updatemode = true;
        $this->listmode = false;
    }
    public function update()
    {
        $this->validate([
            'id_layanan' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'nama' => 'required',
            'no_telp' => 'required',
        ]);

        $order = OrderTbl::find($this->orderan_id);
        $order->id_konsumens = $this->id_konsumen;
        $order->id_layanans = $this->id_layanan;
        $order->jumlah = $this->jumlah;
        $order->total_harga = $this->total;
        $order->save();

        $konsumen = KonsumenTbl::find($this->id_konsumen);
        $konsumen->nama = $this->nama;
        $konsumen->no_telp = $this->no_telp;
        $konsumen->save();

        $this->resetInput();
        $this->updatemode = false;
        session()->flash('message', 'Orderan berhasil diupdate.');
    }
    public function cancel()
    {
        $this->resetInput();
        $this->updatemode = false;
        $this->bayarfunction = false;
        $this->detailon = false;
        $this->listmode = true;
    }
    public function destroy($id)
    {
        $order = OrderTbl::find($id);
        $order->delete();
        session()->flash('message', 'Orderan berhasil dihapus.');
    }
    public function show($id)
    {
        $this->detailon = true;
        $order = OrderTbl::find($id);
        $this->orderan_id = $order->id;
        $this->id_konsumen = $order->id_konsumens;
        $this->id_layanan = $order->id_layanans;
        $this->jumlah = $order->jumlah;
        $this->total = $order->total_harga;
        $this->laundrycode = $order->kode_laundry;
        $this->status = $order->status;

        $konsumen = KonsumenTbl::find($order->id_konsumens);
        $this->nama = $konsumen->nama;
        $this->no_telp = $konsumen->no_telp;

        $layanan = LayananTbl::find($order->id_layanans);
        $this->layanan = $layanan->nama;
    }

    public function updatestatus()
    {
        $order = OrderTbl::find($this->orderan_id);
        $order->status = $this->status;
        $order->save();
        session()->flash('message', 'Status orderan berhasil diupdate.');
    }
    public function bayar($id)
    {
        $ordr = OrderTbl::find($id);
        $this->orderan_id = $ordr->id;

        $this->total = OrderTbl::find($this->orderan_id)->total_harga;
        $this->bayarfunction = true;
        $this->listmode = false;
    }
    public function bayarupdate()
    {
        $paymentord = PembayaranTbl::where('id_orders', $this->orderan_id)->first();
        $this->total = OrderTbl::find($this->orderan_id)->total_harga;
        $this->validate(
            [
                'uang_bayar' => 'required|numeric|min:' . $this->total,
            ],
            [
                'uang_bayar.min' => 'Uang bayar harus lebih besar atau sama dengan total harga.',
                'uang_bayar.required' => 'Uang bayar harus diisi.',
                'uang_bayar.numeric' => 'Uang bayar harus berupa angka.',
            ],
        );

        $paymentord->uang_bayar = $this->uang_bayar;
        $paymentord->kembalian = $this->uang_bayar - $this->total;
        $paymentord->status_pembayaran = 'lunas';
        $paymentord->save();
        $this->resetInput();
        $this->bayarfunction = false;
        $this->listmode = true;
        session()->flash('message', 'Orderan berhasil dibayar.');
    }
}