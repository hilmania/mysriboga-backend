@extends('layouts.app2')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Tambah Jawaban untuk Pertanyaan</span>
                </div>
                
            </div>

            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('faq/addjwb') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pertanyaan</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->idfaq_pertanyaan }}" class="form-control" name="id" required style="display:none" />
                            <textarea class="form-control" rows="2" placeholder="" name="question" required disabled>{{ $data->pertanyaan }}</textarea> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kategori Pertanyaan</label>
                        <div class="col-md-4" >
                            <select class="form-control input-small" name="cat" readonly>
                                @foreach ( $group as $u)
                                <option value="{{ $u->idfaq_kategori }}">{{ $u->nama_kategori }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jawaban</label>
                        <div class="col-md-9">
                            <div class="mt-repeater">
                                <div data-repeater-list="answer">
                                    <div data-repeater-item class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-4">
                                            <textarea class="form-control" rows="2" placeholder="" name="ans"></textarea>
                                        </div>
                                        <div>
                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                    <i class="fa fa-plus"></i> Jawaban berikutnya </a>
                                <br>
                                <br> 
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
<script src="{{ asset('public/assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/form-repeater.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
@endsection