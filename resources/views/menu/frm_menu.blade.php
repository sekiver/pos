@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
    <script>
        $(function(){
            @if($errors->any())
            showMessage("error", "Terjadi Kesalahan !");
            @endif
        });
    </script>
    <form action="{{ url('menu/save') }}" method="post">
        @csrf {{-- Token Keamanan --}}
        <div class="row">
            <div class="dt_foto col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img id="avatar" src="{{ @$rsMenu->foto != "" ? $rsMenu->foto : asset('images/no-image.png') }}" alt="">
                        <input type="file" name="file" id="file" style="display: none">
                        <textarea name="foto" id="foto" cols="30" rows="10" style="display: none;">{{ @$rsMenu->foto }}</textarea>
                    </div>
                </div>                
            </div>
            <div class="dt_menu col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kd_menu">Kode Menu</label>
                            <input type="hidden" name="id_menu" value="{{ @$rsMenu->id_menu }}">
                            <input type="text" class="form-control @error("kd_menu") is-invalid  @enderror" id="kd_menu" name="kd_menu" placeholder="Kode Menu" value="{{ old("kd_menu") ? old("kd_menu") : @$rsMenu->kd_menu }}">
                            @error("kd_menu")
                            <span id="error-kd_menu" class="error invalid-feedback">
                                {{ $errors->first("kd_menu") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nm_menu">Nama Menu</label>
                            <input type="text" class="form-control @error("nm_menu") is-invalid  @enderror" id="nm_menu" name="nm_menu" placeholder="Nama Menu" value="{{ old("nm_menu") ? old("nm_menu") : @$rsMenu->nm_menu }}">
                            @error("nm_menu")
                            <span id="error-nm_menu" class="error invalid-feedback">
                                {{ $errors->first("nm_menu") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" min="0" class="form-control @error("harga") is-invalid  @enderror" id="harga" name="harga" placeholder="Harga" value="{{ old("harga") ? old("harga") : @$rsMenu->harga }}">
                            @error("harga")
                            <span id="error-harga" class="error invalid-feedback">
                                {{ $errors->first("harga") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="custom-select rounded-0 @error("kategori") is-invalid  @enderror" id="kategori" name="kategori">
                                <option value="">- Pilih Kategori -</option>
                                <option {{ @$rsMenu->kategori == "Makanan" ? "selected" : "" }} value="Makanan">Makanan</option>
                                <option {{ @$rsMenu->kategori == "Minuman" ? "selected" : "" }} value="Minuman">Minuman</option>
                                <option {{ @$rsMenu->kategori == "Snack" ? "selected" : "" }} value="Snack">Snack</option>
                            </select>
                            @error("kategori")
                            <span id="error-kategori" class="error invalid-feedback">
                                {{ $errors->first("kategori") }}
                            </span>
                            @enderror                            
                        </div>                        
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" class="form-control @error("satuan") is-invalid  @enderror" id="satuan" name="satuan" placeholder="Satuan" value="{{ old("satuan") ? old("satuan") : @$rsMenu->satuan }}">
                            @error("satuan")
                            <span id="error-satuan" class="error invalid-feedback">
                                {{ $errors->first("satuan") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <textarea class="form-control @error("ket") is-invalid  @enderror" id="ket" name="ket" placeholder="Keterangan">{{ old("ket") ? old("ket") : @$rsMenu->ket }}</textarea>
                            @error("ket")
                            <span id="error-ket" class="error invalid-feedback">
                                {{ $errors->first("ket") }}
                            </span>
                            @enderror
                        </div>                        
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <select class="custom-select rounded-0 @error("stok") is-invalid  @enderror" id="stok" name="stok">
                                <option value="">- Pilih Stok -</option>
                                <option {{ @$rsMenu->stok == "Available" ? "selected" : "" }} value="Available">Available</option>
                                <option {{ @$rsMenu->stok == "Not Available" ? "selected" : "" }} value="Not Available">Not Available</option>
                            </select>
                            @error("stok")
                            <span id="error-stok" class="error invalid-feedback">
                                {{ $errors->first("stok") }}
                            </span>
                            @enderror 
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