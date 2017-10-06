@extends('layouts.app2')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Detail Resep</span>
                </div>
            </div>
            <div class="portlet-body form">
            	
                <form role="form" method="POST" action="{{ url('recipe/update') }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama resep</label>
                        <div class="col-md-4">
                            <input type="text" value="{{ $data->id }}" class="form-control" name="id" required style="display:none"/>
                            <input type="text" value="{{ $data->nama_resep }}" class="form-control" name="recipename" required disabled/> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kategori resep</label>
                        <div class="col-md-4">
                            <select class="form-control input-small" name="category" disabled>
                                <option disabled> Kategori </option>
                                @foreach ( $kategori as $k)
                                <option value="{{ $k->idkat }}" <?php if ( $k->idkat == $data->kategori ) echo 'selected' ?> >{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Produk untuk resep</label>
                        <div class="col-md-5">
                            <select class="form-control input-large" name="product" disabled>
                                <option disabled> Produk </option>
                                @foreach ( $produk as $p)
                                <option value="{{ $p->idprod }}" <?php if ( $p->idprod == $data->produk ) echo 'selected' ?> >{{ $p->nama_produk }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Deskripsi resep</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="3" name="recipedesc" required disabled>{{ $data->deskripsi_resep }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Bahan</label>     
                        <div class="col-md-9">
                            <div class="mt-repeater">
                                <div data-repeater-list="ingredient">
                                    @foreach( $bahan as $bhn)
                                    <div data-repeater-item class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            <input type="text" placeholder="Fresh tuna" class="form-control" name="ingredientname" value="{{ $bhn->nama_bahan }}" required disabled/></div>
                                        <div class="col-md-2">
                                            <input type="text" placeholder="Kuantitas" class="form-control" name="quantity" value="{{ $bhn->kuantitas_bahan }}" required disabled/></div>
                                        <div class="col-md-2" style="margin-left:-18px;">
                                            <select class="form-control input-small" name="unit" disabled>
                                                <option disabled> Unit </option>
                                                @foreach ( $unit as $u)
                                                <option value="{{ $u->idunit }}" <?php if ( $bhn->kuantitas_unit == $u->idunit ) echo 'selected' ?> >{{ $u->unit }}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                               
                                <br>
                                <br> 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        
                        <label class="col-md-3 control-label">Instruksi</label>
                        <div class="col-md-9">
                            <div class="mt-repeater">
                                <div data-repeater-list="instruction">
                                    @foreach ( $instruksi as $ins )
                                    <div data-repeater-item class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-5">
                                            <textarea class="form-control" rows="3" placeholder="Prepare spices" name="instructiondesc" required disabled>{{ $ins->instruksi }}</textarea>
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <br>
                                <br> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions" >
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a type="button" class="btn btn-circle grey-salsa btn-outline" href="{{ url('/approval/recipe') }}">Kembali</a>
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