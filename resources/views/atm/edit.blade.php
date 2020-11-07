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
									<h3 class="panel-title">Edit Data ATM</h3>
								</div>
								<div class="panel-body">
									<form action="/nasabahatm/{{$atm->id_atm}}/update" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama ATM</label>
                                            <input type="text" value="{{$atm->nama_atm}}" class="form-control" id="" placeholder="Nama ATM" name="nama_atm" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <input type="text" value="{{$atm->alamat}}" class="form-control" id="" placeholder="Alamat" name="alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan</label>
                                            <input type="text" value="{{$atm->keterangan}}" class="form-control" id="" placeholder="Keterangan" name="keterangan" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Data</button>
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