@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
    <div id="transaksi">
        {{-- Loading --}}
        <div id="loading"></div>
        <div class="row">
            <div class="menu col-md-8">
                {{-- Menu Navigation --}}
                <div class="menu-navigation">
                    <div class="row">
                        <div class="cashier col-md-4">
                            <h5>Cashier : Eko Santoso</h5>
                        </div>
                        <div class="search col-md-8">
                            <div class="input-group">
                                <input id="search" type="text" class="form-control" placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Menu Navigation --}}
                <!-- List Menu -->
                <div class="menu-list">
                    <div class="row">                    
                    @foreach ($menus as $rsMenu)
                        <div class="menu-item col-md-3" onclick="add_menu('{{ $rsMenu->id_menu }}','{{ $rsMenu->nm_menu }}','{{ $rsMenu->harga }}')">
                            <div class="inner">
                                @if($rsMenu["foto"]!="")
                                    <img class="avatar" src="{{ $rsMenu["foto"] }}" alt="">
                                @else
                                    <img class="avatar" src="{{ asset("images/no-image.png") }}" alt="">
                                @endif
                                <h2>{{ $rsMenu->nm_menu }} <br/>{{ number_format($rsMenu->harga,"0",",",".") }}</h2>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                {{-- End List Menu --}}
            </div>
            <div class="transaksi col-md-4">
                <form id="frmTransaksi" action="{{ url('transaksi/save') }}" method="POST">
                    @csrf
                    {{-- Info Transaksi , Member , Meja  --}}
                    <div class="info">
                        <div class="row">
                            <div class="customer info-item col-md-6">
                                <a href="" class="btn btn-block btn-flat btn-secondary" data-toggle="modal" data-target="#modal-member"><i class="fa fa-user"></i> Customer</a>
                            </div>
                            <div class="meja info-item  col-md-6">
                                <a href="" class="btn btn-block btn-flat btn-secondary" data-toggle="modal" data-target="#modal-meja"><i class="fa fa-bullseye"></i> Meja</a>
                            </div>
                        </div>
                        <h3><span id="nm_member">Member</span> : <span id="meja">Number of Table</span></h3>
                        <input type="hidden" name="id_member" id="id_member" value="">
                        <input type="hidden" name="id_meja" id="id_meja" value="">
                    </div>
                    {{-- End Info Transaksi --}}
                    {{-- Detail Menu yang di beli --}}
                    <div class="detail">
                        {{-- Menu yang di pilih --}}
                    </div>
                    {{-- End Detail --}}
                    {{-- Info Bayar --}}
                    <div class="charge">
                        <div class="other">
                            <div class="other-item">
                                <div class="row">
                                    <div class="item col-md-7">
                                        <p><strong>Discount</strong></p>
                                    </div>
                                    <div class="price col-md-5">
                                        <p id="diskon"><span>Rp</span> 0</p>
                                        <input type="hidden" name="diskon" id="txtDiskon" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="other-item">
                                <div class="row">
                                    <div class="item col-md-7">
                                        <p><strong>PPN 10%</strong></p>
                                    </div>
                                    <div class="price col-md-5">
                                        <p id="ppn"><span>Rp</span> 0</p>
                                        <input type="hidden" name="ppn" id="txtPPN" value="0">
                                    </div>
                                </div>
                            </div>                                                              
                        </div>
                        <div class="nav-button">
                            <div class="row">
                                <div class="nav-item col-md-6">
                                    <a id="btn-save" href="javascript:void(0)" class="btn btn-block btn-flat btn-info" onclick="save_transaksi()">SAVE BILL</a>          
                                    <a id="btn-new" href="javascript:void(0)" class="btn btn-block btn-flat btn-info d-none" onclick="new_transaksi()">NEW TRANSAKSI</a>          
                                </div>
                                <div class="nav-item col-md-6">
                                    <a id="btn-print" href="javascript:void(0)" data-url="{{ url("transaksi/nota") }}" class="btn btn-block btn-flat btn-info">PRINT BILL</a> 
                                </div>                            
                            </div>
                        </div>
                        <h2 id="amount">Rp 12.750.000</h2>
                    </div>
                    {{-- End Info Bayar --}}
                </form>
            </div>
        </div>

        {{-- Modal Data Member --}}
        <div class="modal fade" id="modal-member">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Data Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover data">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                
                        @foreach($members as $rsMember)
                                <tr>
                                    <td>{{ $rsMember["kd_member"] }}</td>
                                    <td>{{ $rsMember["nm_member"] }}</td>
                                    <td>
                                        {{ $rsMember["alamat"]." ".$rsMember["kota"] }}
                                        <br/>
                                        Telp : {{ $rsMember["telp"] }}
                                    </td>                        
                                    <td>{{ $rsMember["status"]==1 ? "Aktif" : "Non Aktif" }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="pilih_member('{{ $rsMember["id_member"] }}','{{ $rsMember["nm_member"] }}')">PILIH</button>
                                    </td>
                                </tr>
                        @endforeach  
                        </tbody>
                    </table>              
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  
        {{-- End Modal Data Member --}}      

        {{-- Modal Data Member --}}
        <div class="modal fade" id="modal-meja">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Data Meja</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover data">
                        <thead>
                            <tr>
                                <th>No Meja</th>
                                <th>Kapasitas</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                
                        @foreach($meja as $rsMeja)
                                <tr>
                                    <td>{{ $rsMeja["no_meja"] }}</td>
                                    <td>{{ $rsMeja["kapasitas"] }}</td>                  
                                    <td>{{ $rsMeja["status"]==1 ? "Kosong" : "Terisi" }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="pilih_meja('{{ $rsMeja["id_meja"] }}','{{ $rsMeja["no_meja"] }}')">PILIH</button>
                                    </td>
                                </tr>
                        @endforeach  
                        </tbody>
                    </table>              
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  
        {{-- End Modal Data Member --}}    

    {{-- Close Div Transaksi  --}}
    </div>     
    
    {{-- Template Menu --}}
    <div id="tmp-menu" class="detail-item" style="display: none">
        <div class="row">
            <div class="item col-md-7">
                <h4>Nasi Goreng</h4>
                <p>Items :<input class="jumlah" name="jumlah[]" onchange="ganti_harga(this)" type="number" min="1" value="1" data-harga=""></p>
                <input type="hidden" name="id_menu[]" class="txtID">
                <input type="hidden" name="nm_menu[]" class="txtNama">
                <input type="hidden" name="harga[]" class="txtHarga">
            </div>
            <div class="price col-md-5">
                <h4><span>Rp</span> 7.000</h4>
                <a href="javascript:void(0)" class="delete" onclick="del_menu(this)" data-id=""><i class="fas fa-times"></i></a>
            </div>
        </div>
    </div> 
    {{-- End Template Menu --}}

    {{-- Load Nota --}}
    <iframe src="" frameborder="0" id="nota" class="d-none"></iframe>

@endsection