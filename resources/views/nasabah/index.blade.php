@extends('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>Data Nasabah</h2>
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
                    <th>No Rekening</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama Ibu</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>
                @foreach ($data_nasabah as $nasabah)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$nasabah->id}}</td>
                    <td><a href="/nasabah/{{$nasabah->id}}/profile">{{$nasabah->nama}}</a></td>
                    <td>{{$nasabah->alamat}}</td>
                    <td>{{$nasabah->tgl_lahir}}</td>
                    <td>{{$nasabah->jenis_kelamin}}</td>
                    <td>{{$nasabah->nama_ibu}}</td>
                    <td>{{$nasabah->email}}</td>
                    <td>
                        <a href="/nasabah/{{$nasabah->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/nasabah/{{$nasabah->id}}/delete" onclick="return confirm('Apakah yakin ingin dihapus ?')" class="btn btn-danger btn-sm">Delete</a>
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
            <form action="/nasabah/create" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" id="" placeholder="Nama Lengkap" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="" placeholder="0000-00-00" name="tgl_lahir" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin" required>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Ibu</label>
                    <input type="text" class="form-control" id="" placeholder="Nama Ibu" name="nama_ibu" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="text" class="form-control" id="" placeholder="Username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat" placeholder="Alamat" required></textarea>
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