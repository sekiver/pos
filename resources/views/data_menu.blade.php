@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Bordered Table</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Category</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>                
               @foreach($menus as $rsMenu)
                    <tr>
                        <td>{{ $rsMenu["id_menu"] }}</td>
                        <td>{{ $rsMenu["nm_menu"] }}</td>
                        <td>{{ $rsMenu["harga"] }}</td>
                        <td>{{ $rsMenu["cat"] }}</td>
                        <td>{{ $rsMenu["desc"] }}</td>
                        <td>{{ $rsMenu["status"] }}</td>
                    </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
</div>
@endsection