@extends('layouts.app')
@section('title')
    <title>About | Dashboard</title>
@endsection


@section('content')

    <div class="px-6 py-6" id="contentAboutMe">

        <div id="loader">
            <div class="flex justify-center items-center h-full">Loading..</div>
        </div>

        <div class="w-8/12 flex justify-between">
            <h2 class="text-3xl text-yellow-500">About</h2>
            <div class="flex items-center">

                @if ($about)
                    <button onclick="editAboutMe();"
                        class="px-5 py-1 rounded-md bg-purple-500 text-white duration-300 hover:bg-yellow-800">Edit</button>
                @endif

                {{-- <button class="px-5 py-1 bg-red-500 text-white">Delete</button> --}}
            </div>
        </div>



        <div class="my-6">

            <div class="w-8/12">
                <div class="flex justify-between w-full">
                    <p class="w-2/12">Thumbnail</p>
                    <p class="w-1/12">:</p>
                    <div class="w-9/12">
                        @if ($about->thumbnail != null)
                            <img id="aboutThumbnail" src="" width="150" alt="">
                        @else
                            <img src="https://via.placeholder.com/80x80" alt="">
                        @endif
                    </div>
                </div>

                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Title</p>
                    <p class="w-1/12">:</p>
                    <div class="w-9/12"><strong id="aboutTitle"></strong></div>
                </div>

                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Subtitle</p>
                    <p class="w-1/12">:</p>
                    <div class="w-9/12"><strong id="aboutSubtitle"></strong></div>
                </div>


                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Description</p>
                    <p class="w-1/12">:</p>
                    <div class="w-9/12"><strong id="aboutDescription"></strong></div>
                </div>

                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Signature</p>
                    <p class="w-1/12">:</p>
                    <div class="w-9/12"><strong><img id="aboutSignature" src="" width="80" alt=""></strong></div>
                </div>

                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">CV Link</p>
                    <p class="w-1/12">:</p>
                    <div class="w-9/12">
                        @if ($about->cv_link)
                            <a id="aboutCV"
                                class="border-2 px-5 py-2 bg-yellow-800 text-white rounded-md text-base inline-block"
                                href="" target="_blank">View</a>
                        @endif
                    </div>
                </div>

                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Experience</p>
                    <p class="w-1/12">:</p>
                    <div class="w-9/12"><strong><span id="aboutExpYear"></span>
                            <span id="aboutExpText"></span></strong>
                    </div>
                </div>
            </div>




        </div>

    </div>

@endsection


