@extends('master.master-admin')

@section('title')
    PMB - Dashboard
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection


@section('menunya')
    Beranda
@endsection

@section('menu')
    @auth
        <ul class="metismenu" id="menu">
            <li><a href="index">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Beranda</span>
                </a>
            </li>
            @if (auth()->user()->role == 'Administrator')
                <li><a href="data-user" aria-expanded="false">
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
                        <li><a href="form-registration" aria-expanded="false">
                                <i class="fa fa-database"></i>
                                <span class="nav-text">Pendaftaran</span>
                            </a>
                        </li>
                        <li><a href="data-registration" aria-expanded="false">
                                <i class="fa fa-database"></i>
                                <span class="nav-text">Status</span>
                            </a>
                        </li>
                    @endif
                    @php
                        $no++;
                    @endphp
                @endforeach
            @endif
            <!--<li><a href="#" aria-expanded="false">
                    <i class="fa fa-download"></i>
                    <span class="nav-text">Pusat Unduhan</span>
                </a>
            </li>-->
        </ul>
    @endauth
@endsection

@section('content')
    <!--Buat Admin-->
    @auth
        @if (auth()->user()->role == 'Administrator')
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pendaftaran</h4>
                        </div>
                        <div class="card-body" id="cetak">
                            <div class="table-responsive">
                                {{ csrf_field() }}

                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Peserta</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($pendaftar as $x)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $x->id_pendaftaran }}</td>
                                                <td>{{ $x->nama_siswa }}</td>
                                                <td>{{ $x->jenis_kelamin }}</td>
                                                <td><strong>{{ $x->tgl_pendaftaran }}</strong></a></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @if ($x->status_pendaftaran == 'Terverifikasi')
                                                                <span class="badge badge-success">Terverifikasi<span
                                                                        class="ms-1 fa fa-check"></span>
                                                                @elseif($x->status_pendaftaran == 'Belum Terverifikasi')
                                                                    <span class="badge badge-warning">Belum Terverifikasi<span
                                                                            class="ms-1 fas fa-stream"></span>
                                                                    @elseif($x->status_pendaftaran == 'Tidak Sah')
                                                                        <span class="badge badge-info">Tidak Sesuai<span
                                                                                class="ms-1 fa fa-ban"></span>
                                                                        @else
                                                                            <span class="badge badge-danger">Not Found<span
                                                                                    class="ms-1 fa fa-search"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="dropdown text-sans-serif"><button
                                                                    class="btn btn-primary tp-btn-light sharp" type="button"
                                                                    id="order-dropdown-7" data-bs-toggle="dropdown"
                                                                    data-boundary="viewport" aria-haspopup="true"
                                                                    aria-expanded="false"><span><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="18px" height="18px" viewbox="0 0 24 24"
                                                                            version="1.1">
                                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                                fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                                <circle fill="#000000" cx="5" cy="12" r="2">
                                                                                </circle>
                                                                                <circle fill="#000000" cx="12" cy="12" r="2">
                                                                                </circle>
                                                                                <circle fill="#000000" cx="19" cy="12" r="2">
                                                                                </circle>
                                                                            </g>
                                                                        </svg></span></button>
                                                                <div class="dropdown-menu dropdown-menu-end border py-0"
                                                                    aria-labelledby="order-dropdown-7">
                                                                    <div class="py-2"><a class="dropdown-item"
                                                                            href="/verified-registration/{{ $x->id_pendaftaran }}">Terverifikasi</a><a
                                                                            class="dropdown-item"
                                                                            href="/notverified-registration/{{ $x->id_pendaftaran }}">Belum
                                                                            Terverifikasi</a>
                                                                        <div class="dropdown-divider"></div><a
                                                                            class="dropdown-item text-danger"
                                                                            href="/invalid-registration/{{ $x->id_pendaftaran }}">Tidak
                                                                            Sah</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-light shadow btn-xs sharp me-1"
                                                            title="Detail Registration"
                                                            href="detail-registration/{{ $x->id_pendaftaran }}"><i
                                                                class="fa fa-file-alt"></i></a>
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit"
                                                            href="edit-registration/{{ $x->id_pendaftaran }}"><i
                                                                class="fa fa-pencil-alt"></i></a>
                                                        <a class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash" data-bs-toggle="modal"
                                                                data-bs-target=".delete{{ $x->id_pendaftaran }}"></i></a>
                                                        <div class="modal fade delete{{ $x->id_pendaftaran }}" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Hapus Data</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center"><i
                                                                            class="fa fa-trash"></i><br> Anda yakin ingin
                                                                        menghapus data ini?{{ $x->id_pendaftaran }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light"
                                                                            data-bs-dismiss="modal">Tidak</button>
                                                                        <a
                                                                            href="delete-registration/{{ $x->id_pendaftaran }}">
                                                                            <button type="submit"
                                                                                class="btn btn-danger shadow">
                                                                                Ya, Hapus Data!
                                                                            </button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->role == 'Calon Mahasiswa')
            <!--Buat Camaba-->
            
        @endif
    @endauth



@endsection

@section('footer')
@endsection
