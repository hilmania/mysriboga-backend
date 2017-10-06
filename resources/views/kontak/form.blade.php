@extends('layouts.app2')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Tambah Kontak</span>
                </div>
            </div>
            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('kontak/add') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Kantor</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="New Contact" class="form-control" name="nama_kantor" required/> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat Kantor</label>
                        <div class="col-md-6">
                            <textarea name="alamat_kantor" class="form-control" required></textarea>   
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nomor Telpon</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="New Phone Number" class="form-control" name="no_telp"/> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fax</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="New Fax" class="form-control" name="fax"/> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kota</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="New City" class="form-control" name="kota" /> </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Tipe Kontak</label>   
                        <div class="col-md-2">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-2">
                                    <select class="form-control input-small" name="tipe">
                                        <option disabled>Pilih Tipe Kontak</option>
                                        @foreach ( $tipe_alamat as $tipe )
                                        <option value="{{ $tipe->id_tipe }}">{{ $tipe->tipe_alamat }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>  
                        </div>                      
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Longitude</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="New Longitude" class="form-control" name="longitude" /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Latitude</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="New Latitude" class="form-control" name="latitude" /> </div>
                    </div>
                    <hr>
                    <div class="form-actions" >
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
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
<script src="{{ asset('public/assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/form-repeater.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.7.1/basic/ckeditor.js" type="text/javascript"></script>
 <!-- <script>
    CKEDITOR.replace( 'isi_berita' );
 </script> -->
@endsection