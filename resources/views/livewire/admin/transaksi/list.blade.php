<div class="row justify-content-center">
    <div class="col-auto">
        <div class="card">
            <div class="card-body text-center text-white text-bg-warning">
                <h3><i class="fa-solid fa-user-clock"></i> <br></h3>
                <h6>Laundryan Dalam Proses : <br>{{ $statusProsesCount }}</h6>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body text-center text-white text-bg-info">
                <h3><i class="fa-solid fa-user-check"></i> <br></h3>
                <h6>Laundryan Belum Diambil : <br>{{ $statusBelumDiambilCount }}</h6>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="row">
            <div class="col-auto">
                <div class="col-auto" style="margin-left: auto;">
                    <div class="input-group mt-2">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari Laundryan" aria-label="Cari Berdasarkan Kode"
                            aria-describedby="basic-addon1" wire:model='searchorder' wire:input='resetPageOrder'>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto" style="margin-left: auto;">
                <div class="input-group mt-2">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari Konsumen" aria-label="Cari Berdasarkan Konsumen"
                        aria-describedby="basic-addon1" wire:model='searchkonsumen' wire:input='resetPageOrder'>
                </div>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="row">
            <div class="col-auto">
                <select class="form-select mt-2" aria-label="Default select example" wire:model='filterorder'
                    wire:change='resetPageOrder'>
                    <option selected value="">Pilih Status</option>
                    <option value="Baru">Baru</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="Belum Lunas" id="flexCheckDefault"
                        wire:click='setValueStatus' wire:click='resetPageOrder'>
                    <label class="form-check-label" for="flexCheckDefault">
                        Belum Lunas
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col" style="margin-left: auto">
        <div class="customize-input float-end ms-2">
            <form action="{{ route('orderan') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="start" id="start" required>
                    <span class="input-group-text">to</span>
                    <input type="date" class="form-control" name="end" id="end" required>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-print"></i>
                        Print</button>
                </div>
            </form>
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
                    <th>Konsumen</th>
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
                        <td>{{$order->konsumen->nama}}</td>
                        <td>{{ 'Rp' . number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->layanan->nama_layanan }}</td>
                        <td class="@if ($order->status == 'baru') bg-danger @elseif($order->status == 'proses') bg-warning @else bg-success @endif text-white border"
                            style="text-transform: uppercase;">
                            <button type="button" wire:click='show({{ $order->id }})'
                                class="btn btn-outline-light border-0" data-bs-toggle="modal"
                                data-bs-target="#ModalInfo">
                                {{ ucfirst(trans($order->status)) }}
                            </button>
                        </td>
                        <td class="@if ($order->pembayaran->status_pembayaran == 'lunas') bg-success @else bg-danger @endif text-white"
                            style="text-transform: uppercase;">
                            <button type="button" wire:click='show({{ $order->id }})'
                                class="btn btn-outline-light border-0" data-bs-toggle="modal"
                                data-bs-target="#ModalInfo">
                                {{ ucfirst(trans($order->pembayaran->status_pembayaran)) }}</button>
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
                                    @if (auth()->user()->role == 'Admin')
                                        <li>
                                            <button type="button" class="btn btn-outline-danger border-0"
                                                wire:click.prevent='destroy({{ $order->id }})'>
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </li>
                                    @endif
                                    <li>
                                        <button type="button" wire:click='show({{ $order->id }})'
                                            class="btn btn-outline-primary border-0" data-bs-toggle="modal"
                                            data-bs-target="#ModalInfo">
                                            <i class="fa fa-eye"></i> Detail
                                        </button>
                                    </li>
                                    <li>
                                        <a class="btn btn-outline-primary border-0"
                                            href="{{ route('barcode', $order->id) }}">
                                            <i class="fa-solid fa-qrcode"></i> QR Code
                                        </a>
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


