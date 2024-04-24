<div>
    <div class="row my-3">
        <div class="col">
            <div class="card text-center rounded-4" style="width: 18rem;">
                <div class="card-body text-bg-secondary rounded-4">
                    <div class="row">
                        <div class="col">
                            <h1 class="display-3">
                                <i class="fa-solid fa-users"></i>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>
                                {{ $totalkonsumen }}
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>
                                Konsumen
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center rounded-4" style="width: 18rem;">
                <div class="card-body text-bg-success  rounded-4">
                    <div class="row">
                        <div class="col">
                            <h1 class="display-3">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>
                                Rp. {{ number_format($totalmskbulann, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>
                                Pemasukan Bulanan
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center rounded-4" style="width: 18rem;">
                <div class="card-body text-bg-primary rounded-4">
                    <div class="row">
                        <div class="col">
                            <h1 class="display-3">
                                <i class="fa-solid fa-arrow-down-up-across-line"></i>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>
                                {{ $totalorder }}
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>
                                Orderan Bulanan
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Riwayat Orderan</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode"
                            aria-label="Cari Berdasarkan Kode" aria-describedby="basic-addon1" wire:model='searchorder'
                            wire:input='resetPageOrder'>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col table-responsive">
                    <table class="table table-striped table-hover table-responsive text-center">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Total Harga</th>
                                <th>Jenis Pelayanan</th>
                                <th>Status</th>
                                <th>Status Pembayaran</th>
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
                                        {{ $order->status }}
                                    </td>
                                    <td class="@if ($order->pembayaran->status_pembayaran == 'lunas') bg-success @else bg-danger @endif text-white"
                                        style="text-transform: uppercase;">
                                        {{ $order->pembayaran->status_pembayaran }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <h5 class="text-center">Belum ada orderan</h5>
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
        </div>
    </div>
</div>
