@extends('layouts.main')

@push('css')
@endpush

@section('content')
    <div class="container my-5">
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4">
            <div class="row">
                <div class="col">
                    <div class="row text-center mb-5">
                        <div class="col text-center">
                            <h4>Daftar Layanan</h4>
                        </div>
                    </div>
                    @livewire('admin.layanan')
                </div>
                <div class="col">
                    <div class="row text-center mb-5">
                        <div class="col text-center">
                            <h4>Daftar Metode Bayar</h4>
                        </div>
                    </div>
                    @livewire('admin.pembayaran')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
