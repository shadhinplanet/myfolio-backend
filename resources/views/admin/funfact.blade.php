@extends('layouts.app')
@section('title')
    <title>Funfact | Dashboard</title>
@endsection
@section('content')

    <div id="loader">
        <div class="flex justify-center items-center h-full">Loading..</div>
    </div>
    <div class="px-6 py-6">


        <div class="w-8/12 flex justify-between">
            <h2 class="text-3xl text-yellow-500">Funfact</h2>
            <button id="ajaxAddNewKnowledge" class="border-0 bg-purple-800 text-white px-3 py-1 cursor-pointer rounded-md"
                onclick="createNewFunfact()">Add New</button>
        </div>



        <div class="my-6 w-8/12">

            <div class="mb-10"></div>

            <table class="dataTable display border text-left">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Value</th>
                        <th>Icon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="funfactList">



                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        // Document Ready Function
        $(document).ready(function() {
            refreshData();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

        });

        // Get Image Url
        function getStorageUrl(subfolder, image) {
            if (image != '') return '{{ url('/storage/uploads') }}/' + subfolder + '/' + image;
            return '';
        }

        // API URL
        const apiURL = '{{ url('api/funfacts') }}';
        var funfactData;



        // Init Data
        async function refreshData() {
            fetchData().then(serviceData => {
                loadData();
            });
        }
        // Fetch API
        async function fetchData() {
            const response = await fetch(apiURL);
            const data = await response.json();
            funfactData = data;
            return data;
        }

        // load data
        async function loadData() {

            $.get(apiURL,
                function(data, status, jqXHR) {
                    data = data.funfacts;
                    funfactData = data;

                    var html = '';
                    $.each(funfactData, function(index, item) {
                        html += '<tr>';
                        html += '<td>';
                        html += item.title;
                        html += '</td>';
                        html += '<td>';
                        html += item.value + item.suffix;
                        html += '</td>';
                        html += '<td>';
                        html += '<img src="' + getStorageUrl('funfacts', item.icon) + '" width="50"/>';
                        html += '</td>';
                        html += '<td>';
                        html += '<button onclick="updateFunfact(' + index +
                            ')" class="px-5 cursor-pointer py-1 bg-blue-500 text-white">Edit</button>';
                        html +=
                            '<button type="submit" onclick="deleteFunfact(' + index +
                            ')" class="px-5 py-1 cursor-pointer bg-red-500 text-white">Delete</button>';
                        html += '</td>';
                        html += '</tr>';
                    });
                    $('#funfactList').html(html);

                },
            ).then((res) => {
                $('#loader').fadeOut();
            });

        }

        // Create New Funfacts
        function createNewFunfact() {

            var html = `<div class="createNewFunfact">`;
            html +=
                `
    <div class="text-left">
        <label for="fun_title" class="block text-sm">Title</label>
        <input type="text" class="border-2 text-sm px-2 py-2 w-full" name="fun_title" id="fun_title"></input>
    </div>
`;
            html +=
                `
    <div class="flex">
    <div class="text-left mt-5 flex-1">
        <label for="fun_value" class="block text-sm">Value</label>
        <input type="number" min="0" class="border-2 px-2 py-2 w-full  text-sm" name="fun_value" id="fun_value" value="100" />
    </div>
    <div class="text-left mt-5 ml-5 flex-1">
        <label for="fun_suffix" class="block text-sm">Suffix</label>
        <select class="border-2 text-sm w-full h-auto py-3 px-2" name="fun_suffix" id="fun_suffix">
            <option>Select Suffix</option>
            <option value="+">+</option>
            <option value="%">%</option>
        </select>

    </div>
    </div>
`;
            html += `
    <div class="text-left">
        <label for="fun_icon" class="block text-sm">Icon</label>
        <input type="file" class="border-2 text-sm px-2 py-2 w-full" name="fun_icon" id="fun_icon"></input>
    </div>
`;

            html += `</div>`;

            Swal.fire({
                title: 'Add New Funfact',
                html: html,
                allowOutsideClick: false,
                confirmButtonText: 'Create',
                denyButtonText: 'Cancel',
                showCloseButton: true,
                showLoaderOnConfirm: true,
                showDenyButton: false,
                focusConfirm: false,
                allowEscapeKey: false,
                preConfirm: () => {

                    let title = $("#fun_title").val();
                    let value = $("#fun_value").val();
                    let suffix = $("#fun_suffix").val();
                    let icon = $("#fun_icon");

                    icon.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    icon = icon[0].files[0];


                    return {
                        title: title,
                        value: value,
                        suffix: suffix,
                        icon: icon,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    const createURL = '{{ route('createFunfact') }}';


                    var icon = result.value.icon;
                    var formData = new FormData();

                    formData.append('title', result.value.title);
                    formData.append('value', result.value.value);
                    formData.append('suffix', result.value.suffix);

                    if (icon != '') {
                        formData.append('icon', icon);
                    }

                    $.ajax({
                        type: 'POST',
                        url: createURL,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function(response) {
                            if (response.success) {
                                refreshData();
                                successToast(response.message);
                            } else {
                                errorToast(response.message);
                            }
                        }
                    });
                }
            });
        }


        // Edit Funfact
        function updateFunfact(index) {
            var funfact = funfactData[index];
            const updateURL = '{{ route('updateFunfact') }}';

            var preview_image = getStorageUrl('funfacts', (funfact.icon));

            var html = `<div class="updateFunfact">`;
            html +=
                `
    <div class="text-left">
        <label for="up_fun_title" class="block text-sm">Title</label>
        <input type="text" class="border-2 text-sm px-2 py-2 w-full" name="up_fun_title" id="up_fun_title" value="` +
                funfact.title + `"></input>
    </div>
`;
            var current = '';
            var currentP = '';
            if (funfact.suffix == "+") {
                current = 'selected'
            }
            if (funfact.suffix == "%") {
                currentP = 'selected'
            }

            html +=
                `
    <div class="flex">
    <div class="text-left mt-5 flex-1">
        <label for="up_fun_value" class="block text-sm">Value</label>
        <input type="number" min="0" class="border-2 px-2 py-2 w-full  text-sm" name="up_fun_value" id="up_fun_value" value="` +
                funfact.value + `" />
    </div>
    <div class="text-left mt-5 ml-5 flex-1">
        <label for="up_fun_suffix" class="block text-sm">Suffix</label>
        <select class="border-2 text-sm w-full h-auto py-3 px-2" name="up_fun_suffix" id="up_fun_suffix">
            <option>Select Suffix</option>
            <option value="+" ` + current + `>+</option>
            <option value="%" ` + currentP + `>%</option>
        </select>

    </div>
    </div>
`;
            html += `
<div class="flex justify-between items-center mt-4">
    <div class="text-left">
        <label for="up_fun_icon" class="block text-sm">Icon</label>
        <input type="file" class="border-2 text-sm px-2 py-2 w-full" name="up_fun_icon" id="up_fun_icon"></input>
    </div>
    <div class="text-left">
        <label for="up_fun_icon" class="block text-sm">Current Icon</label>
        <img id="preview_image" src="` + preview_image + `" width="40" heigth="40" class="border-2 p-2">
    </div>

</div>
`;


            html += `</div>`;

            Swal.fire({
                title: 'Edit Funfact',
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

                    let title = $("#up_fun_title").val();
                    let value = $("#up_fun_value").val();
                    let suffix = $("#up_fun_suffix").val();
                    let icon = $("#up_fun_icon");

                    icon.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    icon = icon[0].files[0];


                    return {
                        title: title,
                        value: value,
                        suffix: suffix,
                        icon: icon,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    var icon = result.value.icon;
                    var formData = new FormData();

                    formData.append('id', funfact.id);
                    formData.append('title', result.value.title);
                    formData.append('value', result.value.value);
                    formData.append('suffix', result.value.suffix);

                    if (icon != '') {
                        formData.append('icon', icon);
                    }

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
                                refreshData();
                                successToast(response.message);
                            } else {
                                errorToast(response.message);
                            }
                        }
                    });
                }
            });
        }

        // Delete Service
        function deleteFunfact(index) {
            var funfact = funfactData[index];


            const deleteURL = '{{ route('deleteFunfact') }}';

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    var formData = new FormData();

                    formData.append('id', funfact.id);

                    $.ajax({
                        type: 'POST',
                        url: deleteURL,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function(response) {
                            if (response.success) {
                                refreshData();
                                successToast(response.message);
                            } else {
                                errorToast(response.message);
                            }
                        }
                    });
                }
            });

        }


        // Error Toast
        function errorToast(message) {
            Swal.fire({
                toast: true,
                icon: 'error',
                title: message,
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
        // Seccess Toast
        function successToast(message) {
            Swal.fire({
                toast: true,
                icon: 'success',
                title: message,
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
    </script>

@endsection
