@extends('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>Data Tabungan</h2>
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
                    <th>ID Nasabah</th>
                    <th>Date Transaksi</th>
                    <th>ID Pengirim</th>
                    <th>ID Penerima</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                    <th>Keterangan</th>
                    <th>Jenis Transaksi</th>
                    <th>ID Atm</th>
                    <th>ID Merchant</th>
                    <th>Mode Transaksi</th>
                </tr>
                @foreach ($tabungan as $tab)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$tab->id_nasabah}}</td>
                    <td>{{$tab->tanggal}}</td>
                    <td>{{$tab->id_pengirim}}</td>
                    <td>{{$tab->id_penerima}}</td>
                    <td>{{$tab->nominal_debit}}</td>
                    <td>{{$tab->nominal_kredit}}</td>
                    <td>{{$tab->saldo}}</td>
                    <td>{{$tab->keterangan}}</td>
                    <td>{{$tab->jenis_transaksi}}</td>
                    <td>{{$tab->id_atm}}</td>
                    <td>{{$tab->id_merchant}}</td>
                    <td>{{$tab->mode_transaksi}}</td>
                    
                    <td>
                        <a href="/tab/{{$tab->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/tab/{{$tab->id}}/delete" onclick="return confirm('Apakah yakin ingin dihapus ?')" class="btn btn-danger btn-sm">Delete</a>
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
        {{--  value="{{$tab->id_nasabah}}"  --}}
        <div class="modal-body">
            <form action="/tabungan/create" method="POST">
                @csrf
                <div class="form-group">
                    <label>ID Nasabah</label>
                    <input type="text" class="form-control" id="" placeholder="ID Nasabah"  name="id_nasabah" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="" placeholder="Tanggal Transaksi" value="<?= date("Y-m-d h:i:s "); ?>" name="tanggal" required>
                    
                </div>
                <div class="form-group">
                    <label>ID Pengirim</label>
                    <input type="text" class="form-control" id="" placeholder="ID Pengirim" name="id_pengirim" required>
                </div>
                <div class="form-group">
                    <label>ID Penerima</label>
                    <input type="text" class="form-control" id="" placeholder="ID Penerima" name="id_penerima" required>
                </div>
                <div class="form-group">
                    <label>Nominal Transfer</label>
                    <input type="text" class="form-control" id="" placeholder="Digit Transfer" name="nominal_kredit" required>
                </div>
                <div class="form-group">
                    <label>Saldo</label>
                    <input type="text" class="form-control" id="" placeholder="Saldo" name="saldo" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" id="" placeholder="Keterangan" name="keterangan" required>
                </div>
                <div class="form-group">
                    <label> Jenis Transaksi</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="jenis_transaksi">
                        <option value="0">Setoran</option>
                        <option value="1">Transfer Kirim</option>
                        <option value="2">Transfer Terima</option>
                        <option value="3">Penarikan</option>
                        <option value="4">Merchant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mode Transaksi</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="mode_transaksi">
                        <option value="1">ATM</option>
                        <option value="2">HP</option>
                        <option value="3">Merchant</option>
                    </select>
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