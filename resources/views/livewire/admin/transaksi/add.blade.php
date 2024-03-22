<div class="row">
    <div class="col">
        <form>
            <div class="row text-center">
                <div class="col">
                    <label class="form-label"><strong> Identitas </strong></label>
                </div>
            </div>
            <div class="row text-center pb-5 fs-5">
                <div class="col">
                    <div class="form-input">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            wire:input="searchResult" wire:model="nama" placeholder="Nama">
                        @if ($showresult)
                            <ul class="list-group">
                                @if (!empty($konsumenlist))
                                    @foreach ($konsumenlist as $name)
                                        <a class="" href="javascript:void(0)">
                                            <li class="list-group-item" wire:click="pilihkonsumen({{ $name->id }})">
                                                {{ $name->nama }},
                                                {{ $name->no_telp }}
                                            </li>
                                        </a>
                                    @endforeach
                                @endif
                            </ul>
                        @endif
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-input">
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                            wire:model="no_telp" placeholder="Nomor Hp" required>
                        @error('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label"><strong> Jumlah </strong></label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                            wire:model="jumlah" wire:input='calculateTotalHarga()' required>
                        @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label"><strong> Pilih Jenis Layanan </strong></label>
                        <select class="form-select @error('id_layanan') is-invalid @enderror" wire:model="id_layanan"
                            wire:change='calculateTotalHarga()' required>
                            <option value="">Pilih Jenis Layanan</option>
                            @forelse ($layanans as $layanan)
                                <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                            @empty
                                <option value="">Belum ada layanan</option>
                            @endforelse

                        </select>
                        @error('id_layanan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-auto">
                    <div class="row">
                        <div class="col">
                            Total Harga :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="text-primary">Rp. {{ number_format($this->total, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-white bg-warning w-100 border-0 rounded-pill text-center mt-2" wire:loading
                                wire:target='calculateTotalHarga'>
                                Loading...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-center mt-2" style="margin-left: auto">
                    @if ($updatemode)
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary d-flex m-auto mt-4"
                                    wire:loading.attr="disabled" wire:target='total'
                                    wire:click.prevent='cancel'>Batal</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary d-flex m-auto mt-4"
                                    wire:loading.attr="disabled" wire:target='total'
                                    wire:click.prevent='update'>Update</button>
                            </div>
                        </div>
                    @else
                        <button type="button" class="btn btn-primary d-flex m-auto mt-4" wire:loading.attr="disabled"
                            wire:target='total' wire:click.prevent='store'>Tambahkan</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
