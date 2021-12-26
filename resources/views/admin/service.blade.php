@extends('layouts.app')
@section('title')
    <title>Services | Dashboard</title>
@endsection
@section('content')


    <div class="px-6 py-6" id="contentAboutMe">
        <div id="loader">
            <div class="flex justify-center items-center h-full">Loading..</div>
        </div>

        <div class="w-8/12 flex justify-between">
            <h2 class="text-3xl text-yellow-500">Services</h2>
            <div class="flex items-center">

                @if ($service)
                    <button onclick="editServicePage()"
                        class="px-5 py-1 rounded-md bg-purple-500 text-white duration-300 hover:bg-yellow-800"">Edit</button>
                @else
                            <a class="  px-5 py-1 rounded-md bg-purple-500 text-white duration-300 hover:bg-yellow-800"
                        href="{{ route('service.create', $service) }}">Add New</a>
                @endif

            </div>
        </div>



        <div class="my-6">

            <div class="w-8/12">
                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Title</p>
                    <p class="w-1/12">:</p>
                    <p class="w-9/12"><strong id="title"></strong></p>
                </div>

                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Subtitle</p>
                    <p class="w-1/12">:</p>
                    <p class="w-9/12"><strong id="subtitle"></strong></p>
                </div>


                <div class="flex justify-between w-full mt-4">
                    <p class="w-2/12">Description</p>
                    <p class="w-1/12">:</p>
                    <p class="w-9/12"><strong id="description"></strong></p>
                </div>
            </div>


            <div class="flex justify-between mt-10">
                {{-- Skills --}}
                @if (count($skills) > 0)
                    <div class="w-full flex flex-col justify-between">
                        <div class="border-2 p-4 mr-2">
                            <div class="flex justify-between mb-4">
                                <h2 class="font-bold w-2/12 inline-block">Skills</h2>
                                <button onclick="addSkill()"
                                    class="border-0 bg-purple-800 text-white px-3 py-1 rounded-md">Add New</button>
                            </div>
                            <table class="dataTable cell-border border text-left">
                                <thead>
                                    <tr class="flex justify-between">
                                        <th class="flex-1">Name</th>
                                        <th class="flex-1">Value</th>
                                        <th class="flex-1">Color</th>
                                        <th class="flex-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="skillList">


                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{-- Services --}}
                @if (count($services) > 0)

                    <div class="w-full flex flex-col justify-between">
                        <div class="ml-2 border-2 p-4">
                            <div class="flex justify-between mb-4">
                                <h2 class="font-bold w-2/12 inline-block">Services</h2>
                                <button onclick="addServiceItem()"
                                    class="border-0 bg-purple-800 text-white px-3 py-1 rounded-md">Add New</button>
                            </div>

                            <table class="dataTable cell-border border text-left">
                                <thead>
                                    <tr class="flex justify-between">
                                        <th class="flex-1">Name</th>
                                        <th class="flex-1">Icon</th>
                                        <th class="flex-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="serviceList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        const apiURL = '{{ url('/api/service') }}';
        var serviceData;

        // Document Ready Function
        $(document).ready(function() {
            // refresh data
            refreshData();

            //Ajax Init
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        });

        // Init Data
        async function refreshData() {
            fetchData().then(serviceData => {
                loadService();
                loadSkills();
                loadServices();
            });
        }

        // Fetch API
        async function fetchData() {
            const response = await fetch(apiURL);
            const data = await response.json();
            serviceData = data;
            return data;
        }

        // Load Service Data
        function loadService() {
            var title = $('#title');
            var subtitle = $('#subtitle');
            var desc = $('#description');

            title.html(serviceData.title);
            subtitle.text(serviceData.subtitle);
            desc.html(serviceData.description);

            $('#loader').fadeOut();

        }

        // Edit Service Page
        function editServicePage() {
            var html = `<div class="editServicePage">`;
            html += `
                <div class="text-left">
                    <label for="service_title" class="block text-sm">Title</label>
                    <input type="text" class="border-2 text-sm px-2 py-2 w-full" name="service_title" id="service_title" value="{{ $service->title }}"></input>
                </div>
            `;
            html += `
                <div class="text-left mt-5">
                    <label for="service_subtitle" class="block text-sm">Subtitle</label>
                    <input type="text" class="border-2 px-2 py-2 w-full  text-sm" name="service_subtitle" id="service_subtitle" value="{{ $service->subtitle }}" />
                </div>
            `;
            html += `
                <div class="text-left mt-5">
                    <label for="service_description" class="block text-sm">Description</label>
                    <textarea rows="4" class="border-2  text-sm px-2 py-2 w-full" name="service_description" id="service_description">{{ $service->description }}</textarea>
                </div>
            `;


            html += `</div>`;

            Swal.fire({
                title: 'Edit Service Page',
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

                    let title = $("#service_title").val();
                    let subtitle = $("#service_subtitle").val();
                    let description = $("#service_description").val();
                    return {
                        title: title,
                        subtitle: subtitle,
                        description: description,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    const updateURL = '{{ route('updateServicePage') }}';

                    var formData = new FormData();

                    formData.append('id', {{ $service->id }});
                    formData.append('title', result.value.title);
                    formData.append('subtitle', result.value.subtitle);
                    formData.append('description', result.value.description);

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
                                    title: 'Service Page Updated!',
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

        // Load Skills
        function loadSkills() {
            var skills_body = $('#skillList');

            var html = '';

            $.each(serviceData.skills, function(i, item) {
                html += '<tr class="flex justify-between text-sm">';
                html += '<td class="flex-1">' + item.name + '</td>'
                html += '<td class="flex-1">' + item.value + '%</td>';
                html += ' <td class="flex-1"><div class="px-5 py-2 w-5" style="background-color:' + item.color +
                    ' "></div></td>';
                html += '<td class="flex items-center flex-1 justify-start">';
                html += '<button class="px-5 py-1 bg-blue-500 text-white" onclick="editSkill(' + i +
                    ')">Edit</button>';
                html += '<button type="submit" class="px-5 py-1 bg-red-500 text-white" onclick="deleteSkill(' + i +
                    ')">Delete</button>';
                html += '</td>';
                html += '</tr>';
            });
            skills_body.html(html);
        }

        // Add New Skill
        function addSkill() {

            var html = `<div class="addSkill">`;
            html +=
                `
                <div class="text-left">
                    <label for="skill_name" class="block text-sm">Name</label>
                    <input type="text" class="border-2 text-sm px-2 py-2 w-full" name="skill_name" id="skill_name"></input>
                </div>
            `;
            html +=
                `
                <div class="flex">
                <div class="text-left mt-5">
                    <label for="skill_value" class="block text-sm">Value</label>
                    <input type="number" min="0" step="5" max="100" class="border-2 px-2 py-2 w-full  text-sm" name="skill_value" id="skill_value" value="50" />
                </div>
                <div class="text-left mt-5 ml-5">
                    <label for="skill_color" class="block text-sm">Color</label>
                    <input type="color" class="border-2 w-10 h-10 text-sm" name="skill_color" id="skill_color" value="#cf7020"/>
                </div>
                </div>
            `;


            html += `</div>`;

            Swal.fire({
                title: 'Add New Skill',
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

                    let name = $("#skill_name").val();
                    let val = $("#skill_value").val();
                    let color = $("#skill_color").val();

                    return {
                        name: name,
                        value: val,
                        color: color,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    const createURL = '{{ route('createSkill') }}';

                    var formData = new FormData();

                    formData.append('name', result.value.name);
                    formData.append('value', result.value.value);
                    formData.append('color', result.value.color);

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

        // Edit Skill
        function editSkill(index) {
            var skill = serviceData.skills[index];
            var html = `<div class="editSkill">`;
            html +=
                `
                <div class="text-left">
                    <label for="skill_name" class="block text-sm">Name</label>
                    <input type="text" class="border-2 text-sm px-2 py-2 w-full" name="skill_name" id="skill_name" value="` +
                skill.name + `"></input>
                </div>
            `;
            html +=
                `
                <div class="flex">
                <div class="text-left mt-5">
                    <label for="skill_value" class="block text-sm">Value</label>
                    <input type="number" min="0" step="5" max="100" class="border-2 px-2 py-2 w-full  text-sm" name="skill_value" id="skill_value" value="` +
                skill.value +
                `" />
                </div>
                <div class="text-left mt-5 ml-5">
                    <label for="skill_color" class="block text-sm">Color</label>
                    <input type="color" class="border-2 w-10 h-10 text-sm" name="skill_color" id="skill_color" value="` +
                skill
                .color + `" />
                </div>
                </div>
            `;


            html += `</div>`;

            Swal.fire({
                title: 'Edit Skill',
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

                    let name = $("#skill_name").val();
                    let val = $("#skill_value").val();
                    let color = $("#skill_color").val();

                    return {
                        name: name,
                        value: val,
                        color: color,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    const updateURL = '{{ route('updateSkill') }}';

                    var formData = new FormData();

                    formData.append('id', skill.id);
                    formData.append('name', result.value.name);
                    formData.append('value', result.value.value);
                    formData.append('color', result.value.color);

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

        // Delete Skill
        function deleteSkill(index) {
            var skill = serviceData.skills[index];
            const deleteURL = '{{ route('deleteSkill') }}';

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

                    formData.append('id', skill.id);

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

        // Get Image Url
        function getStorageUrl(subfolder, image) {
            if (image != '') return '{{ url('/storage/uploads') }}/' + subfolder + '/' + image;
            return '';
        }

        // Load Services
        function loadServices(){
            var serviceList = $('#serviceList');
            var services = serviceData.services;
            var html = '';
            $.each(services, function (i, item) {
                html += '<tr class="flex justify-between text-sm">';
                html += '<td class="flex-1">' + item.name + '</td>'
                html += '<td class="flex-1"><img src="{{ url("/storage/uploads/services") }}/'+item.icon+'" width="30" alt="'+item.name+'"></td>';
                html += '<td class="flex items-center flex-1 justify-start">';
                html += '<button class="px-5 py-1 bg-blue-500 text-white" onclick="editService(' + i +')">Edit</button>';
                html += '<button type="submit" class="px-5 py-1 bg-red-500 text-white" onclick="deleteService(' + i +
                    ')">Delete</button>';
                html += '</td>';
                html += '</tr>';
            });
            serviceList.html(html);
        }

        // Add New Service Item
        function addServiceItem() {

            var html = `<div class="addServiceItem">`;
            html +=
                `
                <div class="text-left">
                    <label for="service_item_name" class="block text-sm">Name</label>
                    <input type="text" class="border-2 text-sm px-2 py-2 w-full" name="service_item_name" id="service_item_name"></input>
                </div>
            `;
            html +=
                `
                <div class="text-left mt-5">
                    <label for="service_item_icon" class="block text-sm">Icon</label>
                    <input type="file" class="border-2 px-2 py-2 w-full  text-sm" name="service_item_icon" id="service_item_icon" />
                </div>
            `;


            html += `</div>`;

            Swal.fire({
                title: 'Add New Service',
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

                    let name = $("#service_item_name").val();
                    let icon = $("#service_item_icon");

                    icon.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    icon = icon[0].files[0];

                    return {
                        name: name,
                        icon: icon,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {


                    const createURL = '{{ route('createNewService') }}';

                    var formData = new FormData();

                    formData.append('name', result.value.name);

                    var icon = result.value.icon;

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

         // Edit Skill
         function editService(index) {
            var service = serviceData.services[index];
            const updateURL = '{{ route('updateService') }}';

            var preview_image = getStorageUrl('services', (service.icon));

            var html = `<div class="editService">`;
                html += `
                <input type="text" id="service_name" name="service_name" class="w-full border-2 px-3 py-2 rounded-md" value="` + service.name +`">
                <div class="flex justify-between items-center mt-4">
                <input type="file" id="service_icon" name="service_icon" class="border-2  w-f px-3 py-2 rounded-md w-10/12" onchange="readURL(` +
                    this + `)">
                <img id="preview_image" src="` + preview_image + `" width="40" heigth="40" class="border-2 p-2">
                </div>
                `;


            html += `</div>`;

            Swal.fire({
                title: 'Edit Service',
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

                    let name = $("#service_name").val();
                    let icon = $("#service_icon");

                    icon.change(function() {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                    icon = icon[0].files[0];

                    return {
                        name: name,
                        icon: icon,
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    var formData = new FormData();

                    formData.append('id', service.id);
                    formData.append('name', result.value.name);

                    var icon = result.value.icon;

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
         function deleteService(index) {
            var service = serviceData.services[index];
            const deleteURL = '{{ route('deleteService') }}';

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

                    formData.append('id', service.id);

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
