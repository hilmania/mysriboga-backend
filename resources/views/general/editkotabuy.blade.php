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
                    <span class="caption-subject bold font-green uppercase">Edit Kota Where to Buy</span>
                </div>
            </div>
            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('general/kotabuy/update') }}" class="form-horizontal">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama tempat</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="Lokasi A" class="form-control" name="lokasi" required value="{{ $data->nama_lokasi }}"/> </div>
                            <input type="text" placeholder="Semarang" class="form-control" name="id" required value="{{ $data->id }}" style="display:none"/>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kota</label>
                        <div class="col-md-4">
                            
                            <input type="text" placeholder="Semarang" class="form-control" name="kota" required value="{{ $data->kota }}" /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="3" name="alamat" required>{{ $data->alamat }}</textarea>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Latitude</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="" class="form-control" name="latitude" required value="{{ $data->latitude }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Longitude</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="" class="form-control" name="longitude" required value="{{ $data->longitude }}"/>
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