@section('scripts')

    <script>
        $(document).ready(function() {



            loadData();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

        });

        const apiURL = '{{ url('/api/about') }}';


        function loadData() {
            var thumb = $('#aboutThumbnail');
            var sign = $('#aboutSignature');
            var cv = $('#aboutCV');
            var title = $('#aboutTitle');
            var subtitle = $('#aboutSubtitle');
            var desc = $('#aboutDescription');
            var expYear = $('#aboutExpYear');
            var expText = $('#aboutExpText');



            $.get(apiURL,
                function(data, status, jqXHR) {
                    if (status) {
                        title.html(data.title);
                        subtitle.text(data.subtitle);
                        desc.html(data.description);
                        expYear.text(data.experience_year);
                        expText.text(data.experience_text);

                        thumb.attr('src', data.thumbnail);
                        sign.attr('src', data.signature);
                        cv.attr('href', data.cv_link);
                    }
                },
            ).then((res) => {
                $('#loader').fadeOut();
            });

        }

        // Edit AboutMe
        function editAboutMe() {

            var html = `<div class="editAboutMe">`;
            html += `
                <div class="text-left">
                    <label for="title" class="block text-sm">Title</label>
                    <textarea rows="2" class="border-2 text-sm px-2 py-2 w-full" name="title" id="title">{{ $about->title }}</textarea>
                </div>
            `;
            html += `
                <div class="text-left mt-5">
                    <label for="subtitle" class="block text-sm">Subtitle</label>
                    <input type="text" class="border-2 px-2 py-2 w-full  text-sm" name="subtitle" id="subtitle" value="{{ $about->subtitle }}" />
                </div>
            `;
            html += `
                <div class="text-left mt-5">
                    <label for="description" class="block text-sm">Description</label>
                    <textarea rows="4" class="border-2  text-sm px-2 py-2 w-full" name="description" id="description">{{ $about->description }}</textarea>
                </div>
            `;

            html += `
                <div class="text-left mt-5">
                    <label for="experience_year" class="block text-sm">Experience Text</label>
                    <div class="flex justify-between">
                        <input type="number" class="border-2 px-2 py-2 w-2/12  text-sm" name="experience_year" id="experience_year" value="{{ $about->experience_year }}" />
                    <input type="text" class="border-2 px-2 py-2 w-10/12  text-sm" name="experience_text" id="experience_text" value="{{ $about->experience_text }}" />
                        </div>
                </div>
            `;

            html += `
                <div class="text-left mt-5">
                    <label for="signature" class="block text-sm">Signature</label>
                    <input type="file" class="border-2 px-2 py-2 w-full  text-sm" name="signature" id="signature"/>
                </div>
            `;

            html += `
                <div class="text-left mt-5">
                    <label for="thumbnail" class="block text-sm">Thumbnail</label>
                    <input type="file" class="border-2 px-2 py-2 w-full  text-sm" name="thumbnail" id="thumbnail"/>
                </div>
            `;

            html += `
                <div class="text-left mt-5">
                    <label for="cv_file" class="block text-sm">CV</label>
                    <input type="file" class="border-2 px-2 py-2 w-full  text-sm" name="cv_file" id="cv_file" value="{{ $about->cv_link }}" />
                </div>
            `;


            html += `</div>`;

            Swal.fire({
                title: 'Edit About Me',
                html: html,
                allowOutsideClick: false,
                confirmButtonText: 'Update',
                denyButtonText: 'Cancel',
                showCloseButton: true,
                showLoaderOnConfirm: true,
                showDenyButton: false,
                focusConfirm: false,
                allowEscapeKey: false,
                preConfirm: () => {

                    let title = $("#title").val();
                    let subtitle = $("#subtitle").val();
                    let description = $("#description").val();
                    let exp_year = $("#experience_year").val();
                    let exp_text = $("#experience_text").val();
                    let signature = $("input#signature");
                    let thumb = $("input#thumbnail");
                    let cv = $("input#cv_file");

                    thumb.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    thumb = thumb[0].files[0];

                    cv.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    cv = cv[0].files[0];

                    return {
                        title: title,
                        subtitle: subtitle,
                        description: description,
                        exp_year: exp_year,
                        exp_text: exp_text,
                        signature: signature,
                        thumb: thumb,
                        cv: cv,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    const updateURL = '{{ route('updateAboutMe') }}';

                    var formData = new FormData();

                    formData.append('id', {{ $about->id }});
                    formData.append('title', result.value.title);
                    formData.append('subtitle', result.value.subtitle);
                    formData.append('description', result.value.description);
                    formData.append('exp_year', result.value.exp_year);
                    formData.append('exp_text', result.value.exp_text);
                    formData.append('signature', result.value.signature);
                    formData.append('thumb', result.value.thumb);
                    formData.append('cv', result.value.cv);

                    $.ajax({
                        type: 'POST',
                        url: updateURL,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function(response) {
                            if (response.success) {
                                loadData();
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: 'About Me Updated!',
                                    position: 'top-right',
                                    iconColor: 'white',
                                    customClass: {
                                        popup: 'colored-toast'
                                    },
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,

                                });

                            } else {
                                Swal.fire({
                                    toast: true,
                                    icon: 'error',
                                    title: 'Error',
                                    position: 'top-right',
                                    iconColor: 'white',
                                    customClass: {
                                        popup: 'colored-toast'
                                    },
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,

                                });
                            }
                        }
                    });
                }
            });
        }
    </script>

@endsection
