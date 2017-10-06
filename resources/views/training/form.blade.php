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
                    <span class="caption-subject bold font-green uppercase">Tambah Pelatihan</span>
                </div>
            </div>
            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('training/add') }}" class="form-horizontal">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Topik pelatihan</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="The making of Bread" class="form-control" name="trainingname" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Deskripsi pelatihan</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="3" placeholder="We're making bread" name="trainingdesc"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tanggal pelatihan</label>
                        <div class="col-md-2">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                <input type="text" class="form-control" name="trainingdate" readonly required>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <label class="col-md-1 control-label">Tipe pelatihan</label>    
                        <div class="col-md-2">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-2">
                                    <select class="form-control input-small" name="trainingtype">
                                        <option disabled>Pilih jenis pelatihan</option>
                                        <option value="1">Bakery</option>
                                        <option value="2">Noodles</option>
                                        <option value="3">Cookies and sweets</option>
                                        <option value="4">Others</option>
                                    </select> </div>
                            </div>  
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Group peserta</label>   
                        <div class="col-md-2">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-2">
                                    <select class="form-control input-small" name="trainee">
                                        <option disabled>Pilih group peserta pelatihan</option>
                                        <option value="2">SCC</option>
                                        <option value="3">UKM</option>
                                    </select> 
                                </div>
                            </div>  
                        </div>
                        <label class="col-md-1 control-label">Kuota peserta</label> 
                        <div class="col-md-2">
                            <input type="number" class="form-control" placeholder="50" name="quota" required/>
                        </div>                        
                    </div>


                    <hr>
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Lokasi pelatihan</label>   
                        <div class="col-md-2">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-2">
                                    <select class="form-control input-small" name="location">
                                        <option disabled>Pilih lokasi pelatihan</option>
                                        @foreach ( $kota as $kt )
                                        <option value="{{ $kt->kota }}">{{ $kt->kota }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>  
                        </div>
                        <label class="col-md-1 control-label">Alamat venue</label> 
                        <div class="col-md-2">
                            <textarea class="form-control" rows="3" placeholder="Jalan Sriboga" name="venue"></textarea>
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