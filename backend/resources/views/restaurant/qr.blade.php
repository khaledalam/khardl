@extends('layouts.restaurant-sidebar')

@section('title', __('qr-maker'))

@section('content')

    <style>
        .color-picker {
            display: flex;
            width: 200px;
            align-items: center;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        .color-preview {
            width: 50px;
            height: 50px;
            border-radius: 8px 0 0 8px;
            background-color: black
        }
        .color-code {
            width: 100px;
            height: 50px;
            border-radius: 0 8px 8px 0;
        }
        .color-input {
            border: none;
            border-radius: 0;
            background-color: transparent;
            width: 150px;
            height: 100%;
            padding: 10px;
        }
        #color-picker-input {
            position: absolute;
            visibility: hidden;
        }
    </style>

    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-md-100 mb-5 mb-xl-0 col-lg-7">
                        <!--begin::Form-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <!--begin::General options-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>{{ __('Make a new QR Code') }}</h2>
                                                    {{-- <p class="badge badge-light-success">2 left this week</p> --}}
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <form action="{{ route('restaurant.qr-create') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!--begin::Card body-->
                                                <div class="card-body pt-0">

                                                    <div class="fv-row">
                                                        <div class="row">


                                                            <div class="col-lg-12">

                                                                <!--begin::Label-->
                                                                <label class="required form-label">{{ __('Name') }}</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="name" required value="{{ old('name') }}" class="form-control mb-2" placeholder="{{ __('Name') }}" />
                                                            </div>

                                                            <div class="col-lg-12 mb-10">
                                                                <!--begin::Label-->
                                                                <label class="required form-label">{{ __('URL') }}</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="data" required value="{{ old('data') }}" class="form-control mb-2" placeholder="{{ __('URL') }}" />
                                                            </div>



                                                            <div class="col-lg-12">
                                                                <div class="accordion" id="accordionExample">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                                {{ __('Set The Color') }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                                            <div class="accordion-body">
                                                                                <div class="col-lg-12">
                                                                                    <!-- begin::Label -->
                                                                                    <h6>{{ __('Foreground color') }}</h6>
                                                                                    <!-- end::Label -->
                                                                                    <!-- begin::Input -->
                                                                                    <div class="d-flex mt-3">
                                                                                        <div class="form-check form-check-solid form-switch">
                                                                                            <label class="form-check-label" for="single_color">{{ __('Single Color') }}</label>
                                                                                            <input class="form-check-input w-35px h-20px" type="radio" checked id="single_color" value="1" name="single_color" {{ old('single_color') == '1' ? 'checked' : ''}}>
                                                                                        </div>

                                                                                        <div class="form-check form-check-solid form-switch mx-6">
                                                                                            <label class="form-check-label" for="color_gradient">{{ __('Color Gradient') }}</label>
                                                                                            <input class="form-check-input w-35px h-20px" type="radio" id="color_gradient" value="0" name="single_color">
                                                                                        </div>

                                                                                        <div class="form-check form-check-solid form-switch">
                                                                                            <label class="form-check-label" for="custom_eye_color">{{ __('Custom Eye Color') }}</label>
                                                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="custom_eye_color" value="3" name="custom_eye_color" {{ old('custom_eye_color') == '3' ? 'checked' : ''}}>
                                                                                        </div>
                                                                                    </div>



                                                                                    <div class="d-flex">
                                                                                        <!-- First Color Picker -->
                                                                                        <div class="color-picker mt-5 mb-10" onclick="openColorPicker(event, 'color-preview-1', 'color-code-input-1', 'color-picker-input-1')">
                                                                                            <div class="color-preview rounded-left" id="color-preview-1"></div>
                                                                                            <div class="color-code rounded-right bg-light">
                                                                                                <input required name="color" type="text" id="color-code-input-1" class="color-input form-control" value="#000000" placeholder="Hex Code">
                                                                                            </div>
                                                                                            <input type="color" id="color-picker-input-1" name="bodyColor" style="display: none;">
                                                                                        </div>

                                                                                        <!-- Second Color Picker -->
                                                                                        <div class="gradient-color-container" style="display: none">
                                                                                            <div class="color-picker ms-5 mt-5 mb-10" onclick="openColorPicker(event, 'color-preview-2', 'color-code-input-2', 'color-picker-input-2')">
                                                                                                <div class="color-preview rounded-left" id="color-preview-2"></div>
                                                                                                <div class="color-code rounded-right bg-light">
                                                                                                    <input required name="color" type="text" id="color-code-input-2" class="color-input form-control" value="#000000" placeholder="Hex Code">
                                                                                                </div>
                                                                                                <input type="color" id="color-picker-input-2" name="gradientColor2" style="display: none;">
                                                                                            </div>
                                                                                        </div>

                                                                                        <script>
                                                                                            document.getElementById('color_gradient').addEventListener('change', function() {
                                                                                                var container = document.querySelector('.gradient-color-container');
                                                                                                container.style.display = this.checked ? 'block' : 'none';
                                                                                            });

                                                                                            document.getElementById('single_color').addEventListener('change', function() {
                                                                                                var container = document.querySelector('.gradient-color-container');
                                                                                                container.style.display = this.checked ? 'none' : 'block';
                                                                                            });
                                                                                        </script>
                                                                                    </div>

                                                                                    <div class="custom-eye-color-container" style="display: none">
                                                                                        <h6>{{ __('Eye color') }}</h6>
                                                                                        <!-- Third Color Picker -->
                                                                                        <div class="d-flex">
                                                                                            <div class="color-picker mt-5 mb-10" onclick="openColorPicker(event, 'color-preview-3', 'color-code-input-3', 'color-picker-input-3')">
                                                                                                <div class="color-preview rounded-left" id="color-preview-3"></div>
                                                                                                <div class="color-code rounded-right bg-light">
                                                                                                    <input required name="color" type="text" id="color-code-input-3" class="color-input form-control" value="#000000" placeholder="Hex Code">
                                                                                                </div>
                                                                                                <input type="color" id="color-picker-input-3" name="eyeColor" style="display: none;">
                                                                                            </div>

                                                                                            <!-- Fourth Color Picker -->
                                                                                            <div class="color-picker ms-5 mt-5 mb-10" onclick="openColorPicker(event, 'color-preview-4', 'color-code-input-4', 'color-picker-input-4')">
                                                                                                <div class="color-preview rounded-left" id="color-preview-4"></div>
                                                                                                <div class="color-code rounded-right bg-light">
                                                                                                    <input required name="color" type="text" id="color-code-input-4" class="color-input form-control" value="#000000" placeholder="Hex Code">
                                                                                                </div>
                                                                                                <input type="color" id="color-picker-input-4" name="eyeBallColor" style="display: none;">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <script>
                                                                                        document.getElementById('custom_eye_color').addEventListener('change', function() {
                                                                                            var container = document.querySelector('.custom-eye-color-container');
                                                                                            container.style.display = this.checked ? 'block' : 'none';
                                                                                        });
                                                                                    </script>

                                                                                    <h6>{{ __('Background color') }}</h6>

                                                                                    <!-- Fifth Color Picker -->
                                                                                    <div class="color-picker mt-5 mb-10" onclick="openColorPicker(event, 'color-preview-5', 'color-code-input-5', 'color-picker-input-5')">
                                                                                        <div class="color-preview rounded-left" style="background-color: white" id="color-preview-5"></div>
                                                                                        <div class="color-code rounded-right bg-light">
                                                                                            <input required name="color" type="text" id="color-code-input-5" class="color-input form-control" value="#FFFFFF" placeholder="Hex Code">
                                                                                        </div>
                                                                                        <input type="color" id="color-picker-input-5" name="bgColor" value="#FFFFFF" style="display: none;">
                                                                                    </div>

                                                                                    <script>
                                                                                        function openColorPicker(event, previewId, codeInputId, pickerInputId) {
                                                                                            var colorPickerInput = document.getElementById(pickerInputId);

                                                                                            //Doesnt center for some reason
                                                                                            colorPickerInput.style.position = 'absolute';
                                                                                            colorPickerInput.style.left = event.pageX + 'px';
                                                                                            colorPickerInput.style.top = event.pageY + 'px';

                                                                                            colorPickerInput.click();

                                                                                            colorPickerInput.addEventListener('input', function(event) {
                                                                                                var colorPreview = document.getElementById(previewId);
                                                                                                var colorCodeInput = document.getElementById(codeInputId);

                                                                                                colorPreview.style.backgroundColor = event.target.value;
                                                                                                colorCodeInput.value = event.target.value.toUpperCase();
                                                                                            });
                                                                                        }

                                                                                    </script>
                                                                                </div>                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingTwo">
                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                                {{ __('Add Logo Image') }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                                            <div class="accordion-body">
                                                                                <div class="col-lg-12">
                                                                                    <!-- begin::Label -->
                                                                                    <h6>{{ __('Image - Logo') }}</h6>
                                                                                    <!-- end::Label -->
                                                                                    <!-- begin::Input -->
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-lg-12">
                                                                                            <img src="http://placehold.it/180" width="180px" width="180px" id="blah" alt="upload logo"><br><br>
                                                                                            <input type="file" id="inputFile" onchange="readUrl(this)" accept="image/*" name="file" style="display: none">
                                                                                            <div class="buttons" style="gap: 10px">
                                                                                                <!-- Modify the button to trigger file input -->
                                                                                                <button type="button" class="btn btn-khardl" onclick="document.getElementById('inputFile').click()">{{ __('Upload') }}</button>
                                                                                                <button type="button" class="btn btn-khardl" onclick="removeImg()">{{ __('Remove') }}</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <script>
                                                                                        var a = document.getElementById("blah");

                                                                                        function readUrl(input) {
                                                                                            if (input.files) {
                                                                                                var reader = new FileReader();
                                                                                                reader.readAsDataURL(input.files[0]);
                                                                                                reader.onload = (e) => {
                                                                                                    a.src = e.target.result;
                                                                                                }
                                                                                            }
                                                                                        }

                                                                                        var inputFile = document.getElementById("inputFile");

                                                                                        removeImg = () => {
                                                                                            a.src = "http://placehold.it/180";
                                                                                            inputFile.value = "";
                                                                                        }
                                                                                    </script>

                                                                                    <div class="form-check form-check-solid form-switch mt-4">
                                                                                        <label class="form-check-label" for="logoMode">{{ __('Remove Background Behind Logo') }}</label>
                                                                                        <input class="shadow form-check-input w-35px h-20px" type="checkbox" checked id="logoMode" value="1" name="logoMode" {{ old('logoMode') ? 'checked' : ''}}>
                                                                                    </div>

                                                                                    <style>

                                                                                        .logo{
                                                                                            transition: transform 0.1 ease;
                                                                                        }

                                                                                        .logo:hover {
                                                                                            transform: translateY(-5px);
                                                                                            cursor: pointer;
                                                                                        }
                                                                                    </style>

                                                                                    <div class="logos mt-6">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-2 col-sm-3 col-4">
                                                                                                <div class="logo card border-1 rounded shadow" onclick="changeImage('{{ global_asset('images/facebook-icon.png') }}')">
                                                                                                    <img src="{{ global_asset('images/facebook-icon.png') }}" class="card-img-top rounded-top" alt="...">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-sm-3 col-4">
                                                                                                <div class="logo card border-1 rounded shadow" onclick="changeImage('{{ global_asset('images/instagram-icon.png') }}')">
                                                                                                    <img src="{{ global_asset('images/instagram-icon.png') }}" class="card-img-top rounded-top" alt="...">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-sm-3 col-4">
                                                                                                <div class="logo card border-1 rounded shadow" onclick="changeImage('{{ global_asset('images/x-icon.png') }}')">
                                                                                                    <img src="{{ global_asset('images/x-icon.png') }}" class="card-img-top rounded-top" alt="...">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-lg-2 col-sm-3 col-4">
                                                                                                <div class="logo card border-1 rounded shadow" onclick="changeImage('{{ global_asset('images/twitter-logo.png') }}')">
                                                                                                    <img src="{{ global_asset('images/twitter-logo.png') }}" class="card-img-top rounded-top" alt="...">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-sm-3 col-4">
                                                                                                <div class="logo card border-1 rounded shadow" onclick="changeImage('{{ global_asset('images/whatsapp-icon.png') }}')">
                                                                                                    <img width="120px" src="{{ global_asset('images/whatsapp-icon.png') }}" class="card-img-top rounded-top" alt="...">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-sm-3 col-4">
                                                                                                <div class="logo card border-1 rounded shadow" onclick="changeImage('{{ global_asset('images/tiktok-logo.png') }}')">
                                                                                                    <img src="{{ global_asset('images/tiktok-logo.png') }}" class="card-img-top rounded-top" alt="...">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <script>
                                                                                        function changeImage(newSrc) {
                                                                                            var image = document.getElementById('blah');
                                                                                            image.src = newSrc;
                                                                                            fetch(newSrc)
                                                                                                .then(response => response.blob())
                                                                                                .then(blob => {
                                                                                                    const file = new File([blob], 'image.png', { type: 'image/png' });
                                                                                                    // Create a FileList containing the newly created file
                                                                                                    const fileList = new DataTransfer();
                                                                                                    fileList.items.add(file);
                                                                                                    // Set the files property of the input element to the newly created FileList
                                                                                                    document.getElementById('inputFile').files = fileList.files;
                                                                                                })
                                                                                                .catch(error => console.error('Error fetching image:', error));
                                                                                        }
                                                                                    </script>


                                                                                </div>                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingThree">
                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                                {{ __('Customize Design') }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                                            <div class="accordion-body">
                                                                                <div class="col-lg-12">
                                                                                    <style>
                                                                                        .box {
                                                                                            border: 2px solid transparent;
                                                                                            transition: border-color 0.3s;
                                                                                            cursor: pointer;
                                                                                        }
                                                                                        .box.selected {
                                                                                            border-color: #C2DA08;
                                                                                            border-width: 2px;
                                                                                            border-radius: 25%;
                                                                                        }
                                                                                        .box img {
                                                                                            border-radius: 25%;
                                                                                            width: 100%;
                                                                                            height: 100%;
                                                                                        }
                                                                                    </style>

                                                                                    <input type="hidden" id="body-shape-input" name="body" value="square">
                                                                                    <!-- Eye Frame Shape -->
                                                                                    <input type="hidden" id="eye-frame-shape-input" name="eye" value="frame0">
                                                                                    <!-- Eye Ball Shape -->
                                                                                    <input type="hidden" id="eye-ball-shape-input" name="eyeBall" value="ball0">
                                                                                    <h6 class="mt-6">{{ __('Body Shape') }}</h6>
                                                                                    <div class="row body-shape pe-6 mt-3" style="gap:20px;">
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="circle" src="{{ global_asset('images/circlee.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="circle-zebra" src="{{ global_asset('images/circle-zebra.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="circle-zebra-vertical" src="{{ global_asset('images/circle-zebra-vertical.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="circular" src="{{ global_asset('images/circular.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="diamond" src="{{ global_asset('images/diamond.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="dot" src="{{ global_asset('images/dot.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="edge-cut" src="{{ global_asset('images/edge-cut.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="edge-cut-smooth" src="{{ global_asset('images/edge-cut-smooth.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="japnese" src="{{ global_asset('images/japnese.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="leaf" src="{{ global_asset('images/leaf.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="mosaic" src="{{ global_asset('images/mosaic.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="pointed" src="{{ global_asset('images/pointed.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="pointed-edge-cut" src="{{ global_asset('images/pointed-edge-cut.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="pointed-in" src="{{ global_asset('images/pointed-in.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="pointed-in-smooth" src="{{ global_asset('images/pointed-in-smooth.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="pointed-smooth" src="{{ global_asset('images/pointed-smooth.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="round" src="{{ global_asset('images/round.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="rounded-in" src="{{ global_asset('images/rounded-in.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="rounded-in-smooth" src="{{ global_asset('images/rounded-in-smooth.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="rounded-pointed" src="{{ global_asset('images/rounded-pointed.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="star" src="{{ global_asset('images/star.png') }}" alt="Image">
                                                                                        </div>
                                                                                        <div class="box col-1 p-3 text-center shadow selected" onclick="toggleSelection(this, 'body-shape')">
                                                                                            <img data-name="square" src="{{ global_asset('images/square.png') }}" alt="Image">
                                                                                        </div>
                                                                                    </div>

                                                                                    <h6 class="mt-6">{{ __('Eye Frame Shape') }}</h6>
                                                                                    <div class="row eye-frame-shape mt-3"  pe-6" style="gap:20px;">
                                                                                    <div class="box col-1 p-3 text-center shadow selected" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame0" src="{{ global_asset('images/frame0.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame7" src="{{ global_asset('images/frame7.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame1" src="{{ global_asset('images/frame1.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame2" src="{{ global_asset('images/frame2.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame3" src="{{ global_asset('images/frame3.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame4" src="{{ global_asset('images/frame4.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame5" src="{{ global_asset('images/frame5.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame6" src="{{ global_asset('images/frame6.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame8" src="{{ global_asset('images/frame8.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame10" src="{{ global_asset('images/frame10.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame11" src="{{ global_asset('images/frame11.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame12" src="{{ global_asset('images/frame12.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame13" src="{{ global_asset('images/frame13.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame14" src="{{ global_asset('images/frame14.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-frame-shape')">
                                                                                        <img data-name="frame16" src="{{ global_asset('images/frame16.png') }}" alt="Image">
                                                                                    </div>
                                                                                </div>
                                                                                <h6 class="mt-6">{{ __('Eye Ball Shape') }}</h6>
                                                                                <div class="row eye-ball-shape mt-3 pe-6" style="gap:20px;">
                                                                                    <div class="box col-1 p-3 text-center shadow selected" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball0" src="{{ global_asset('images/ball0.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball1" src="{{ global_asset('images/ball1.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball2" src="{{ global_asset('images/ball2.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball3" src="{{ global_asset('images/ball3.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball5" src="{{ global_asset('images/ball5.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball6" src="{{ global_asset('images/ball6.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball7" src="{{ global_asset('images/ball7.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball8" src="{{ global_asset('images/ball8.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball10" src="{{ global_asset('images/ball10.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball11" src="{{ global_asset('images/ball11.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball12" src="{{ global_asset('images/ball12.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball13" src="{{ global_asset('images/ball13.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball14" src="{{ global_asset('images/ball14.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball15" src="{{ global_asset('images/ball15.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball16" src="{{ global_asset('images/ball16.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball17" src="{{ global_asset('images/ball17.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball18" src="{{ global_asset('images/ball18.png') }}" alt="Image">
                                                                                    </div>
                                                                                    <div class="box col-1 p-3 text-center shadow" onclick="toggleSelection(this, 'eye-ball-shape')">
                                                                                        <img data-name="ball19" src="{{ global_asset('images/ball19.png') }}" alt="Image">
                                                                                    </div>
                                                                                </div>

                                                                                <script>
                                                                                    var selectedItems = {
                                                                                        body: '',
                                                                                        eye: '',
                                                                                        eyeBall: ''
                                                                                    };

                                                                                    function toggleSelection(element, category) {
                                                                                        // Remove 'selected' class from all elements in the same category
                                                                                        var allBoxes = document.querySelectorAll('.' + category + ' .box');
                                                                                        allBoxes.forEach(function(box) {
                                                                                            box.classList.remove('selected');
                                                                                        });

                                                                                        // Add 'selected' class to the clicked element
                                                                                        element.classList.add('selected');

                                                                                        // Update selected item for the corresponding category
                                                                                        var selectedImageName = element.querySelector('img').dataset.name;
                                                                                        selectedItems[category] = selectedImageName;

                                                                                        // Update hidden input field value for the corresponding category
                                                                                        document.getElementById(category + '-input').value = selectedImageName;
                                                                                    }
                                                                                </script>




                                                                            </div>                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <!--begin::Actions-->
                                                    <div class="row justify-content-end mt-10">
                                                        <div class="col-lg-9">
                                                            <label for="customRange1" class="form-label">{{ __('Size of the image') }}</label>
                                                            <input type="range" name="size" class="form-range" id="customRange1" min="200" max="2000" step="100" value="200">
                                                            <output id="rangeValue" dir="{{app()->getLocale() == 'en' ? 'rtl' : 'ltr'}}">200 x 200 {{__('px')}}</output>
                                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                                            <script>
                                                                $(document).ready(function(){
                                                                    $('#customRange1').on('input', function(){
                                                                        var value = $(this).val();
                                                                        $('#rangeValue').text(value + ' x ' + value + ' ' + "{{__('px')}}");
                                                                    });
                                                                });
                                                            </script>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <button type="submit"  class="btn btn-khardl">{{ __('Add') }}</button>
                                                        </div>
                                                    </div>
                                                    <!--end::Actions-->
                                                </div>
                                                <!--end::Card header-->
                                            </form>
                                        </div>
                                        <!--end::General options-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                            </div>
                        </div>
                        <!--end::Main column-->
                        <!--end::Form-->
                    </div>
                </div>

                <div class="card card-xl-stretch col-lg-5">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bolder text-dark">{{ __('List of your QR codes') }}</h3>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                    {{-- Here to loop thru the rows and add pagination --}}
                    <!--begin::Item-->
                        @foreach ($qrcodes as $qrcode)

                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-vertical h-40px bg-primary"></span>
                                <!--end::Bullet-->
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid mx-5">
                                    <a href="{{ route('restaurant.qr-download', $qrcode->id) }}" class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url('{{route('restaurant.qr-download', $qrcode->id)}}')"></span>
                                    </a>
                                </div>
                                <!--end::Checkbox-->
                                <!--begin::Description-->
                                <div class="flex-grow-1">
                                    <a href="#" class="text-gray-800 text-hover-khardl fw-bolder fs-6">{{ $qrcode->name }}</a>
                                    <span class="fw-bold d-block text-hover-khardl">{{ $qrcode->url }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($qrcodes->onFirstPage())
                                <span>&laquo;</span>
                            @else
                                <a href="{{ $qrcodes->previousPageUrl() }}" rel="prev">&laquo;</a>
                            @endif

                            {{-- Pagination Elements --}}
                            @for ($i = 1; $i <= $qrcodes->lastPage(); $i++)
                                @if ($i == $qrcodes->currentPage())
                                    <span class="current">{{ $i }}</span>
                                @else
                                    <a class="mx-4" href="{{ $qrcodes->url($i) }}">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($qrcodes->hasMorePages())
                                <a href="{{ $qrcodes->nextPageUrl() }}" rel="next">&raquo;</a>
                            @else
                                <span>&raquo;</span>
                            @endif
                        </div>



                        <!--end:Item-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 4-->
            </div>
        </div>
    </div>
    </div>

@endsection
