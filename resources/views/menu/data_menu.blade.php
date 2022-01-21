@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
<script>
    $(function(){
        @if(session("type"))
            showMessage('{{ session("type") }}','{{ session("text") }}');
        @endif
    });
</script>
<div class="card">
    <div class="card-header">
      <div class="card-title">
        <a href="{{ url('menu/form') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> ADD NEW</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-hover data">
            <thead>
                <tr>
                    <th style="width: 10px">Foto</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>                
               @foreach($menus as $rsMenu)
                    <tr>
                        <td>
                            @if($rsMenu["foto"]!="")
                                <img class="avatar" src="{{ $rsMenu["foto"] }}" alt="">
                            @else
                                <img class="avatar" src="{{ asset("images/no-image.png") }}" alt="">
                            @endif
                        </td>
                        <td>{{ $rsMenu["kd_menu"] }}</td>
                        <td>
                            {{ $rsMenu["nm_menu"] }}<br/>
                            <p><strong>Ket : </strong>{{ $rsMenu["ket"] }}</p>
                        </td>
                        <td>{{ $rsMenu["kategori"] }}</td>                        
                        <td>{{ number_format($rsMenu["harga"],"0",",",".") }} / {{ $rsMenu["satuan"] }}</td>
                        <td>{{ $rsMenu["stok"] }}</td>
                        <td>
                            <a href="{{ url('menu/form/'.$rsMenu["id_menu"]) }}" class="btn btn-warning btn-flat btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{ url('menu/delete/'.$rsMenu["id_menu"]) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
</div>
@endsection