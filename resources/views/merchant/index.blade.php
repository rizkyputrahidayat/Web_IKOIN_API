@extends('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>Data Merchant</h2>
                    <div class="right">
                        <button type="button" class="btn btn-primary btn-sm my-10" data-toggle="modal" data-target="#exampleModal">
                            Tambah Data
                        </button>
                    </div>
                    @if(session('sukses'))
            <div class="alert alert-success" role="alert">
                {{session('sukses')}}
            </div>
            @endif
            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>ID Mercahnt</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                </tr>
                @foreach ($data_merchant as $merchant)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$merchant->id_merchant}}</td>
                    <td>{{$merchant->username}}</td>
                    <td><a href="/merchant/{{$merchant->id_merchant}}/profile">{{$merchant->nama}}</a></td>
                    <td>{{$merchant->email}}</td>
                    <td>{{$merchant->alamat}}</td>
                    <td>{{$merchant->keterangan}}</td>
                    <td>
                        <a href="/merchant/{{$merchant->id_merchant}}/delete" 
                        onclick="return confirm('Apakah yakin ingin diHapus ?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
            </div>
        </div>
    </div>
</div>
</div> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/merchant/create" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Merchant</label>
                    <input type="text" class="form-control" id="" placeholder="Nama Merchant" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="" placeholder="Username" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="" placeholder="Password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Nama Nasabah Merchant</label>
                    <input type="text" class="form-control" id="" placeholder="Nasabah Merchant" name="name" required>
                </div>
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" id="" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <label >Alamat</label>
                    <input type="text" class="form-control" id="" placeholder="Alamat" name="alamat" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" id="" placeholder="Keterangan" name="keterangan" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection