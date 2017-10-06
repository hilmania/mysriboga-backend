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
                    <span class="caption-subject bold uppercase">Kontak</span>
                </div>
                <div class="tools"> </div>
            </div>
            <a class="btn btn-large green-meadow" href="{{ url('kontak/form') }}">+ Tambah Alamat</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Nama Kantor</th>
                            <th class="none">Alamat Kantor</th>
                            <th class="none">No. Telpon</th>
                            <th class="none">Fax</th>
                            <th class="none">Kota</th>
                            <th class="none">Tipe</th>
                            <th class="none">Longitude</th>
                            <th class="none">Latitude</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $list )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>{{ $list->nama_kantor}}</td>
                            <td>{{ $list->alamat_kantor}}</td>
                            <td>{{ $list->no_telp}}</td>
                            <td>{{ $list->fax }}</td>
                            <td>{{ $list->kota }}</td>
                            <td>{{ $list->tipe_alamat }}</td>
                            <td>{{ $list->longitude }}</td>
                            <td>{{ $list->latitude }}</td>
                            <td>
                                <a class="btn btn-xs default" href="{{ url('kontak/edit/'.$list->id) }}">Edit Kontak</a>
                                <a class="btn btn-xs red" href="{{ url('kontak/delete/'.$list->id) }}" 
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus Kontak</a></td>
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