@extends('layouts.app')
@section('title')
<title>Categories | Dashboard</title>
@endsection
@section('content')

{{-- <div id="loader">
    <div class="flex justify-center items-center h-full">Loading..</div>
</div> --}}
<div class="px-6 py-6">


    <div class="w-8/12 flex justify-between">
        <h2 class="text-3xl text-yellow-500">Categories</h2>
        <button id="ajaxAddNewKnowledge" class="border-0 bg-purple-800 text-white px-3 py-1 cursor-pointer rounded-md" onclick="createNewFunfact()">Add New</button>
    </div>



    <div class="my-6 w-8/12">

        <div class="mb-10"></div>

        <table class="dataTable display border text-left">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Portfolios</th>
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

</script>

@endsection
