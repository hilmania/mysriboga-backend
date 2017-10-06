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
            	
                <form role="form" method="POST" action="{{ url('training/update') }}" class="form-horizontal">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Topik pelatihan</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->id }}" class="form-control" name="id" required style="display:none" />
                            <input type="text" value="{{ $data->nama_pelatihan }}" class="form-control" name="trainingname" required /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Deskripsi pelatihan</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="3" name="trainingdesc">{{ $data->deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tanggal pelatihan</label>
                        <div class="col-md-2">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                <input type="text" class="form-control" value="{{ $data->tanggal_pelatihan }}" name="trainingdate" readonly required>
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
                                        <option value="1" <?php if ($data->jenis_pelatihan == 1) echo 'selected'?> >Bakery</option>
                                        <option value="2" <?php if ($data->jenis_pelatihan == 2) echo 'selected'?> >Noodles</option>
                                        <option value="3" <?php if ($data->jenis_pelatihan == 3) echo 'selected'?> >Cookies and sweets</option>
                                        <option value="4" <?php if ($data->jenis_pelatihan == 4) echo 'selected'?> >Others</option>
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
                                        <option value="2" <?php if ($data->jenis_peserta == 2) echo 'selected'?> >SCC</option>
                                        <option value="3" <?php if ($data->jenis_peserta == 3) echo 'selected'?> >UKM</option>
                                    </select> 
                                </div>
                            </div>  
                        </div>
                        <label class="col-md-1 control-label">Kuota peserta</label> 
                        <div class="col-md-2">
                            <input type="number" class="form-control" value="{{ $data->kuota_peserta }}" name="quota" required/>
                        </div>                        
                    </div>


                    <hr>
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Lokasi pelatihan</label>   
                        <div class="col-md-2">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-2">
                                    <!-- <select class="form-control input-small" name="location">
                                        <option disabled>Pilih lokasi pelatihan</option>
                                        <option value="Semarang" <?php if ($data->lokasi == 'Semarang') echo 'selected'?> >Semarang</option>
                                        <option value="Yogyakarta" <?php if ($data->lokasi == 'Yogyakarta') echo 'selected'?> >Yogyakarta</option>
                                        <option value="Surabaya" <?php if ($data->lokasi == 'Surabaya') echo 'selected'?> >Surabaya</option>
                                        <option value="Jakarta" <?php if ($data->lokasi == 'Jakarta') echo 'selected'?> >Jakarta</option>
                                    </select> --> 
                                    <select class="form-control input-small" name="location">
                                        <option disabled>Pilih lokasi pelatihan</option>
                                        @foreach ( $kota as $kt )
                                        <option value="{{ $kt->kota }}" <?php if($data->lokasi == $kt->kota) echo 'selected'?> >{{ $kt->kota }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                        </div>
                        <label class="col-md-1 control-label">Alamat venue</label> 
                        <div class="col-md-2">
                            <textarea class="form-control" rows="3" placeholder="Jalan Sriboga" name="venue">{{ $data->alamat }}</textarea>
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