@extends('layouts.master')

@section('title', 'Tambah Barang Masuk')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">@yield('title')</h3>
                    <ul class="breadcrumb">
                        <li class="me-1">Admin /</li>
                        <li class="breadcrumb-item"><a href="{{ route('barangmasuk.index') }}">@yield('title')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 col-sm-12 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('barangmasuk.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Distributor<span class="login-danger">*</span></label>
                                    <select class="form-control" name="id_distributor" id="">
                                        <option value="" selected disabled>Pilih Distributor</option>
                                        @foreach ($distributors as $distributor)
                                            <option value="{{ $distributor->id }}">{{ $distributor->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>barang<span class="login-danger">*</span></label>
                                    <select class="form-control" name="id_barang" id="barang">
                                        <option value="" selected disabled>Pilih barang</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="tampil">
                                <div id="detail"></div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Stok Masuk<span class="login-danger">*</span></label>
                                    <input type="number" name="jumlah_masuk" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                <a href="" class="btn btn-outline-danger">Batal</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#barang').change(function() {
            var id_barang = $(this).val()
            // console.log(id_barang)
            $.ajax({
                url: '/get-barang/' + id_barang,
                type: 'GET',
                success: function(data) {
                    // console.log(data);
                    $('#detail').remove();

                    var Html = `<div id="detail"> <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Merek<span class="login-danger">*</span></label>
                                    <input disabled type="text" class="form-control" value="${data.merek}">
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Type<span class="login-danger">*</span></label>
                                    <input disabled type="text" class="form-control" value="${data.type}">
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Stok<span class="login-danger">*</span></label>
                                    <input disabled type="text" class="form-control" value="${data.stok}">
                                </div>
                            </div>
                            </div>`

                    $('#tampil').append(Html)
                }
            })
        })
    </script>
@endsection
