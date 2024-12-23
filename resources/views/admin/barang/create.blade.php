@extends('layouts.master')

@section('title', 'Tambah Barang')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">@yield('title')</h3>
                    <ul class="breadcrumb">
                        <li class="me-1">Admin /</li>
                        <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">@yield('title')</a></li>
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
                    <form method="POST" action="{{ route('barang.store') }} " enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Nama Barang<span class="login-danger">*</span></label>
                                    <input id="test" class="form-control" type="text" name="nama"
                                        value="{{ old('nama') }}" placeholder="Masukan Nama Barang">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Merek <span class="login-danger">*</span></label>
                                    <select name="id_merek" id="id_merek">
                                        <option value="">Pilih Merek</option>
                                        @foreach ($mereks as $merek)
                                            <option value="{{ $merek->id }}">{{ $merek->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Stok<span class="login-danger">*</span></label>
                                    <input id="test" class="form-control" type="number" name="stok"
                                        value="{{ old('stok') }}" placeholder="Masukan Nama Barang">
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Foto<span class="login-danger">*</span></label>
                                    <input id="test" class="form-control" type="file" name="foto"
                                        value="{{ old('foto') }}">
                                </div>
                            </div>

                            <div id="types">
                                <label for="">Type</label>
                                <select id="type">
                                    <option value="">pilih merek terlebih dahulu</option>
                                </select>
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
        $('#id_merek').change(function() {
            var id_merek = $(this).val()
            // console.log(id_merek)
            $.ajax({
                url: '/get-type/' + id_merek,
                type: 'GET',
                success: function(data) {
                    // console.log(data)
                    $('#type').remove()
                    var optiontypesHTML = ''

                    data.types.forEach(element => {
                        // console.log(element.nama + element.id)
                        optiontypesHTML = optiontypesHTML +
                            `<option value="${element.id}">${element.nama}</option>`

                    });
                    var typesHTML =
                        ` <select id="type" name="id_type">${optiontypesHTML}</select>`
                    $('#types').append(typesHTML)
                    // console.log(typesHTML);

                }
            })
        })
    </script>
@endsection
