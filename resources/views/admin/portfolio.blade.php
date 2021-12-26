@extends('layouts.app')
@section('title')
    <title>Portfolio | Dashboard</title>
@endsection
@section('content')

<div id="loader">
    <div class="flex justify-center items-center h-full">Loading..</div>
</div>
    <div class="px-6 py-6">


        <div class="w-8/12 flex justify-between">
            <h2 class="text-3xl text-yellow-500">Portfolio</h2>
            <div class="flex items-center">

                @if ($portfolio)
                    <button onclick="editPortfolio()"
                        class="px-5 py-1 rounded-md bg-purple-500 text-white duration-300 hover:bg-yellow-800">Edit</button>
                @endif

            </div>
        </div>



        <div class="my-6">

            <div class="flex justify-between w-1/2 mt-4">
                <p class="w-2/12">Title</p>
                <p class="w-1/12">:</p>
                <div class="w-9/12"><strong id="portfolioTitle"></strong></div>
            </div>

            <div class="flex justify-between w-1/2 mt-4">
                <p class="w-2/12">Subtitle</p>
                <p class="w-1/12">:</p>
                <div class="w-9/12"><strong id="portfolioSubtitle"></strong></div>
            </div>


            <div class="mb-10"></div>

            <table class="dataTable display border text-left">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        // Document Ready Function
        $(document).ready(function() {
            loadData();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

        });

        // API URL
        const apiURL = '{{ url('api/portfolio') }}';
        var porofolioData;

        // load data
        async function loadData() {
            var title = $('#portfolioTitle');
            var subtitle = $('#portfolioSubtitle');

            $.get(apiURL,
                function(data, status, jqXHR) {
                    data = data.portfolio;
                    porofolioData = data;
                    if (status) {
                        title.html(data.title);
                        subtitle.text(data.subtitle);
                    }

                },
            ).then((res) => {
                $('#loader').fadeOut();
            });

        }


        // Edit Portfolio

        function editPortfolio() {
            var html = `<div class="editPortfolio">`;
            html += `
                    <div class="text-left">
                        <label for="title" class="block text-sm">Title</label>
                        <input class="border-2 text-sm px-2 py-2 w-full" name="title" id="title" value="`+porofolioData.title+`" />
                    </div>
                `;
                            html += `
                    <div class="text-left mt-5">
                        <label for="subtitle" class="block text-sm">Subtitle</label>
                        <input type="text" class="border-2 px-2 py-2 w-full  text-sm" name="subtitle" id="subtitle" value="`+porofolioData.subtitle+`" />
                    </div>
                `;


            html += `</div>`;

            Swal.fire({
                title: 'Edit Portfolio',
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

                    return {
                        title: title,
                        subtitle: subtitle
                    }
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    const updateURL = '{{ route('updatePortfolio') }}';

                    var formData = new FormData();

                    formData.append('id', {{ $portfolio->id }});
                    formData.append('title', result.value.title);
                    formData.append('subtitle', result.value.subtitle);

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
