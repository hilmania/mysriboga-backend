@extends('layouts.app2')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Edit Pertanyaan</span>
                </div>
                
            </div>

            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('faq/update') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pertanyaan</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $edit->idfaq_pertanyaan }}" class="form-control" name="id" required style="display:none" />
                            <textarea class="form-control" rows="2" placeholder="" name="question" required>{{ $edit->pertanyaan }}</textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kategori Pertanyaan</label>
                        <div class="col-md-4" >
                            <select class="form-control input-small" name="cat">
                                @foreach ( $group as $u)
                                <option value="{{ $u->idfaq_kategori }}" <?php if ( $u->idfaq_kategori == $edit->idfaq_kategori) echo 'selected' ?> >{{ $u->nama_kategori }}</option>
                                @endforeach
                            </select> 
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
<script src="{{ asset('public/assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/form-repeater.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
@endsection