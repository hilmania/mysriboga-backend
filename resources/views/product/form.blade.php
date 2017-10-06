@extends('layouts.app2')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Tambah Produk</span>
                </div>
                
            </div>

            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('product/add') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama produk</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="Sriboga Ninja" class="form-control" name="productname" required/> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Grup produk</label>
                        <div class="col-md-4" >
                            <select class="form-control input-small" name="group">
                                @foreach ( $group as $u)
                                <option value="{{ $u->idgroup }}">{{ $u->nama_grup }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Deskripsi produk</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="4" placeholder="Tepung berbahan gandum" name="productdesc"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gambar produk</label>
                        <div class="col-md-4">
                            <input type="file" name="picture"/>
                            <span class="help-block">Resolusi maksimal 600 x 414 piksel, dengan format PNG atau JPG</span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kandungan</label> 	
                        <div class="col-md-9">
                            <div class="mt-repeater">
                                <div data-repeater-list="content">
                                    <div data-repeater-item class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            <input type="text" placeholder="Protein" class="form-control" name="parameter" /> </div>
                                        <div class="col-md-2">
                                            <input type="text" placeholder="Min 12.50%" class="form-control" name="value" /> </div>
										<div class="col-md-1">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                    <i class="fa fa-plus"></i> Kandungan lainnya</a>
                                <br>
                                <br> 
                            </div>
                        </div>
                    </div>
                    <hr>
		<!--
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kegunaan</label>
                        <div class="col-md-9">
                            <div class="mt-repeater">
                                <div data-repeater-list="usage">
                                    <div data-repeater-item class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            <input type="text" placeholder="Mie Ramen" class="form-control" name="useof" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="file" placeholder="Mie Ramen" name="photo" />
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
                                    <i class="fa fa-plus"></i> Kegunaan lainnya </a>
                                <br>
                                <br> 
                            </div>
                        </div>
                    </div> --!>
                    
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