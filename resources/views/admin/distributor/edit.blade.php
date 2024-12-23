@extends('layouts.master')

@section('title', 'Edit Distributor')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">@yield('title')</h3>
                    <ul class="breadcrumb">
                        <li class="me-1">Admin /</li>
                        <li class="breadcrumb-item"><a href="{{ route('merek.index') }}">@yield('title')</a></li>
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
                    <form method="POST" action="{{ route('distributor.update', $data->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Nama Distributor<span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="nama"
                                        value="{{ old('nama', $data->nama) }}" placeholder="Masukan Nama Distributor">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Alamat<span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="alamat"
                                        value="{{ old('alamat', $data->alamat) }}" placeholder="Masukan Alamat Distributor">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>No Telepon<span class="login-danger">*</span></label>
                                    <input class="form-control" type="number" name="notelp"
                                        value="{{ old('notelp', $data->notelp) }}"
                                        placeholder="Masukan No Telp Distributor">
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
