@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>                
               @foreach($members as $rsMember)
                    <tr>
                        <td>{{ $rsMember["id_member"] }}</td>
                        <td>{{ $rsMember["kd_member"] }}</td>
                        <td>{{ $rsMember["nm_member"] }}</td>
                        <td>{{ $rsMember["alamat"]." ".$rsMember["kota"] }}</td>
                        <td>{{ $rsMember["telp"] }}</td>
                        <td>{{ $rsMember["jk"]==1 ? "Laki-Laki" : "Perempuan" }}</td>
                        <td>{{ $rsMember["status"]==1 ? "Aktif" : "Non Aktif" }}</td>
                    </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
</div>
@endsection