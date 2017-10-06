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
                    <span class="caption-subject bold uppercase">Resep</span>
                </div>
                <div class="tools"> </div>
            </div>
            <a class="btn btn-large green-meadow" href="{{ url('recipe/form') }}">+ Tambah Resep</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Thumbnail</th>
                            <th class="none">Approve</th>
                            <th class="none">Nama resep</th>
                            <th class="none">Kategori</th>
                            <th class="none">Deskripsi resep</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $list )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>
                            <img src="{{ 'http://mysriboga.sfm.co.id:8000/'.$list->url_thumbnail }}" width="200px" height="140px" /></td>
                            <td><?php if($list->approval == 1) { echo 'Sudah'; } else echo 'Belum'; ?></td>
                            <td>{{ $list->nama_resep }}</td>
                            <td>{{ $list->nama_kategori }}</td>
                            <td>{{ $list->deskripsi_resep }}</td>
                            <td>
                                <a class="btn btn-xs default" href="{{ url('recipe/edit/'.$list->id) }}">Edit info resep</a>
                                <a class="btn btn-xs red" href="{{ url('recipe/delete/'.$list->id) }}" 
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus resep</a></td>
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