<div>
    <div wire:loading wire:target='liston'>
        <div class="loading-overlay">
            <div style="color: #a0cadb" class="la-ball-atom la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="loading-overlay__text">Loading...</div>
        </div>
    </div>

    <div wire:loading wire:target='listoff'>
        <div class="loading-overlay">
            <div style="color: #a0cadb" class="la-ball-atom la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="loading-overlay__text">Loading...</div>
        </div>
    </div>

    <div class="row text-center mb-5">
        <div class="col text-center">
            <ul class="nav nav-tabs">
                <li class="nav-item w-50">
                    <a class="nav-link @if ($listmode == false) active @endif
                    "
                        aria-current="page" href="javascript:void(0)" wire:click='listoff'>
                        <h4>
                            @if ($updatemode)
                                Edit Orderan
                            @else
                                Orderan
                            @endif
                        </h4>
                    </a>
                </li>
                <li class="nav-item w-50">
                    <a class="nav-link
                     @if ($listmode) active @endif
                    "
                        href="javascript:void(0)" wire:click='liston' wire:click.prevent='cancel'>
                        <h4>Daftar Orderan @if ($orders->where('status', 'baru')->count() > 0)
                                <span
                                    class="badge rounded-circle text-bg-danger">{{ $orders->where('status', 'baru')->count() }}</span>
                            @endif
                        </h4>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-auto">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    @if ($listmode)
        @include('livewire.admin.transaksi.list')
    @else
        @include('livewire.admin.transaksi.add')
    @endif
</div>
