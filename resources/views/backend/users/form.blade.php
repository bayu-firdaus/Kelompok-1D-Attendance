@extends('adminlte::page')
<!-- page title -->
@section('title', 'Create and Update Users ' . Config::get('adminlte.title'))

@section('content_header')
    <h1>Pengguna</h1>
@stop

@section('content')
    {{--Show message if any--}}
    @include('layouts.flash-message')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Pengguna</h3>
        </div>

        {{ Form::open(array('url' => route($data->form_action), 'method' => 'POST','autocomplete' => 'off', 'files' => true)) }}
        {{ Form::hidden('id', $data->id, array('id' => 'user_id')) }}

        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-2 col-form-label">
                    <strong class="field-title">Nama</strong>
                </div>
                <div class="col-sm-10 col-content">
                    {{ Form::text('name', $data->name, array('class' => 'form-control', 'required')) }}
                    <small class="form-text text-muted">
                        <i class="fa fa-question-circle" aria-hidden="true"></i> Nama Pengguna.
                    </small>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2 col-form-label">
                    <strong class="field-title">Email</strong>
                </div>
                <div class="col-sm-10 col-content">
                    {{ Form::email('email',$data->email, array('class' => 'form-control', 'required')) }}
                    <small class="form-text text-muted">
                        <i class="fa fa-question-circle" aria-hidden="true"></i> Email Pengguna, Email Ini Untuk Masuk.
                    </small>
                </div>
            </div>

            <div id="form-password" class="form-group row">
                <div class="col-sm-2 col-form-label">
                    <strong class="field-title">Kata Sandi</strong>
                </div>
                <div class="col-sm-10 col-content">
                    {{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'autocomplete' => 'new-password')) }}
                    @if($data->page_type === 'edit')
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            <i class="fa fa-question-circle" aria-hidden="true"></i> Kosongkan Jika Tidak Ingin Berubah
                        </small>
                    @else
                        <small class="form-text text-muted">
                            <i class="fa fa-question-circle" aria-hidden="true"></i> Kata Sandi Pengguna, Kata Sandi Ini Untuk Masuk.
                        </small>
                    @endif
                    <label class="reset-field-password" for="show-password"><input id="show-password" type="checkbox" name="show-password" value="1"> Tampilkan Kata Sandi</label>
                </div>
            </div>

            {{--  image  --}}
            <div id="form-image" class="form-group row">
                <div class="col-sm-2 col-form-label">
                    <strong class="field-title">Gambar</strong>
                </div>
                <div class="col-sm-10 col-content">
                    <input class="custom-file-input" name="image" type="file"
                           accept="image/gif, image/jpeg,image/jpg,image/png" data-max-width="800"
                           data-max-height="400">
                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                    <span
                        class="image-upload-label"><i class="fa fa-question-circle" aria-hidden="true"></i> Mohon Unggah Gambar (Rekomendasi Ukuran: 160px × 160px, maks 5MB)</span>
                    <div class="image-preview-area">
                        <div id="image_preview" class="image-preview">
                            @if ($data->page_type == 'edit')
                                <img src="{{ asset('uploads/'.$data->image) }}" width="160" title="image"
                                     class="img-circle elevation-2">
                            @else
                                <img src="{{ asset('img/user-attendance.png') }}" width="160" title="image"
                                     class="img-circle elevation-2">
                            @endif
                        </div>
                        {{-- only image has main image, add css class "show" --}}
                        <p class="delete-image-preview @if ($data->image != null && $data->image != 'user-attendance.png') show @endif"
                           onclick="deleteImagePreview(this);"><i class="fa fa-window-close"></i></p>
                        {{-- delete flag for already uploaded image in the server --}}
                        <input name="image_delete" type="hidden">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2 col-form-label">
                    <strong class="field-title">Jabatan</strong>
                </div>
                <div class="col-sm-10 col-content">
                    {{ Form::select('role', $role, $data->role, array('id' => 'role', 'class' => 'form-control', 'required')) }}
                    <small class="form-text text-muted">
                        <i class="fa fa-question-circle" aria-hidden="true"></i> Jabatan Pengguna.
                    </small>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div id="form-button">
                <div class="col-sm-12 text-center top20">
                    <button style="background-color: #e11586" type="submit" name="submit" id="btn-admin-member-submit"
                            class="btn btn-dark">{{ $data->button_text }}</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>

    <!-- /.card -->
    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop

@section('css')
@stop

@section('js')
    <script>var typePage = "{{ $data->page_type }}";</script>
    <script src="{{ asset('js/backend/users/form.js'). '?v=' . rand(99999,999999) }}"></script>
@stop
