<div class="row">
    <div class="col">
        <table class="table table-striped table-hover table-responsive text-center">
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
                        <td class="@if ($order->status == 'baru') bg-danger @else bg-success @endif text-white border"
                            style="text-transform: uppercase;">{{ $order->status }}</td>
                        <td class="@if ($order->pembayaran->status_pembayaran == 'lunas') bg-success @else bg-danger @endif text-white"
                            style="text-transform: uppercase;">{{ $order->pembayaran->status_pembayaran }}</td>
                        <td>
                            <div class="btn-group dropend">
                                <button type="button" class="btn btn-outline-dark dropdown-toggle border-0"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu text-center">
                                    <li>
                                        <a href="javascript:void(0)" class="text-warning" style="text-decoration: none;"
                                            wire:click.prevent='edit({{ $order->id }})'>
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="text-danger" style="text-decoration : none;"
                                            wire:click.prevent='destroy({{ $order->id }})'>
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-outline-primary border-0" data-bs-toggle="modal"
                                            data-bs-target="#ModalInfo" wire:click='show({{ $order->id }})'>
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

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="ModalInfo" tabindex="-1" aria-labelledby="ModalInfo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalInfo">Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>
