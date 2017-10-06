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
                    <span class="caption-subject bold uppercase">Kategori Produk</span>
                </div>
                <div class="tools"> </div>
            </div>
            <a class="btn btn-large green-meadow" href="{{ url('product/category/form') }}">+ Tambah Kategori Produk</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Nama grup produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $list )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>{{ $list->nama_grup }}</td>
                            <td>
                                <a class="btn btn-xs default" href="{{ url('product/category/edit/'.$list->idgroup) }}" 
                                    >Edit nama kategori</a>
                                <a class="btn btn-xs red" href="{{ url('product/category/delete/'.$list->idgroup) }}" 
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus kategori</a></td>
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