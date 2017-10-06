@extends('layouts.app2')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Edit Berita</span>
                </div>
            </div>
            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('berita/update') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Judul Berita</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->id }}" class="form-control" name="id" required style="display:none"/>
                            <input type="text" value="{{ $data->judul_berita }}" class="form-control" name="judul_berita" required/> </div>
                    </div>
                   <div class="form-group">
                        <label class="col-md-3 control-label">Cover Berita</label>
                        <div class="col-md-4">
                            <input type="file" name="photo" required/>
                            <span class="help-block">Resolusi maksimal 600 x 414 piksel, dengan format PNG atau JPG</span>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Isi Berita</label>
                        <div class="col-md-9">
                            <input type="text" value="{{ $data->id }}" class="form-control" name="id" required style="display:none"/>
                             <textarea name="isi_berita" class="form-control"  value="{{ $data->isi_berita }}" class="form-control" required>{{htmlspecialchars($data->isi_berita) }} </textarea> 
                         </div>
                    </div>
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
 <script>
    CKEDITOR.replace( 'isi_berita' );
 </script>
@endsection