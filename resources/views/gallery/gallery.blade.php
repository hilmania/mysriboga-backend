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
                    <span class="caption-subject bold uppercase">Album</span>
                </div>
                <div class="tools"> </div>
            </div>
            <a class="btn btn-large green-meadow" href="{{ url('album/insert/'.$idalbum) }}">+ Tambah Foto</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Thumbnail</th>
                            <th class="none">Judul gambar</th>
                            <th class="none">Deskripsi</th>
                            <th class="none">Tanggal</th>
                            <th class="none">Kota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $gallery as $list )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>
                            <img src="{{ 'http://mysriboga.sfm.co.id:8000/'.$list->url_thumbnail }}" width="200px" height="140px" /></td>
                            <td>{{ $list->judul_gambar }}</td>
                            <td>{{ $list->deskripsi }}</td>
                            <td>{{ $list->tanggal }}</td>
                            <td>{{ $list->kota }}</td>
                            <td>
                                <a class="btn btn-xs default" href="{{ url('gallery/edit/'.$list->id) }}">Edit foto</a>
                                <a class="btn btn-xs red" href="{{ url('gallery/delete/'.$list->id) }}" 
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus foto</a></td>
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