@extends('layouts.app2')

@section('css')
<link href="{{ asset('public/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Pengguna</span>
                </div>
                <div class="tools"> </div>
            </div>
            <a class="btn btn-large green-meadow" href="{{ url('user/form') }}" style="display: <?php if ( $user->tipe_user != 0) echo 'none'; ?>">+ Tambah User</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Nama</th>
                            <th class="min-phone-l">No. Telp</th>
                            <th class="none">Email</th>
                            <th class="none">Tipe Pengguna</th>
                            <th class="none">Jenis Usaha</th>
                            <th class="none">Alamat</th>
                            
                            <th class="desktop">Kota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $dt )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->no_telp }}</td>
                            <td>{{ $dt->email }}</td>
                            <td>
                            <?php 
                                if ( $dt->tipe_user == 0 ) echo 'Super Administrator';
                                if ( $dt->tipe_user == 1 ) echo 'Administrator';
                                if ( $dt->tipe_user == 2 ) echo 'SCC Member';
                                if ( $dt->tipe_user == 3 ) echo 'UKM Member';
                                if ( $dt->tipe_user == 4 ) echo 'Approval Admin';
                            ?>
                            </td>
                            <td>{{ $dt->jenis_usaha }}</td>
                            <td>{{ $dt->alamat_1 }}</td>
                            
                            <td>{{ $dt->kota }}</td>
                            <td>
                                <a class="btn btn-xs green-meadow" href="{{ url('user/edit/'.$dt->id) }}" style="display: <?php if ($user->tipe_user != 0) echo 'none'; ?>"
                                    >Edit user</a>
                                <a class="btn btn-xs default" href="{{ url('user/changepass/'.$dt->id) }}" style="display: <?php if ($user->tipe_user != 0) echo 'none'; ?>"
                                    >Ubah password</a>
                                <a class="btn btn-xs red" href="{{ url('user/delete/'.$dt->id) }}" style="display: <?php if ($user->tipe_user != 0) echo 'none'; ?>"
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus user</a></td>
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