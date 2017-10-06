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
            	
                <form role="form" method="POST" action="{{ url('user/update') }}" class="form-horizontal">
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
                        <label class="col-md-3 control-label">Jenis usaha</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->jenis_usaha }}" class="form-control" name="usaha" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kota</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->kota }}" class="form-control" name="kota" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat 1</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="2" value="" name="alamat1">{{ $data->alamat_1 }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat 2</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="2" value="" name="alamat2">{{ $data->alamat_2 }}</textarea>
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
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipe user</label>   
                        <div class="col-md-2">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-2">
                                    <select class="form-control input-small" id="userType" name="usertype">
                                        <option disabled>Pilih tipe user</option>
                                        <option value="0" <?php if ( $data->tipe_user == 0 ) echo 'selected' ?> >Super admin</option>
                                        <option value="1" <?php if ( $data->tipe_user == 1 ) echo 'selected' ?> >Admin</option>
                                        <option value="2" <?php if ( $data->tipe_user == 2 ) echo 'selected' ?> >SCC</option>
                                        <option value="3" <?php if ( $data->tipe_user == 3 ) echo 'selected' ?> >UKM</option>
                                    </select> 
                                </div>
                            </div>  
                        </div>                
                    </div>
                    
                    <div class="form-group" id="ukmForm" style="display: <?php if ( $data->tipe_user != 3) echo 'none' ?>">
                    	<label class="col-md-3 control-label">Komunitas</label>   
                        <div class="col-md-2">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-2">
                                    <select class="form-control input-small" name="komunitas">
                                        <option disabled>Pilih komunitas untuk UKM</option>
                                        @foreach( $komunitas as $kom )
                                        <option value="{{ $kom->idkomunitas }}" <?php if ( $data->tipe_user == $kom->idkomunitas ) echo 'selected' ?> >{{ $kom->nama_komunitas }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <label class="col-md-1 control-label">Nama Contact Person</label> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" value="{{ $data->ukm_contact_person }}" name="contact"/>
                        </div>                      
                    </div>
                    <div class="form-group" id="ukmForm2" style="display: <?php if ( $data->tipe_user != 3) echo 'none' ?>">
                        <label class="col-md-3 control-label">Jenis industri</label>
                        <div class="col-md-2">
                            <input type="text" value="{{ $data->jenis_industri }}" class="form-control" name="industri" /> </div>
                        <label class="col-md-1 control-label">Kapasitas produksi</label> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" value="{{ $data->kapasitas_prod }}" name="kapasitas"/>
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