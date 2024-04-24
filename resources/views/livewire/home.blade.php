<div>
    <div class="row mb-5">
        <div class="col text-center">
            <h1>Daftar Laundryan</h1>
        </div>
    </div>
    <div class="row">
        <div class="col w-50">
            <div class="row">
                <div class="col">
                    <img src="{{ asset('lndryasset.jpg') }}" class="img-fluid rounded-start w-100" alt="...">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="row">
                        <div class="col">
                            <h1>Kontak Info</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('favicon.png') }}" class="img-fluid rounded-start w-25" alt="...">
                        </div>
                    </div>
                    <div class="row h5 w-auto">
                        <div class="col">
                            No. Telp
                        </div>
                        <div class="col-auto">
                            :
                        </div>
                        <div class="col">
                            081214158256
                        </div>
                    </div>
                    <div class="row h5 w-auto">
                        <div class="col">
                            E-mail
                        </div>
                        <div class="col-auto">
                            :
                        </div>
                        <div class="col">
                            laundry@gmail.com
                        </div>
                    </div>
                    <div class="row h5 w-auto">
                        <div class="col">
                            Alamat
                        </div>
                        <div class="col-auto">
                            :
                        </div>
                        <div class="col">
                            <small>Jl. Raya Ciamis No. 1, Ciamis, Jawa Barat</small>
                        </div>
                    </div>
                    <div class="row h5 w-auto">
                        <div class="col">
                            Jadwal Buka
                        </div>
                        <div class="col-auto">
                            :
                        </div>
                        <div class="col">
                            <small>Setiap Hari, Jam 7.00 - 16.00</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
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
                <div class="col">
                    @forelse ($orders as $order)
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div
                                    class="col-md-4 text-center align-content-center @if ($order->status == 'baru') bg-danger @elseif($order->status == 'proses') bg-warning @else bg-success @endif text-white border"">
                                    <div class="card-text">{{ ucfirst(trans($order->status)) }}</div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $order->kode_laundry }}</h5>
                                        <p class="card-text">
                                        <div class="row">
                                            <div class="col">
                                                Total Harga
                                            </div>
                                            <div class="col-auto">
                                                :
                                            </div>
                                            <div class="col">
                                                {{ 'Rp' . number_format($order->total_harga, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        </p>
                                        <p class="card-text">
                                        <div class="row">
                                            <div class="col">
                                                Jenis Pelayanan
                                            </div>
                                            <div class="col-auto">
                                                :
                                            </div>
                                            <div class="col">
                                                {{ $order->layanan->nama_layanan }}
                                            </div>
                                        </div>
                                        </p>
                                        <p class="card-text">
                                        <div class="row">
                                            <div class="col">
                                                Status Pembayaran
                                            </div>
                                            <div class="col-auto">
                                                :
                                            </div>
                                            <div class="col">
                                                <span
                                                    class="badge @if ($order->pembayaran->status_pembayaran == 'lunas') bg-success @else bg-danger @endif">
                                                    {{ ucfirst(trans($order->pembayaran->status_pembayaran)) }}
                                                </span>
                                            </div>
                                        </div>
                                        </p>
                                        <p class="card-text"><small
                                                class="text-body-secondary">{{ $order->updated_at->format('d-m-y') }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center">Belum Ada Orderan</h3>
                    @endforelse
                </div>

            </div>
            {{-- <div class="row mt-3">
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
            </div> --}}
            <div class="row justify-content-center">
                <div class="col-auto">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
