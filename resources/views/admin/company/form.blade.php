@extends('admin.layouts.app')

@section('title', isset($company) ? 'Edit' : 'Add')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Companies</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Companies</a></li>
                            <li class="breadcrumb-item active">{{ isset($company) ? 'Edit' : 'Add' }}</li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card card-primary">
                            <form
                                action="{{ isset($company) ? route('company.update', $company->id) : route('company.store') }}"
                                method="POST" id="company-form" enctype="multipart/form-data">
                                @csrf
                                @isset($company)
                                    <input type="hidden" name="_method" value="PUT" />
                                @endisset
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter name" value="{{ old('name', @$company->name) }}">
                                        @if ($errors->has('name'))
                                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="Enter email" value="{{ old('email', @$company->email) }}">
                                        @if ($errors->has('email'))
                                            <div class="error text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="logo"
                                                    id="logo">
                                                <label class="custom-file-label" for="logo">Choose file</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('logo'))
                                            <div class="error text-danger">{{ $errors->first('logo') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" class="form-control" name="website" id="website"
                                            placeholder="Enter website" value="{{ old('website', @$company->website) }}">
                                        @if ($errors->has('website'))
                                            <div class="error text-danger">{{ $errors->first('website') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit"
                                        class="btn btn-primary">{{ isset($company) ? 'Update' : 'Create' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
