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
                    <span class="caption-subject bold uppercase">Komunitas</span>
                </div>
                <div class="tools"> </div>
            </div>
            <a class="btn btn-large green-meadow" href="{{ url('user/community/form') }}" style="display: <?php if ( $user->tipe_user != 0) echo 'none'; ?>">+ Tambah Komunitas</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="none">Nama komunitas</th>
                            <th class="none">Daerah</th>
                            <th class="none">Tanggal berdiri</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $list )
                        <tr class="odd gradeX">
                            <td>{{ $list->idkomunitas }}</td>
                            <td>{{ $list->nama_komunitas }}</td>
                            <td>{{ $list->daerah }}</td>
                            <td>{{ $list->tanggal_berdiri }}</td>
                            <td>
                                <a class="btn btn-xs red" href="{{ url('user/community/delete/'.$list->idkomunitas) }}" 
                                    onclick="return confirm('Menghapus komunitas akan menghilangkan semua data UKM dibawah komunitas tersebut. Anda yakin akan menghapus ini?');">Hapus komunitas</a></td>
                            
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