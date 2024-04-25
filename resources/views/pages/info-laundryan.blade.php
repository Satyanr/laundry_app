@extends('layouts.main')

@push('css')
@endpush

@section('content')
    <div class="container my-5">
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4">
            <div class="row mb-3">
                <div class="col text-center">
                    <h1>Info Laundryan</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('lndryasset.jpg') }}" class="img-fluid rounded-start w-100" alt="...">
                        </div>
                    </div>

                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h1>{{ $ldr->kode_laundry }}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span>
                                Jumlah Baju : {{ $ldr->jumlah }} <br>
                                Status : {{ $ldr->status }} <br>
                                Total Harga : {{ $ldr->total_harga }} <br>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="row">
                        <div class="col">
                            <h1>Kontak Info</h1>
                        </div>
                    </div>
                    <div class="row h5 mb-3 justify-content-center">
                        <div class="col-1">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="col-auto pe-5">
                            081214158256
                        </div>
                        <div class="col-1">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="col-auto">
                            laundry@gmail.com
                        </div>
                    </div>
                    <div class="row h5 mb-3 justify-content-center">
                        <div class="col-1">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="col-auto">
                            <small>Buka Setiap Hari, Jam 7.00 - 16.00</small>
                        </div>
                    </div>
                    <div class="row h5 justify-content-center">
                        <div class="col-1">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="col-auto">
                            <small>Lokasi</small>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11192.922986172453!2d108.32337048054914!3d-7.32062453628526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5eba1b06f52f%3A0xaf882382d9de1508!2sSMK%20Negeri%201%20Ciamis!5e0!3m2!1sid!2sid!4v1713941955685!5m2!1sid!2sid"
                                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
