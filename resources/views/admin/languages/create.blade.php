@extends('admin.layout.layout')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush
@section('content')
<div class="content-wrapper">

    <!-- /.content -->
    @include('admin.languages.partial', ['action' => route('languages.store'), 'isEdit' => false])

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