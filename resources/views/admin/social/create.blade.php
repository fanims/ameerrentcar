@extends('admin.layout.layout')

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Add Social</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumbs />
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- form column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Social Links</h3>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif


                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('social.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="facebook">Facebook URL</label>
                                    <input type="url" class="form-control" name="facebook" value="{{ $socials[0]->facebook ?? '' }}" id="facebook" placeholder="https://facebook.com/yourpage">
                                    @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="instagram">Instagram URL</label>
                                    <input type="url" class="form-control" name="instagram" value="{{ $socials[0]->instagram ?? '' }}" id="instagram" placeholder="https://instagram.com/yourprofile">
                                    @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="whatsapp">WhatsApp URL</label>
                                    <input type="url" class="form-control" name="whatsapp" value="{{ $socials[0]->whatsapp ?? '' }}" id="whatsapp" placeholder="https://wa.me/your_number">
                                    @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="twitter">Twitter URL</label>
                                    <input type="url" class="form-control" name="twitter" value="{{ $socials[0]->twitter ?? '' }}" id="twitter" placeholder="https://twitter.com/yourhandle">
                                    @error('twitter') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telegram">Telegram URL</label>
                                    <input type="url" class="form-control" name="telegram" value="{{ $socials[0]->telegram ?? '' }}" id="telegram" placeholder="https://t.me/yourchannel">
                                    @error('telegram') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $(".select2").select2();
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });
    });
</script>
@endpush
