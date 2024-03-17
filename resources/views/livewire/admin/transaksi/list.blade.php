<div class="row justify-content-center">
    <div class="col-auto">
        <div class="card">
            <div class="card-body text-center text-white text-bg-warning">
                <h3><i class="fa-solid fa-user-clock"></i> <br></h3>
                <h6>Laundryan Dalam Proses : <br>{{ $orders->where('status', 'proses')->count() }}</h6>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body text-center text-white text-bg-info">
                <h3><i class="fa-solid fa-user-check"></i> <br></h3>
                <h6>Laundryan Belum Diambil : <br>{{ $orders->where('status', 'selesai')->count() }}</h6>
            </div>
        </div>
    </div>
    <div class="col-auto" style="margin-left: auto;">
        <div class="input-group mt-4">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" class="form-control" placeholder="Cari Laundryan" aria-label="Cari Berdasarkan Kode"
                aria-describedby="basic-addon1" wire:model='searchorder' wire:input='resetPageOrder'>
        </div>
    </div>
</div>
<div class="row">
    <div class="col" style="margin-left: auto">
        <div class="customize-input float-end ms-2">
            <a class="btn btn-success" type="button" style="border-radius: 10px" target="_blank"
                href="{{ route('orderan') }}"><i
                    class="fas fa-print"></i>
                Print
            </a>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Total Harga</th>
                    <th>Jenis Pelayanan</th>
                    <th>Status</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->updated_at->format('d-m-y') }}</td>
                        <td>{{ $order->kode_laundry }}</td>
                        <td>{{ 'Rp' . number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->layanan->nama_layanan }}</td>
                        <td class="@if ($order->status == 'baru') bg-danger @elseif($order->status == 'proses') bg-warning @else bg-success @endif text-white border"
                            style="text-transform: uppercase;">
                            <button type="button" wire:click='show({{ $order->id }})'
                                class="btn btn-outline-light border-0" data-bs-toggle="modal"
                                data-bs-target="#ModalInfo">
                                {{ $order->status }}
                            </button>
                        </td>
                        <td class="@if ($order->pembayaran->status_pembayaran == 'lunas') bg-success @else bg-danger @endif text-white"
                            style="text-transform: uppercase;">
                            <a href="javascript:void(0)" class="btn btn-outline-light border-0"
                                wire:click='bayar({{ $order->id }})'>
                                {{ $order->pembayaran->status_pembayaran }}</a>
                        </td>
                        <td>
                            <div class="btn-group dropend">
                                <button type="button" class="btn btn-outline-dark dropdown-toggle border-0"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu text-center">
                                    <li>
                                        <button type="button" class="btn btn-outline-warning border-0"
                                            wire:click.prevent='edit({{ $order->id }})'>
                                            <i class="fa fa-pencil"></i> Edit
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-outline-danger border-0"
                                            wire:click.prevent='destroy({{ $order->id }})'>
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" wire:click='show({{ $order->id }})'
                                            class="btn btn-outline-primary border-0" data-bs-toggle="modal"
                                            data-bs-target="#ModalInfo">
                                            <i class="fa fa-eye"></i> Detail
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <h5 class="text-center">Tidak ada orderan</h5>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        {{ $orders->links() }}
    </div>
</div>


<div wire:ignore.self class="modal fade" id="ModalInfo" tabindex="-1" aria-labelledby="ModalInfo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="ModalInfo">Detail Orderan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($detailon)
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-center">{{ $this->laundrycode }}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="status" class="form-label">Status</label>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="baru" value="baru" wire:model='status'
                                                            wire:change='updatestatus'>
                                                        <label class="form-check-label" for="baru">Baru</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="proses" value="proses" wire:model='status'
                                                            wire:change='updatestatus'>
                                                        <label class="form-check-label" for="proses">Proses</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="selesai" value="selesai" wire:model='status'
                                                            wire:change='updatestatus'>
                                                        <label class="form-check-label" for="selesai">Selesai</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="diambil"
                                                            id="diambil" value="diambil" wire:model='diambil'
                                                            wire:change='updatestatus'>
                                                        <label class="form-check-label" for="diambil">Diambil</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    Jumlah Item: {{ $this->jumlah }}
                                    Jenis Layanan: {{ $this->layanan }}
                                    Total Harga: {{ $this->total }}
                                    Identitas
                                    <div class="row">
                                        <div class="col">
                                            Nama: {{ $this->nama }}
                                        </div>
                                        <div class="col">
                                            No. Telp: {{ $this->no_telp }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
