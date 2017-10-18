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
                    <span class="caption-subject bold uppercase">Comment Ukm</span>
                </div>
                <div class="tools"> </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Judul Post</th>
                            <th class="none">Nama User</th>
                            <th class="none">Isi Komentar</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $comment )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>{{ $comment->judul_post}}</td>
                            <td>{{ $comment->submit}}</td>
                            <td>{{ $comment->isi_komentar }}</td>
                            <td>
                                {{-- <a class="btn btn-xs default" href="{{ url('forum/scc/'.$forum->id) }}">Lihat Comment</a> --}}
                                <a class="btn btn-xs red" href="{{ url('commentUkm/delete/'.$comment->id_komentar.'/'.$comment->idforum) }}" 
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus Comment</a></td>
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