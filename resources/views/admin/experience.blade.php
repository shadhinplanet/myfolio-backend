@extends('layouts.app')
@section('title')
    <title>Experiences | Dashboard</title>
@endsection
@section('content')


    <div class="px-6 py-6" id="contentAboutMe">
        <div id="loader">
            <div class="flex justify-center items-center h-full">Loading..</div>
        </div>

        <div class="w-8/12 flex justify-between">
            <h2 class="text-3xl text-yellow-500">Experiences</h2>
            <div class="flex items-center">

                @if ($experience)
                    <button onclick="editExperiencePage()"
                        class="px-5 py-1 rounded-md bg-purple-500 text-white duration-300 hover:bg-yellow-800"">Edit</button>

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
                @if (count($experienceList) > 0)
                    <div class="w-full flex flex-col justify-between">
                        <div class="border-2 p-4 mr-2">
                            <div class="flex justify-between mb-4">
                                <h2 class="font-bold w-2/12 inline-block">My Experiences</h2>
                                <button onclick="addSkill()"
                                    class="border-0 bg-purple-800 text-white px-3 py-1 rounded-md">Add New</button>
                            </div>
                            <table class="dataTable cell-border border text-left">
                                <thead>
                                    <tr class="flex justify-between text-sm">
                                        <th class="flex-1">Title</th>
                                        <th class="flex-1">Company Name</th>
                                        <th class="flex-1">Company Tag</th>
                                        <th class="w-4/12">Description</th>
                                        <th class="flex-1">Duration</th>
                                        <th class="flex-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="experienceList">


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
        const apiURL = '{{ url('/api/experiences') }}';
        var experieneData;

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
                loadData();
                loadExperience();
            });
        }

        // Fetch API
        async function fetchData() {
            const response = await fetch(apiURL);
            const data = await response.json();
            experieneData = data;
            return data;
        }

        // Load Data
        function loadData() {

            var title = $('#title');
            var subtitle = $('#subtitle');
            var desc = $('#description');
            var exp_section = experieneData.experience
            title.html(exp_section.title);
            subtitle.text(exp_section.subtitle);
            desc.html(exp_section.description);

            $('#loader').fadeOut();

        }

        // Load Data
        function loadExperience() {
            var data = '';
            $.each(experieneData.experienceList, function(index, item) {
                data += '<tr class="flex justify-between text-sm">';

                data += '<td class="flex-1">';
                data += item.title;
                data += '</td>';

                data += '<td class="flex-1">';
                data += item.company_name;
                data += '</td>';

                data += '<td class="flex-1">';
                data += item.company_tag;
                data += '</td>';

                data += '<td class="w-4/12">';
                data += item.description;
                data += '</td>';

                data += '<td class="flex-1">';
                data += item.start_date + ' - ' + item.end_date;
                data += '</td>';

                data += '<td class="flex-1 flex items-center">';
                data += '<button onclick="updateFunfact(' + index +
                    ')" class="px-5 cursor-pointer py-1 bg-blue-500 text-white">Edit</button>';
                data += '<button type="submit" onclick="deleteFunfact(' + index +
                    ')" class="px-5 py-1 cursor-pointer bg-red-500 text-white">Delete</button>';
                data += '</td>';

                data += '</tr>';
            });

            $('#experienceList').html(data);

        }
    </script>




@endsection
