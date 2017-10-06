@extends('layouts.app2')

@section('css')
<link href="{{ asset('public/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Forum UKM</span>
                </div>
                <div class="tools"> </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                        <tr>
                            <th style="display: none"> </th>
                            <th class="none">Judul Post</th>
                            <th class="none">Kontent Post</th>
                            <th class="none">Gambar</th>
                             <th class="none">Block</th>
                            <th class="none">Sticky</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $forum )
                        <tr class="odd gradeX">
                            <td style="display: none"></td>
                            <td>{{ $forum->judul_post}}</td>
                            <td>{{ $forum->konten_post }}</td>
                            <td>
                                <img src="{{ asset('') }}{{$forum->gambar}}" width="200px" height="140px" />
                            </td>
                            <td><?php if ( $forum->block  == 1){echo 'Ya';} else echo 'Tidak';?></td>
                            <td><?php if ( $forum->sticky  == 1){echo 'Ya';} else echo 'Tidak';?></td>
                            <td>
                                <a class="btn btn-xs green-meadow" href="{{ url('forum/ukm/'.$forum->id) }}">Lihat Komentar</a>
                                <a class="btn btn-xs default blocksticky-btn" data-id= "{{$forum->id}}" >Block/Sticky</a>
                                <a class="btn btn-xs red" href="{{ url('forumUkm/delete/'.$forum->id) }}" 
                                    onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus Forum</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    
</div>
@endsection

@section('js')
	  <script src="{{ asset('public/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

  <script>
$('tbody').delegate('.blocksticky-btn','click',function(){
  var value= $(this).data('id');
   // console.log(value);
  $.ajax({
    type  : 'get',
    url   : '{{url('/modalBlockSticky')}}',
    data  : {'id':value},
    success :function(data){
           //console.log(data);
      $('#id').val(data.id);
      $('#judul_post').val(data.judul_post);
      $('#konten_post').val(data.konten_post);
      $('#pilihanblock').val(data.block);
      $('#pilihansticky').val(data.sticky);
      $('#modalblocksticky').modal('show');
      //window.location.reload();
    }
  });
});
</script>
@endsection

<!-- Modal block  -->
<div class="modal fade" id="modalblocksticky" tabindex="-1" role="dialog" aria-labelledby="editLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >Tindakan Forum</h4>
      </div>
      <div class="modal-body">
        <form  action="{{ url('blockStickyUkm/update') }}" method="post"  role="form">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Judul Post</label>
            {{-- <input type="text" value="{{ $forum->id }}" class="form-control" name="id" required style="display:none"/> --}}
            <input  type ="text"  class="form-control" id="judul_post" name="judul_post" {{-- value="{{$forum->judul_post}}" --}} disabled/>
          </div>
          <div class="form-group">
            <label>Konten Post</label>
            <textarea  class="form-control" id="konten_post"  name="konten_post" {{-- value="{{ $forum->konten_post }}" --}} disabled></textarea>
          </div>
          <div class="form-group">
            <label >Block</label>
                    <select class="form-control input-small" name="pilihanblock" id="pilihanblock">
                        <option disabled> Pilihan </option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>  
                    </select>       
          </div>
          <div class="form-group">
            <label >Sticky</label>
                    <select class="form-control input-small" name="pilihansticky" id="pilihansticky">
                        <option disabled> Pilihan </option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>  
                    </select>       
          </div>
          <div>
          <input type="hidden" id="id" name="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-circle green">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>
</div>



