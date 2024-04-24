<div>
    <div class="row text-center justify-content-between">
        <div class="col">
            <div class="row justify-content-between">
                <div class="col">
                    <h4>Tambah Layanan</h4>
                </div>
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari layanan" aria-label="Cari layanan"
                            aria-describedby="basic-addon1" wire:model='searchlayanan' wire:input='resetLayananPage'>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form>
                        <div class="input-group mb-3">
                            <input type="text"
                                class="form-control @error('nama_layanan')
                                is-invalid
                            @enderror"
                                placeholder="Nama" aria-label="Nama" aria-describedby="basic-addon2"
                                wire:model='nama_layanan'>
                            <input type="number" min="1000" class="form-control @error('harga')
                            is-invalid
                        @enderror" placeholder="Harga" wire:model='harga'>
                            @if ($updatemode)
                                <button class="btn btn-primary" type="button"
                                    wire:click.prevent='update'>Update</button>
                                <button class="btn btn-secondary" type="button"
                                    wire:click.prevent='cancel'>Batal</button>
                            @else
                                <button class="btn btn-primary" type="button"
                                    wire:click.prevent='store'>Tambah</button>
                            @endif
                            @error('nama_layanan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($layanans as $layanan)
                                <tr>
                                    <td>{{ $layanan->nama_layanan }}</td>
                                    <td>{{ $layanan->harga }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-warning pe-3"
                                            wire:click.prevent='edit({{ $layanan->id }})'><i
                                                class="fa fa-pencil"></i></a>

                                        <a href="javascript:void(0)" class="text-danger"
                                            wire:click.prevent='destroy({{ $layanan->id }})'><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <h5 class="text-center">Belum ada layanan</h5>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{ $layanans->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="text-white bg-warning w-100 border-0 rounded-pill text-center mt-2" wire:loading
                wire:target='store'>
                Loading...
            </div>
        </div>
    </div>
</div>
