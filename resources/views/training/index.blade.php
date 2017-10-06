@extends('layouts.app2')

@section('css')
<link href="{{ asset('public/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Pelatihan</span>
                </div>
                <div class="tools"> </div>
            </div>
            <a class="btn btn-large green-meadow" href="{{ url('training/form') }}">+ Tambah Pelatihan</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Nama pelatihan</th>
                            <th class="none">Tanggal pelatihan</th>
                            <th class="none">Nama pelatihan</th>
                            <th class="none">Jenis peserta</th>
                            <th class="none">Jenis pelatihan</th>
                            <th class="none">Deskripsi pelatihan</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <!-- dd($data); -->
                        @foreach ( $data as $list )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>{{ $list->nama_pelatihan }}</td>
                            <td>{{ $list->tanggal_pelatihan }}</td>
                            <td>{{ $list->lokasi }}</td>
                            <td>{{ $list->nama_usertype }}</td>                            
                            <td>{{ $list->nama_jenis }}</td>
                            <td>{{ $list->deskripsi }}</td>
                            <td>
                                <a class="btn btn-xs green-meadow" href="{{ url('training/registrant/'.$list->id) }}" 
                                    >Lihat pendaftar pelatihan</a>
                                <a class="btn btn-xs default" href="{{ url('training/edit/'.$list->id) }}" 
                                    >Edit info pelatihan</a>
                                <a class="btn btn-xs red" href="{{ url('training/delete/'.$list->id) }}" 
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus pelatihan</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    
</div>
@endsection

@section('js')
    <script src="{{ asset('public/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection