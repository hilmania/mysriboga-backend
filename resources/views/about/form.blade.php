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
                    <span class="caption-subject bold font-green uppercase">Update About</span>
                </div>
            </div>
            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('about/update') }}" class="form-horizontal">
                {{ csrf_field() }}
                    @foreach( $list as $abt )
                    <div class="form-group">
                        <label class="col-md-3 control-label" value=""><?php if($abt->id == 1) echo 'Judul' ?></label>
                        <div class="col-md-2">
                            <input type="text" style="display:none" name="id[]" value="{{ $abt->id }}"/>
                            <input type="text" class="form-control" value="{{ $abt->title }}" name="about[]" style="display: <?php if ($abt->id == 3 || $abt->id == 4 || $abt->id == 5 || $abt->id == 6 || $abt->id == 7) echo 'none'; ?>"/>
                        </div>   
                        <label class="col-md-1 control-label"><?php if($abt->id == 1) echo 'Poin' ?></label> 
                        <div class="col-md-3">
                            <textarea class="form-control" rows="5" name="point[]" style="display: <?php if($abt->id == 8) echo 'none'; ?>">{{ $abt->text }}</textarea> 
                        </div>                        
                    </div>
                    @endforeach
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