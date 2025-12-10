@extends('admin.layout.layout')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/monokai.css') }}" />
@endpush

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Add Car</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumbs />
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Car Details</h3>
                </div>

                @if (session('error'))
                <div class="alert alert-danger mt-1 alert-dismissible fade show" role="alert" id="error">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script>
                    setTimeout(function() {
                        $("#error").fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                </script>
                @endif
                @if (session('success'))
                <div class="alert alert-success mt-1 alert-dismissible fade show" role="alert" id="success">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script>
                    setTimeout(function() {
                        $("#success").fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                </script>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger mt-1 alert-dismissible fade show" role="alert" id="error">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script>
                    setTimeout(function() {
                        $("#error").fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                </script>
                @endif

                <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="step1-tab" data-toggle="pill"
                                    href="#step1" role="tab">1. Car Details</a></li>
                            <li class="nav-item"><a class="nav-link" id="step2-tab" data-toggle="pill" href="#step2"
                                    role="tab">2. Pricing</a></li>
                            <li class="nav-item"><a class="nav-link" id="step3-tab" data-toggle="pill" href="#step3"
                                    role="tab">3. Features</a></li>
                            <li class="nav-item"><a class="nav-link" id="step4-tab" data-toggle="pill" href="#step4"
                                    role="tab">4. Description</a></li>
                            <li class="nav-item"><a class="nav-link" id="step5-tab" data-toggle="pill" href="#step5"
                                    role="tab">5. Images</a></li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <!-- Step 1 -->
                            <div class="tab-pane fade show active" id="step1" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name (English)</label>
                                            <input type="text" value="{{ old('name.en') }}" name="name[en]"
                                                class="form-control">
                                            @error('name.en') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Name (Arabic)</label>
                                            <input type="text" value="{{ old('name.ar') }}" name="name[ar]"
                                                class="form-control">
                                            @error('name.ar') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Select Brand</label>
                                            <select class="form-control select2" name="brand_id" style="width: 100%;">
                                                @foreach ($brands as $index => $brand)
                                                <option value="{{ $brand->id }}" {{ old('brand_id')==$brand->id ?
                                                    'selected' : '' }}>{{ $brand->name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Car Type</label>
                                            <select class="form-control select2" name="car_type" style="width: 100%;">
                                                @foreach ($types as $type)
                                                <option value="{{ $type->name_en }}" {{ (old('car_type')==$type->name_en || (!old('car_type') && $type->name_en == 'New'))
                                                    ? 'selected' : '' }}>{{ $type->name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('car_type') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select class="form-control select2" name="category_id"
                                                style="width: 100%;">
                                                @foreach ($categories as $index => $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ?
                                                    'selected' : '' }}>
                                                    {{ $cat->getTranslatedName(30) }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('category_id') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Model Year</label>
                                            <input value="{{ old('model_year') }}" type="number" class="form-control"
                                                name="model_year">
                                            @error('model_year') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="tab-pane fade" id="step2" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        @foreach(['day', 'hour', 'week', 'month'] as $period)
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Base Price per {{ ucfirst($period) }}</label>
                                                <input value="{{ old(" base_price_per_$period") }}" type="number"
                                                    class="form-control" name="base_price_per_{{ $period }}"
                                                    step="0.01">
                                                @error("base_price_per_$period") <span class="text-danger">{{ $message
                                                    }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Current Price per {{ ucfirst($period) }}</label>
                                                <input value="{{ old(" current_price_per_$period") }}" type="number"
                                                    class="form-control" name="current_price_per_{{ $period }}"
                                                    step="0.01">
                                                @error("current_price_per_$period") <span class="text-danger">{{
                                                    $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>KM Limit per {{ ucfirst($period) }}</label>
                                                <input value="{{ old(" km_per_$period") }}" type="number"
                                                    class="form-control" name="km_per_{{ $period }}">
                                                @error("km_per_$period") <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="tab-pane fade" id="step3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Persons Can Sit</label>
                                            <input value="{{ old('persons_can_sit') }}" type="number"
                                                class="form-control" name="persons_can_sit">
                                            @error('persons_can_sit') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Seats Available</label>
                                            <input value="{{ old('seats_available') }}" type="number"
                                                class="form-control" name="seats_available">
                                            @error('seats_available') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Number of Bags</label>
                                            <input value="{{ old('number_of_bags') }}" type="number"
                                                class="form-control" name="number_of_bags">
                                            @error('number_of_bags') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Gear</label>
                                            <select class="form-control" name="gear">
                                                <option value="">Select Gear</option>
                                                <option value="Manual" {{ old('gear')=='Manual' ? 'selected' : '' }}>
                                                    Manual</option>
                                                <option value="Automatic" {{ old('gear')=='Automatic' ? 'selected' : ''
                                                    }}>Automatic</option>
                                            </select>
                                            @error('gear') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fuel Type</label>
                                            <input value="{{ old('fuel') }}" type="text" class="form-control"
                                                name="fuel" value="{{ old('fuel', $car->fuel ?? '') }}">
                                            @error('fuel') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Engine (cm³)</label>
                                            <input value="{{ old('engine') }}" type="text" class="form-control"
                                                name="engine" value="{{ old('engine', $car->engine ?? '') }}">
                                            @error('engine') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Service Included</label>
                                            <select class="form-control" name="service_included">
                                                <option value="1" {{ old('service_included', $car->service_included ??
                                                    '') == 1 ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ old('service_included', $car->service_included ??
                                                    '') == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('service_included') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Number of Doors</label>
                                            <input value="{{ old('doors') }}" type="number" class="form-control"
                                                name="doors" value="{{ old('doors', $car->doors ?? '') }}">
                                            @error('doors') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label>Interior Colors</label>
                                            <div id="interior-colors" class="d-flex flex-wrap mb-2"></div>
                                            <button type="button" class="btn btn-sm btn-success mb-3"
                                                onclick="addColorPicker('interior')">+ Add Interior Color</button>
                                            <input type="hidden" name="interior_colors" id="interior_colors_input">
                                            @error('interior_colors') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label>Exterior Colors</label>
                                            <div id="exterior-colors" class="d-flex flex-wrap mb-2"></div>
                                            <button type="button" class="btn btn-sm btn-success mb-3"
                                                onclick="addColorPicker('exterior')">+ Add Exterior Color</button>
                                            <input type="hidden" name="exterior_colors" id="exterior_colors_input">
                                            @error('exterior_colors') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div class="tab-pane fade" id="step4" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Short Description (English)</label>
                                            <input value="{{ old('short_description.en') }}" type="text"
                                                class="form-control" name="short_description[en]">
                                            @error('short_description.en') <span class="text-danger">{{ $message
                                                }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Short Description (Arabic)</label>
                                            <input value="{{ old('short_description.ar') }}" type="text"
                                                class="form-control" name="short_description[ar]">
                                            @error('short_description.ar') <span class="text-danger">{{ $message
                                                }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description (English)</label>
                                            <textarea name="description[en]"
                                                class="form-control">{{ old('description.en') }}</textarea>
                                            @error('description.en') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description (Arabic)</label>
                                            <textarea name="description[ar]"
                                                class="form-control">{{ old('description.ar') }}</textarea>
                                            @error('description.ar') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5 -->
                            <div class="tab-pane fade" id="step5" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Thumbnail Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="thumbnail"
                                                    id="thumbnail" accept="image/*" onchange="previewThumbnail()">
                                                <label class="custom-file-label" for="thumbnail">Choose thumbnail
                                                    image</label>
                                            </div>
                                            <div class="mt-2" id="thumbnailPreview" style="display: none;">
                                                <img src="" alt="Thumbnail Preview" class="img-fluid img-thumbnail"
                                                    width="200">
                                            </div>
                                            @error('thumbnail') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Other Images</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="other_images[]"
                                                    id="other_images" multiple accept="image/*"
                                                    onchange="previewOtherImages()">
                                                <label class="custom-file-label" for="other_images">Choose other
                                                    images</label>
                                            </div>
                                            <div class="row mt-2" id="otherImagesPreview"></div>
                                            @error('other_images') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Add Car</button>
                    </div>
                </form>
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
        $(".select2bs4").select2({ theme: "bootstrap4" });
        $('#pills-tab a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });

function addColorPicker(type) {
    const container = document.getElementById(`${type}-colors`);

    const wrapper = document.createElement('div');
    wrapper.className = 'position-relative m-1';

    const input = document.createElement('input');
    input.type = 'color';
    input.className = 'form-control form-control-color';
    input.style.width = '50px';
    input.setAttribute('onchange', `updateColorValues('${type}')`);

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.innerHTML = '&times;';
    removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 start-100 translate-middle p-1';
    removeBtn.style.fontSize = '10px';
    removeBtn.style.lineHeight = '1';
    removeBtn.style.borderRadius = '50%';
    removeBtn.style.width = '18px';
    removeBtn.style.height = '18px';
    removeBtn.onclick = function () {
        wrapper.remove();
        updateColorValues(type);
    };

    wrapper.appendChild(input);
    wrapper.appendChild(removeBtn);
    container.appendChild(wrapper);

    updateColorValues(type);
}


function updateColorValues(type) {
    const container = document.getElementById(`${type}-colors`);
    const inputs = container.querySelectorAll('input[type="color"]');
    const values = Array.from(inputs).map(input => input.value);
    document.getElementById(`${type}_colors_input`).value = values.join(',');
}

    function previewThumbnail() {
        const input = document.getElementById('thumbnail');
        const previewContainer = document.getElementById('thumbnailPreview');
        const previewImage = previewContainer.querySelector('img');
        const file = input.files[0];
        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewContainer.style.display = 'block';
        } else {
            previewImage.src = '';
            previewContainer.style.display = 'none';
        }
    }

    function previewOtherImages() {
        const input = document.getElementById('other_images');
        const previewContainer = document.getElementById('otherImagesPreview');
        previewContainer.innerHTML = '';
        Array.from(input.files).forEach(file => {
            const col = document.createElement('div');
            col.classList.add('col-md-3', 'mb-2');
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('img-fluid', 'img-thumbnail');
            img.style.height = '150px';
            img.style.objectFit = 'cover';
            col.appendChild(img);
            previewContainer.appendChild(col);
        });
    }

    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function () {
            const fileName = Array.from(this.files).map(f => f.name).join(', ');
            this.nextElementSibling.innerText = fileName;
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const multipliers = {
        hour: 1 / 24,
        week: 7,
        month: 30
    };

    const baseDay = document.querySelector('input[name="base_price_per_day"]');
    const currentDay = document.querySelector('input[name="current_price_per_day"]');
    const kmDay = document.querySelector('input[name="km_per_day"]');

    function updateOtherFields() {
        const baseDayVal = parseFloat(baseDay.value) || 0;
        const currentDayVal = parseFloat(currentDay.value) || 0;
        const kmDayVal = parseFloat(kmDay.value) || 0;

        for (let period in multipliers) {
            const multiplier = multipliers[period];

            const baseInput = document.querySelector(`input[name="base_price_per_${period}"]`);
            const currentInput = document.querySelector(`input[name="current_price_per_${period}"]`);
            const kmInput = document.querySelector(`input[name="km_per_${period}"]`);

            if (baseInput) baseInput.value = (baseDayVal * multiplier).toFixed(2);
            if (currentInput) currentInput.value = (currentDayVal * multiplier).toFixed(2);
            if (kmInput) kmInput.value = Math.round(kmDayVal * multiplier);
        }
    }

    baseDay.addEventListener('input', updateOtherFields);
    currentDay.addEventListener('input', updateOtherFields);
    kmDay.addEventListener('input', updateOtherFields);
});
</script>

<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script>
    $(function () {
        $("#summernote").summernote();
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai",
        });
    });
</script>
@endpush