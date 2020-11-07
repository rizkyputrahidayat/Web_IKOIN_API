@extends('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>Data ATM</h2>
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
                    <th>ID_ATM</th>
                    <th>Nama ATM</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                </tr>
                @foreach ($data_atm as $atm)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$atm->id_atm}}</td>
                    <td>{{$atm->nama_atm}}</td>
                    <td>{{$atm->alamat}}</td>
                    <td>{{$atm->keterangan}}</td>
                    <td>
                        <a href="/nasabahatm/{{$atm->id_atm}}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/nasabahatm/{{$atm->id_atm}}/delete" onclick="return confirm('Apakah yakin ingin dihapus ?')" class="btn btn-danger btn-sm">Delete</a>
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
            <form action="/nasabahatm/create" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama ATM</label>
                    <div>
                    <select type="text" name="nama_atm" class="form-control" id="exampleFormControlSelect1">
                    <option selected>Pilih</option>
                    <option value="IKOIN"{{(old('status') == 'IKOIN') ? ' selected' : ''}}>IKOIN</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" class="form-control" id="" placeholder="Alamat" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan</label>
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