<div wire:ignore.self class="modal fade" id="ModalInfo" tabindex="-1" aria-labelledby="ModalInfo"
    aria-hidden="true">
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
                                            @if (auth()->user()->role == 'Admin')
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="status" id="baru" value="baru"
                                                                wire:model='status' wire:change='updatestatus'>
                                                            <label class="form-check-label"
                                                                for="baru">Baru</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="status" id="proses" value="proses"
                                                                wire:model='status' wire:change='updatestatus'>
                                                            <label class="form-check-label"
                                                                for="proses">Proses</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="status" id="selesai" value="selesai"
                                                                wire:model='status' wire:change='updatestatus'>
                                                            <label class="form-check-label"
                                                                for="selesai">Selesai</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="diambil" id="diambil" value="diambil"
                                                                wire:model='status' wire:change='updatestatus'>
                                                            <label class="form-check-label"
                                                                for="diambil">Diambil</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if ($this->status == 'baru')
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="status" id="proses" value="proses"
                                                                    wire:model='status' wire:change='updatestatus'>
                                                                <label class="form-check-label"
                                                                    for="proses">Proses</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="status" id="selesai" value="selesai"
                                                                    wire:model='status' wire:change='updatestatus'>
                                                                <label class="form-check-label"
                                                                    for="selesai">Selesai</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="diambil" id="diambil" value="diambil"
                                                                    wire:model='status' wire:change='updatestatus'>
                                                                <label class="form-check-label"
                                                                    for="diambil">Diambil</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($this->status == 'proses')
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="status" id="selesai" value="selesai"
                                                                    wire:model='status' wire:change='updatestatus'>
                                                                <label class="form-check-label"
                                                                    for="selesai">Selesai</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="diambil" id="diambil" value="diambil"
                                                                    wire:model='status' wire:change='updatestatus'>
                                                                <label class="form-check-label"
                                                                    for="diambil">Diambil</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($this->status == 'selesai')
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="diambil" id="diambil" value="diambil"
                                                                    wire:model='status' wire:change='updatestatus'>
                                                                <label class="form-check-label"
                                                                    for="diambil">Diambil</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($this->status == 'diambil')
                                                    <div class="row">
                                                        <div class="col">
                                                            <span class="badge bg-success ">
                                                                Diambil
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row my-2">
                                        <div class="col">
                                            Jumlah Item: {{ $this->jumlah }}
                                        </div>
                                        <div class="col">
                                            Jenis Layanan: {{ $this->layanan }}
                                        </div>
                                        <div class="col">
                                            Total Harga: {{ $this->total }}
                                        </div>
                                    </div>
                                    <strong>Identitas</strong>
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
                    @if ($sttsbyr == 'lunas')
                        <div class="row my-3">
                            <div class="col">
                                @if (auth()->user()->role == 'Admin')
                                    <div wire:ignore.self class="accordion" id="accordionExample">
                                        <div wire:ignore.self class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed bg-success text-white"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="false"
                                                    aria-controls="collapseOne">
                                                    Pembayaran Lunas
                                                </button>
                                            </h2>
                                            <div wire:ignore.self id="collapseOne" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <div class="col-auto">
                                                            @if (session()->has('message'))
                                                                <div class="alert alert-success alert-dismissible fade show"
                                                                    role="alert">
                                                                    <strong>{{ session('message') }}</strong>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="alert"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <form>
                                                                <div class="row text-center">
                                                                    <div class="col">
                                                                        <label class="form-label"><strong> Pembayaran
                                                                            </strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"><strong> Metode
                                                                                    Pembayaran </strong></label>
                                                                            <select
                                                                                class="form-select @error('mtdbyr') is-invalid @enderror"
                                                                                wire:model="mtdbyr" required>
                                                                                <option value="">Cash</option>
                                                                                @forelse ($mtdbyrs as $mtdbyrop)
                                                                                    <option
                                                                                        value="{{ $mtdbyrop->metode_pembayaran }}">
                                                                                        {{ $mtdbyrop->metode_pembayaran }}
                                                                                    </option>
                                                                                @empty
                                                                                    <option value="">Belum ada
                                                                                        metode
                                                                                        pembayaran lain
                                                                                    </option>
                                                                                @endforelse

                                                                            </select>
                                                                            @error('mtdbyr')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"><strong> Uang
                                                                                    Bayar
                                                                                </strong></label>
                                                                            <input type="number"
                                                                                min="{{ $this->total }}"
                                                                                class="form-control @error('uang_bayar') is-invalid @enderror"
                                                                                wire:model="uang_bayar"
                                                                                wire:input='calculateKembalian()'
                                                                                required>
                                                                            @error('uang_bayar')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"><strong> Total
                                                                                    Harga
                                                                                </strong></label>
                                                                            <span class="form-control"> Rp.
                                                                                {{ number_format($this->total, 0, ',', '.') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                Kembalian :
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <h3 class="text-primary">Rp.
                                                                                    {{ number_format($this->kembalian, 0, ',', '.') }}
                                                                                </h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="text-white bg-warning w-100 border-0 rounded-pill text-center mt-2"
                                                                                    wire:loading
                                                                                    wire:target='calculateTotalHarga'>
                                                                                    Loading...
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto text-center mt-2"
                                                                        style="margin-left: auto">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <button type="button"
                                                                                    class="btn btn-primary d-flex m-auto mt-4"
                                                                                    wire:click.prevent='bayarupdate'>Bayarkan</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="row my-3">
                            <div class="col">
                                <form>
                                    <div class="row text-center">
                                        <div class="col">
                                            <label class="form-label"><strong> Pembayaran </strong></label>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-auto">
                                            @if (session()->has('message'))
                                                <div class="alert alert-success alert-dismissible fade show"
                                                    role="alert">
                                                    <strong>{{ session('message') }}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label"><strong> Metode Pembayaran </strong></label>
                                                <select class="form-select @error('mtdbyr') is-invalid @enderror"
                                                    wire:model="mtdbyr" required>
                                                    <option value="">Cash</option>
                                                    @forelse ($mtdbyrs as $mtdbyrop)
                                                        <option value="{{ $mtdbyrop->id }}">
                                                            {{ $mtdbyrop->metode_pembayaran }}</option>
                                                    @empty
                                                        <option value="">Belum ada metode pembayaran terdata
                                                        </option>
                                                    @endforelse

                                                </select>
                                                @error('mtdbyr')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label"><strong> Uang Bayar </strong></label>
                                                <input type="number" min="{{ $this->total }}"
                                                    class="form-control @error('uang_bayar') is-invalid @enderror"
                                                    wire:model="uang_bayar" wire:input='calculateKembalian()'
                                                    required>
                                                @error('uang_bayar')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label"><strong> Total Harga </strong></label>
                                                <span class="form-control"> Rp.
                                                    {{ number_format($this->total, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="row">
                                                <div class="col">
                                                    Kembalian :
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <h3 class="text-primary">Rp.
                                                        {{ number_format($this->kembalian, 0, ',', '.') }}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-white bg-warning w-100 border-0 rounded-pill text-center mt-2"
                                                        wire:loading wire:target='calculateTotalHarga'>
                                                        Loading...
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-center mt-2" style="margin-left: auto">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-primary d-flex m-auto mt-4"
                                                        wire:click.prevent='bayarupdate'>Bayarkan</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
