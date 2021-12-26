(function ($) {
    "use strict";

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });


        // Add Category
        $("#addCategoryAjax").on("click", function (e) {
            e.preventDefault();

            let name = $('input[name="category_name"]');
            let slug = $('input[name="category_slug"]');
            let form_data = {
                name: $(name).val(),
                slug: $(slug).val(),
                description: "",
            };
            let url = "/ajax/category";

            if ($(name).val() != "") {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form_data,
                    success: function (response) {
                        var data = response.category;
                        $(name).val("");
                        $(".not_found_cat").hide();
                        $("ul.category_list").prepend(
                            '<li><input type="checkbox" class="cbx" id="cat-' +
                                data.slug +
                                '" name="categories[]" style="display: none;" checked value="' +
                                data.id +
                                '"> <label for="cat-' +
                                data.slug +
                                '" class="check"> <svg width="18px" height="18px" viewBox="0 0 18 18"><path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path> <polyline points="1 9 7 14 15 4"></polyline> </svg>' +
                                data.name +
                                "</label></li>"
                        );
                        //success, warning, error, info or notice
                        $.Toast("Success", data.name, "success");
                    },
                    error: function (error) {},
                });
            } else {
                $.Toast("Error", "Category name required!", "error", {
                    timeout: 4000,
                    stack: true,
                    has_close_btn: true,
                });
            }
        });


        // Add Tag
        $("#addTagAjax").on("click", function (e) {
            e.preventDefault();

            let tag_name = $('input[name="tag_name"]');
            let tag_slug = $('input[name="tag_slug"]');
            let form_data = {
                name: $(tag_name).val(),
                slug: $(tag_slug).val(),
                description: "",
            };
            let url = "/ajax/tag";
            if ($(tag_name).val() != "") {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form_data,
                    success: function (response) {
                        $(".not_found_tag").hide();
                        $(tag_name).val("");
                        var data = response.tag;
                        $("ul.tag_list").prepend(
                            '<li><input type="checkbox" class="cbx" id="tag-' +
                                data.slug +
                                '" name="tags[]" style="display: none;" checked value="' +
                                data.id +
                                '"> <label for="tag-' +
                                data.slug +
                                '" class="check"> <svg width="18px" height="18px" viewBox="0 0 18 18"><path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path> <polyline points="1 9 7 14 15 4"></polyline> </svg>' +
                                data.name +
                                "</label></li>"
                        );


                        //success, warning, error, info or notice
                        $.Toast("Tag Created", data.name, "success");
                    },
                    error: function (error) {
                        //success, warning, error, info or notice
                        $.Toast("Error", "Something Wrong!", "error");
                    },
                });
            } else {
                $.Toast("Error", "Tag name required!", "error", {
                    timeout: 4000,
                    stack: true,
                    has_close_btn: true,
                });
            }
        });
    });
})(jQuery);
