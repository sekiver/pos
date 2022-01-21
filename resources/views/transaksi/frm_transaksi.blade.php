@extends('layouts.template')

@section('content')
    <div id="transaksi">
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
                        <div class="menu-item col-md-3">
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
                <div class="info">
                    <div class="row">
                        <div class="customer info-item col-md-6">
                            <a href="" class="btn btn-block btn-flat btn-secondary" data-toggle="modal" data-target="#member"><i class="fa fa-user"></i> <span id="customer"> Customer</span></a>
                        </div>
                        <div class="meja info-item  col-md-6">
                            <a href="" class="btn btn-block btn-flat btn-secondary"><i class="fa fa-bullseye"></i> <span id="customer"> </i> Meja</a>
                        </div>
                    </div>
                    <h3>Agus Setiawan : M0001</h3>
                </div>
                <div class="detail">
                    <div class="detail-item">
                        <div class="row">
                            <div class="item col-md-7">
                                <h4>Nasi Goreng</h4>
                                <p>Items :<input type="number" min="1" value="1"></p>
                            </div>
                            <div class="price col-md-5">
                                <h4><span>Rp</span> 7.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="row">
                            <div class="item col-md-7">
                                <h4>Nasi Goreng</h4>
                                <p>Items :<input type="number" min="1" value="1"></p>
                            </div>
                            <div class="price col-md-5">
                                <h4><span>Rp</span> 75.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="row">
                            <div class="item col-md-7">
                                <h4>Nasi Goreng</h4>
                                <p>Items :<input type="number" min="1" value="1"></p>
                            </div>
                            <div class="price col-md-5">
                                <h4><span>Rp</span> 10.750.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="row">
                            <div class="item col-md-7">
                                <h4>Nasi Goreng</h4>
                                <p>Items :<input type="number" min="1" value="1"></p>
                            </div>
                            <div class="price col-md-5">
                                <h4><span>Rp</span> 75.000</h4>
                            </div>
                        </div>
                    </div>                                                            
                </div>
                <div class="charge">
                    <div class="other">
                        <div class="other-item">
                            <div class="row">
                                <div class="item col-md-7">
                                    <p><strong>Discount</strong></p>
                                </div>
                                <div class="price col-md-5">
                                    <p><span>Rp</span> 15.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="other-item">
                            <div class="row">
                                <div class="item col-md-7">
                                    <p><strong>PPN 10%</strong></p>
                                </div>
                                <div class="price col-md-5">
                                    <p><span>Rp</span> 10.000</p>
                                </div>
                            </div>
                        </div>                                                              
                    </div>
                    <div class="nav-button">
                        <div class="row">
                            <div class="nav-item col-md-6">
                                <a href="" class="btn btn-block btn-flat btn-info">SAVE BILL</a>          
                            </div>
                            <div class="nav-item col-md-6">
                                <a href="" class="btn btn-block btn-flat btn-info">PRINT BILL</a> 
                            </div>                            
                        </div>
                    </div>
                    <h2 id="amount">Rp 12.750.000</h2>
                </div>
            </div>
        </div>
    </div>
@endsection