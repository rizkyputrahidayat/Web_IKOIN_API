@extends('layout.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Edit Data Nasabah</h3>
								</div>
								<div class="panel-body">
									<form action="/nasabah/{{$nasabah->id}}/update" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama</label>
                                                <input type="text" class="form-control" id="" placeholder="Nama Lengkap" name="nama" value="{{$nasabah->nama}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="" placeholder="0000-00-00" name="tgl_lahir" value="{{$nasabah->tgl_lahir}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                <select @if($nasabah->jenis_kelamin == 'L') selected @endif class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin" required>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Ibu</label>
                                                <input type="text" class="form-control" id="" placeholder="Nama Ibu" name="nama_ibu" value="{{$nasabah->nama_ibu}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Email</label>
                                                <input type="email" class="form-control" id="" placeholder="Email" name="email" value="{{$nasabah->email}}"required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Alamat</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat" placeholder="Alamat" required>{{$nasabah->alamat}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Avatar</label>
                                                <input type="file" class="form-control"  name="avatar" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning">Update Data</button>
                                            </form>
								</div>
							</div>
							<!-- END INPUTS -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection