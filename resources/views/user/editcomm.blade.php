@extends('layouts.app2')

@section('css')
<link href="{{ asset('public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Edit Komunitas</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" method="POST" action="{{ url('user/community/update') }}" class="form-horizontal">
                {{ csrf_field() }}
                    <div class="form-group" style="display: none">
                        <label class="col-md-3 control-label">ID komunitas</label>
                        <div class="col-md-3">
                            <input type="text" placeholder="Komunitas Roti Indonesia" value="{{ $comm->idkomunitas }}" class="form-control" name="id" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama komunitas</label>
                        <div class="col-md-3">
                            <input type="text" placeholder="Komunitas Roti Indonesia" value="{{ $comm->nama_komunitas }}" class="form-control" name="community" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Daerah</label>
                        <div class="col-md-3">
                            <input type="text" placeholder="Semarang" value="{{ $comm->daerah }}" class="form-control" name="location" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tanggal berdiri</label>
                        <div class="col-md-2">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                <input type="text" value="{{ $comm->tanggal_berdiri }}" class="form-control" name="date" readonly required>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions" >
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('public/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
@endsection