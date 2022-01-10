@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
    <form action="{{ url('member/save') }}" method="post">
        @csrf {{-- Token Keamanan --}}
        <div class="row">
            <div class="dt_foto col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/no-image.png') }}" alt="">
                    </div>
                </div>                
            </div>
            <div class="dt_member col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kd_member">Kode Member</label>
                            <input type="text" class="form-control" id="kd_member" name="kd_member" placeholder="Kode Member">
                        </div>
                        <div class="form-group">
                            <label for="nm_member">Nama Member</label>
                            <input type="text" class="form-control" id="nm_member" name="nm_member" placeholder="Nama Member">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota">
                        </div>
                        <div class="form-group">
                            <label for="telp">Telepon</label>
                            <input type="text" class="form-control" id="telp" name="telp" placeholder="telp">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="custom-select rounded-0" id="jk" name="jk">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="1">Laki-Laki</option>
                                <option value="0">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="custom-select rounded-0" id="status" name="status">
                                <option value="">- Pilih Status -</option>
                                <option value="1">Aktif</option>
                                <option value="0">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-flat btn-lg btn-primary w-50">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection