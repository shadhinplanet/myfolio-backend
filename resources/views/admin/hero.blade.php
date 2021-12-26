@extends('layouts.app')
@section('title')
    <title>Hero | Dashboard</title>
@endsection
@section('content')

    <div class="px-6 py-6">

        <div id="loader">
            <div class="flex justify-center items-center h-full">Loading..</div>
        </div>

        <div class="w-1/2 flex justify-between">
            <h2 class="text-3xl text-yellow-500">Hero</h2>
            <div class="flex items-center">

                @if ($hero)
                    <button onclick="editHero()"
                        class="px-5 py-1 rounded-md bg-purple-500 text-white duration-300 hover:bg-yellow-800">Edit</button>
                @endif
            </div>
        </div>



        <div class="my-6">

            <div class="flex justify-between w-1/2">
                <p class="w-2/12">Thumbnail</p>
                <p class="w-1/12">:</p>
                <div class="w-9/12">
                    @if ($hero->image != null)
                        <img id="heroThumbnail" src="" width="150" alt="{{ $hero->title }}">
                    @else
                        <img src="https://via.placeholder.com/80x80" alt="">
                    @endif
                </div>
            </div>

            <div class="flex justify-between w-1/2 mt-4">
                <p class="w-2/12">Title</p>
                <p class="w-1/12">:</p>
                <div class="w-9/12"><strong id="heroTitle"></strong></div>
            </div>

            <div class="flex justify-between w-1/2 mt-4">
                <p class="w-2/12">Subtitle</p>
                <p class="w-1/12">:</p>
                <div class="w-9/12"><strong id="heroSubtitle"></strong></div>
            </div>

            <div class="flex justify-between w-1/2 mt-4">
                <p class="w-2/12">Experties</p>
                <p class="w-1/12">:</p>

                <ul class="w-9/12" id="experties"></ul>

            </div>



            <div class="justify-between w-1/2 mt-4">
                <div class="border-2 p-4 mr-2">
                    <div class="flex justify-between mb-4">
                        <h2 class="font-bold w-2/12 inline-block">Knowledges</h2>
                        <button id="ajaxAddNewKnowledge"
                            class="border-0 bg-purple-800 text-white px-3 py-1 cursor-pointer rounded-md"
                            onclick="createKnowledgePopup()">Add New</button>
                    </div>
                    <table class="dataTable cell-border border text-left">
                        <thead>
                            <tr class="flex justify-between">
                                <th class="flex-1">Name</th>
                                <th class="flex-1">Image</th>
                                <th class="flex-1">Action</th>
                            </tr>
                        </thead>
                        <tbody id="knowledge_list">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <div id="create-knowledge" class="white-popup mfp-hide">
        <h1 class="text-center font-black text-lg" id="titleKnowledge"></h1>
        <form method="POST" enctype="multipart/form-data" id="CreateButton" action="javascript:void(0)">

            <div class="mt-4 flex justify-between">
                <label for="name" class="inputLabel w-2/12">{{ __('Name') }}</label>
                <input type="text" id="name" name='name' class="inputField w-10/12">
            </div>

            <div class="mt-4 flex justify-between">
                <label for="name" class="text-sm text-gray-600 mb-1 w-2/12">{{ __('Image') }}</label>
                <input type="file" id="image" name="image" class="border border-blue-500 px-3 py-1 w-9/12"
                    onchange="readURL(this);">
                <div class="w-14 ml-5 border-2 flex justify-center items-center text-center" id="iconImage">
                    <img id="thumbnail" src="" width="40">
                </div>
            </div>

            <div class="mt-4 flex justify-end ">
                <button type="submit"
                    class="formSubmitBtn px-3 py-1 rounded-md bg-purple-500 duration-300 hover:bg-yellow-800 inline-block text-white">Create</button>
            </div>
        </form>

    </div>

@endsection


