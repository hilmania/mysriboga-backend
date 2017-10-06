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
                    <span class="caption-subject bold font-green uppercase">Edit User</span>
                </div>
            </div>
            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('user/upprofile') }}" class="form-horizontal">
                {{ csrf_field() }}
                    <div class="form-group" style="display:none">
                        <label class="col-md-3 control-label">ID</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->id }}" class="form-control" name="id" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nomor telepon</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->no_telp }}" class="form-control" name="telepon" required /> </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama user</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->name }}" class="form-control" name="nama" required /> </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-4">
                            <input type="email" value="{{ $data->email }}" class="form-control" name="email"/> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kota</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->kota }}" class="form-control" name="kota" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat 1</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="2" value="{{ $data->alamat_1 }}" name="alamat1"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat 2</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="2" value="{{ $data->alamat_2 }}" name="alamat2"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tanggal lahir</label>
                        <div class="col-md-2">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                <input type="text" class="form-control" name="date" value="{{ $data->tgl_lahir }}" readonly required>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>                   
                    <div class="form-actions" >
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <a href="{{ url('profile/changepass/') }}" class="btn btn-circle default">Ubah password</a>
                            </div>
                            <div class="col-md-offset-3 col-md-9">
                                
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
<script type="text/javascript">

    $('#userType').change(function() {
    if($(this).val() == 3)
        $('#ukmForm').show();
    else
        $('#ukmForm').hide();
    });

    $('#userType').change(function() {
    if($(this).val() == 3)
        $('#ukmForm2').show();
    else
        $('#ukmForm2').hide();
    });

</script>
@endsection