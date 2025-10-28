<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lanauges</h1>
            </div>
            @if(!$isEdit)
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('languages.index') }}" class="btn btn-primary">All Language</a>
            </div>
            @endif

        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $isEdit ? 'Update' : 'Add' }} Language</h3>
                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        @if($isEdit) @method('PUT') @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>

                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $language->name ?? '') }}" placeholder="Language Name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Code</label>

                                <input type="text" name="code" class="form-control"
                                    value="{{ old('code', $language->code ?? '') }}" placeholder="Language Code">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="direction">Direction</label>
                                <select name="direction" class="form-control">
                                    <option value="ltr" {{ old('direction', $language->direction ?? '') == 'ltr' ?
                                        'selected' : '' }}>Left to Right (LTR)</option>
                                    <option value="rtl" {{ old('direction', $language->direction ?? '') == 'rtl' ?
                                        'selected' : '' }}>Right to Left (RTL)</option>
                                </select>
                                @error('direction')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>


            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>