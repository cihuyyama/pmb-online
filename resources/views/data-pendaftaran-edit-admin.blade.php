@extends('master.master-admin')

@section('title')
PMB
@endsection

@section('header')
@endsection

@section('navbar')
@parent
@endsection

@section('menunya')
Pendaftaran
@endsection

@section('menu')
@auth
<ul class="metismenu" id="menu">
    <li><a href="../../index">
            <i class="fas fa-home"></i>
            <span class="nav-text">Beranda</span>
        </a>
    </li>
    @if (auth()->user()->role == 'Administrator')
    <li><a class="has-arrow" href="data-user" aria-expanded="false">
            <i class="fa fa-book"></i>
            <span class="nav-text">Data User </span>
        </a>
    </li>
    @else
    @php
    $no = 1;
    @endphp
    @foreach ($viewDataUser as $x)
    @if ($no == 1)
    <li><a href="../../data-registration" aria-expanded="false">
            <i class="fa fa-database"></i>
            <span class="nav-text">Pendaftaran</span>
        </a>
    </li>
    @endif
    @php
    $no++;
    @endphp
    @endforeach
    @endif

</ul>
@endauth
@endsection

@section('content')
<div class="row">
    <form action="/update-registration/{{ $viewData->id_pendaftaran }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="userid" value="{{ auth()->user()->id_user}}">
        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
        <div class="col-xl-12">
            <div class="custom-accordion">
                <div class="card">
                    <a href="#personal-data" class="text-dark" data-bs-toggle="collapse">
                        <div class="p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-16 mb-1">Data Pribadi</h5>
                                </div>
                                <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                            </div>
                        </div>
                    </a>
                    <div id="personal-data" class="collapse show">
                        <div class="p-4 border-top">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="personal-data-nisn">NISN</label>
                                        <input type="number" value="{{ $viewData->nisn }}" class="form-control" id="personal-data-nisn" name="nisn" placeholder="Enter NISN" value="{{ old('nisn') }}">
                                        @error('nisn')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="personal-data-nik">NIK</label>
                                        <input type="number" value="{{ $viewData->nik }}" class="form-control" id="personal-data-nik" name="nik" placeholder="Enter NIK" value="{{ old('nik') }}">
                                        @error('nik')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="personal-data-name">Nama</label>
                                        <input type="text" value="{{ $viewData->nama_siswa }}" class="form-control" id="personal-data-name" name="nama" placeholder="Enter Name" value="{{ old('nama') }}">
                                        @error('nama')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="personal-data-gender">Jenis Kelamin</label>
                                        @if ($viewData->jenis_kelamin == 'Perempuan')
                                        <select class="form-control wide" name="jk" value="{{ old('jk') }}">
                                            <option value="{{ $viewData->jenis_kelamin }}" selected> {{ $viewData->jenis_kelamin }}</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                        </select>
                                        @else
                                        <select class="form-control wide" name="jk" value="{{ old('jk') }}">
                                            <option value="{{ $viewData->jenis_kelamin }}" selected> {{ $viewData->jenis_kelamin }}</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @endif
                                        @error('jk')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="personal-data">Agama</label>
                                        <select class="form-control wide" name="agama" value="{{ old('agama') }}">
                                            <option value="{{ old('agama') }}" disabled selected>{{ $viewData->agama }}"
                                            </option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Kong Hu Chu ">Kong Hu Chu</option>
                                            <option value="Lainnya">Etc</option>
                                        </select>
                                        @error('agama')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-4 mb-lg-0">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" value="{{ $viewData->temoat_lahir }}" class="form-control" id="basicpill" name="tempatlahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempatlahir') }}">
                                        @error('tempatlahir')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-4 mb-lg-0">
                                        <label class="form-label" for="billing-city">Date of Birth</label>
                                        <input type="date" value="{{ $viewData->tanggal_lahir }}" class="form-control" id="basicpill" name="tanggallahir" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggallahir') }}">
                                        @error('tanggallahir')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <!--<input name="tanggallahir" class="datepicker-default form-control" id="datepicker" >-->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-0">
                                        <label class="form-label" for="zip-code">Pas Foto</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Upload</span>
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control" name="foto" value="{{ old('foto') }}">
                                                <input type="hidden" name="pathFoto" class="form-control-file" value="{{ $viewData->foto }}">
                                            </div>
                                        </div>
                                        @error('foto')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="billing-address">Alamat</label>
                                <textarea class="form-control" id="billing-address" rows="3" name="alamat" placeholder="Masukkan Alamat">{{ $viewData->alamat }}</textarea>
                                @error('alamat')
                                <div class="alert alert-warning" role="alert">
                                    <strong>Peringatan!</strong>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="personal-data-nisn">Email</label>
                                        <input type="email" value="{{ $viewData->email }}" class="form-control" id="personal-data-nisn" name="email" placeholder="Masukkan email" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-4">
                                        <label class="form-label" for="personal-data-nik">Mobile
                                            Nomor Telepon/WhatsApp</label>
                                        <input type="number" value="{{ $viewData->no_hp }}" class="form-control" id="personal-data-nik" name="nohp" placeholder="Masukkan No HP" value="{{ old('nohp') }}">
                                        @error('nohp')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col">
                        <div class="text-end mt-2 mt-sm-0">
                            <button type="submit" name="add" class="btn btn-primary">Perbaharui</button>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row-->
            </div>
    </form>
</div>
<!-- end row -->
@endsection

@section('footer')
@endsection