@section('scripts')
    <script>
        // Document Ready Function
        $(document).ready(function() {
            loadData();
            getKnowledge();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

        });

        // API URL
        const apiURL = '{{ url('api/heros') }}';
        var heroData;
        // load data
        function loadData() {
            var thumb = $('#heroThumbnail');
            var title = $('#heroTitle');
            var subtitle = $('#heroSubtitle');
            var experties = $('#experties');



            $.get(apiURL,
                function(data, status, jqXHR) {
                    heroData = data;
                    if (status) {
                        title.html(data.title);
                        subtitle.text(data.subtitle);


                        thumb.attr('src', data.image);

                        var text = '';
                        $.each(data.experties, function(index, item) {
                            text += '<li class="text-sm list-disc list-inside">' + item + '</li>';
                        });
                        experties.html(text);


                    }
                },
            ).then((res) => {
                $('#loader').fadeOut();
            });

        }

        // Get Image Url
        function getStorageUrl(subfolder, image) {
            if (image != '') return '{{ url('/storage/uploads') }}/' + subfolder + '/' + image;
            return '';
        }

        // Reset Form
        function resetInput() {

            $("#thumbnail").attr("src", '');
            $('#create-knowledge').find(':input').each(function() {
                $(this).val('');
            });
        }


        // ReadimageUrl
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#thumbnail").attr("src", e.target.result);
                    console.log(e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Get knowledges List
        function getKnowledge() {
            var data;
            $.get(apiURL, function(response) {
                $.each(response.knowledges, function(index, item) {
                    var name = item.name;
                    var image = item.image;
                    var id = item.id;
                    data += '<tr class="flex justify-between">';

                    data += '<td class="flex-1">';
                    data += name;
                    data += '</td>';

                    data += '<td class="flex-1">';
                    data += '<img src="' + getStorageUrl("hero", (image)) + '" width="30" alt="' + name +
                        '">';
                    data += '</td>';

                    data += '<td class="flex items-center flex-1 justify-start">';
                    data += '<button onclick="editKnowledge(' + index +
                        ')" class="px-5 cursor-pointer py-1 bg-blue-500 text-white">Edit</button>';
                    data +=
                        '<button type="submit" onclick="destroyKnowledge(' + item.id + ')" data-values="[' +
                        item.id + ',' + name + ']" class="deleteKnowledge-' + item.id +
                        ' px-5 py-1 cursor-pointer bg-red-500 text-white">Delete</button>';
                    data += '</td>';

                    data += '</tr>';
                });

                $('#knowledge_list').html(data);
            });
        }

        // Add New Knowledge
        function createKnowledgePopup() {

            let html = `
                <input type="text" id="k_name" name="name" class="w-full border-2 px-3 py-2 rounded-md">
               <div class="flex justify-between items-center mt-4">
                <input type="file" id="k_image" name="image" class="border-2  w-f px-3 py-2 rounded-md w-10/12">
                <img id="preview_image" src="" width="40" heigth="40" class="border-2 p-2">
                </div>
                `;

            Swal.fire({
                title: 'Add New Knowledge',
                html: html,
                allowOutsideClick: false,
                confirmButtonText: 'Create',
                denyButtonText: 'Cancel',
                showCloseButton: true,
                showLoaderOnConfirm: true,
                showDenyButton: true,
                focusConfirm: false,
                allowEscapeKey: false,
                preConfirm: () => {

                    let fileInput = $("input#k_image");
                    let nameInput = $("input#k_name");

                    fileInput.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    var file = fileInput[0].files[0];

                    return {
                        name: nameInput.val(),
                        image: file
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.update();
                    if (result.value.name == '') {

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
                    } else {
                        var name = result.value.name;
                        var image = result.value.image;


                        const createURL = "{{ route('addKnowledge') }}";

                        var formData = new FormData();

                        formData.append('name', name);
                        if (image != '') {
                            formData.append('image', image);
                        }

                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: createURL,
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function(res) {

                                if (res.success) {
                                    Swal.fire({
                                        toast: true,
                                        icon: 'success',
                                        title: 'Knowledge Updated',
                                        position: 'top-right',
                                        iconColor: 'white',
                                        customClass: {
                                            popup: 'colored-toast'
                                        },
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,

                                    });
                                    getKnowledge();

                                } else if (res.error) {
                                    Swal.fire({
                                        toast: true,
                                        icon: 'error',
                                        title: res.message,
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
                            },
                            error: function(e) {
                                console.log("ERROR : ", e);
                            }
                        });
                    }
                } else if (result.isDenied) {

                }

            });

            // resetInput();
            // openPopup();

            // let title = $('#titleKnowledge');
            // title.text("Add New Knowledge");

            // $('#create-knowledge form').attr('id', 'CreateForm');
            // $('#create-knowledge button[type="submit"].formSubmitBtn').text("Create").attr('onclick', 'createKnowledge()')
            //     .removeAttr('value');

        }




        function destroyKnowledge(k_id) {

            var values = $(".deleteKnowledge-" + k_id).data('values');
            let result = values.replace('[', '');
            result = result.replace(']', '');

            let valueArray = result.split(",");

            const id = valueArray[0];
            const name = valueArray[1]
            const url = '{{ route('deleteKnowledge') }}';


            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: false,

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res.data) {
                                Swal.fire({
                                    toast: true,
                                    icon: 'info',
                                    title: 'Knowledge Deleted',
                                    position: 'top-right',
                                    iconColor: 'white',
                                    customClass: {
                                        popup: 'colored-toast'
                                    },
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,

                                });
                                getKnowledge();
                            }
                        }
                    });

                }
            });

        }

        // Edit Popup
        function editKnowledge(index) {

            $.get(apiURL, function(response) {
                var data = response.knowledges[index];
                var preview_image = getStorageUrl('hero', (data.image));

                let html = `
                <input type="text" id="k_name" name="name" class="w-full border-2 px-3 py-2 rounded-md" value="` + data
                    .name +
                    `">
               <div class="flex justify-between items-center mt-4">
                <input type="file" id="k_image" name="image" class="border-2  w-f px-3 py-2 rounded-md w-10/12" onchange="readURL(` +
                    this + `)">
                <img id="preview_image" src="` + preview_image + `" width="40" heigth="40" class="border-2 p-2">
                </div>
                `;



                Swal.fire({
                    title: 'Update Knowledge',
                    html: html,
                    allowOutsideClick: false,
                    confirmButtonText: 'Update',
                    denyButtonText: 'Cancel',
                    showCloseButton: true,
                    showLoaderOnConfirm: true,
                    showDenyButton: true,
                    focusConfirm: false,
                    allowEscapeKey: false,
                    preConfirm: () => {

                        let fileInput = $("input#k_image");
                        let nameInput = $("input#k_name");

                        fileInput.change(function() {
                            var reader = new FileReader();
                            reader.readAsDataURL(this.files[0]);
                        });
                        var file = fileInput[0].files[0];

                        return {
                            name: nameInput.val(),
                            image: file
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value.name == '') {
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
                        } else {
                            var name = result.value.name;
                            var image = result.value.image;


                            const updateURL = "{{ route('editKnowledge') }}";

                            var formData = new FormData();

                            formData.append('id', data.id);
                            formData.append('name', name);
                            if (image != '') {
                                formData.append('image', image);
                            }

                            $.ajax({
                                type: "POST",
                                enctype: 'multipart/form-data',
                                url: updateURL,
                                data: formData,
                                processData: false,
                                contentType: false,
                                cache: false,
                                timeout: 600000,
                                success: function(res) {
                                    if (res.success) {
                                        Swal.fire({
                                            toast: true,
                                            icon: 'success',
                                            title: 'Knowledge Updated',
                                            position: 'top-right',
                                            iconColor: 'white',
                                            customClass: {
                                                popup: 'colored-toast'
                                            },
                                            showConfirmButton: false,
                                            timer: 1500,
                                            timerProgressBar: true,

                                        });
                                        getKnowledge();

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
                                },
                                error: function(e) {
                                    console.log("ERROR : ", e);
                                }
                            });
                        }
                    } else if (result.isDenied) {

                    }




                });





            }); // $.get


        }

        // Edit Hero
        function editHero() {

            var html = `<div class="editHero">`;
            html += `
    <div class="text-left">
        <label for="title" class="block text-sm">Title</label>
        <input class="border-2 text-sm px-2 py-2 w-full" name="title" id="title" value="` + heroData.title + `" />
    </div>
`;
            html += `
    <div class="text-left mt-5">
        <label for="subtitle" class="block text-sm">Subtitle</label>
        <input type="text" class="border-2 px-2 py-2 w-full  text-sm" name="subtitle" id="subtitle" value="` + heroData
                .subtitle + `" />
    </div>
`;
            html += `
    <div class="text-left mt-5">
        <label for="heroExperties" class="block text-sm">Experties</label>
        <textarea type="text" class="border-2 px-2 py-2 w-full text-sm" name="heroExperties" id="heroExperties">` +
                heroData.experties + `</textarea>
    </div>
`;
            html += `
    <div class="text-left mt-5">
        <label for="thumbnail" class="block text-sm">Thumbnail</label>
        <input type="file" class="border-2 px-2 py-2 w-full  text-sm" name="thumbnail" id="thumbnail"/>
    </div>
`;



            html += `</div>`;

            Swal.fire({
                title: 'Edit Hero',
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
                    let experties = $("#heroExperties").val();
                    let thumb = $("input#thumbnail");

                    thumb.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    thumb = thumb[0].files[0];


                    return {
                        title: title,
                        subtitle: subtitle,
                        experties: experties,
                        thumb: thumb,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    const updateURL = '{{ route('updateHero') }}';

                    var formData = new FormData();

                    formData.append('id', {{ $hero->id }});
                    formData.append('title', result.value.title);
                    formData.append('subtitle', result.value.subtitle);
                    formData.append('experties', result.value.experties);
                    formData.append('thumbnail', result.value.thumb);

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
                                    title: response.message,
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
