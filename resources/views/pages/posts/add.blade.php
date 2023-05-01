@extends('layouts.app')
@section('content')
    <!-- end sidebar menu -->
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">

            <div class="row mt-0">
                <div class="col-md-12 col-sm-6 mt-0">
                    <div class="card shadow-none mt-0">
                        <div class="card-head">
                            {{-- <header>Simple Form</header> --}}


                            <!-- <div class="pull-left m-0">
                                <header>Add New Post | Post ID - {{ $post_id }} </header> -->


                            <!-- </div> -->

                            <ol class="breadcrumb page-breadcrumb pull-left m-0">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Post</li>
                            </ol>

                        </div>
                        @if (Session::has('success'))
                            <div class="row justify-content-center m-1">
                                <div class="alert alert-info col-md-4">{{ Session::get('success') }}</div>
                            </div>
                        @endif

                        <div class="card-body " id="bar-parent">
                            <form action="{{ route('storePost') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md col-sm-6">
                                    <div class="form-group">
                                            <label for="simpleFormEmail">Post ID</label>
                                            <input type="text" class="form-control" name="post_id" id="simpleFormEmail" placeholder="Enter Post ID" value="6" readonly="" style="background: none;border: none;">
                                        </div>
                                    </div>
                                    <!-- post image -->
                                    <div class="col-md col-sm-6">
                                    <!-- <div class="form-group"> -->
                                        POST IMAGE
                                    </div>
                                    <!-- toggel for post url and image -->
                                    <div class="col-md col-sm-6">
                                            <label class="switchToggle">
                                                <input type="checkbox" checked name="post_image"
                                                    onchange="postImage(this)" />
                                                <span class="slider green round"></span>
                                            </label>
                                    </div>
                                    <!-- post url -->
                                    <div class="col-md col-sm-6">
                                        SM URL
                                    </div>
                                    <!-- post now -->
                                    <div class="col-md col-sm-6">
                                        POST NOW</div>
                                        <!-- toggele for post now and schedule post -->
                                        <div class="col-md col-sm-6">
                                            <label class="switchToggle">
                                                <input type="checkbox" checked name="post_image"
                                                    onchange="postImage(this)" />
                                                <span class="slider green round"></span>
                                            </label>
                                    </div>
                                    <!-- schedule posat  -->
                                    <div class="col-md col-sm-6">
                                        SCHEDULE POST
                                    </div>
                                    <!-- pin to home -->
                                    <div class="col-md col-sm-6">
                                        PIN TO HOME
                                        <a href=""><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                    </div>                              
                                </div>
                                <!-- div 2 -->
                                 <!-- for photo uploaded -->
                                <div class="col-md-12" >
                                    <div class="row">
                                        <div class="col-md-1" style="line-height: 150px;">
                                        <!-- <div class="input-field"> -->
                                            <label class="active">Photos</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-images-1" style="padding-top: .5rem;"></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                    <!-- social media -->
                                    <!-- div 3 -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="simpleFormEmail">Social Media URL</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea id="socialMediaUrl" name="socialMediaUrl" cols='60'  disabled>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- social media end -->
                                <!-- div 3 end -->
                                <!-- div 4 start -->
                                <!-- title -->
                                <div class="row col-md-12 justify-content-evenly">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="simpleFormEmail">Title <sup style="color:red;">*</sup></label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="title" name="title" title="Title  (Note: Make a short title and choose a color as visible over the image"  required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- title end -->
                                    <!-- text color start -->
                                    <div class="col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="simpleFormEmail">Text Color</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div id="cp1" class="input-group colorpicker-component">
                                                        <input type="text" value="black" id="text_color"
                                                        name="text_color" class="form-control" />
                                                        <span class="input-group-addon"><i></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- text color end -->
                                    <!-- div 4 end -->
                                                
                                        <!-- div 5 start -->
                                        <!-- schedule post start -->
                                <div class="row col-md-12 justify-content-evenly">
                                    <div class="col-md-6">
                                        <div class='row'>
                                            <div class='col-md-4'>
                                                <label for="simpleFormEmail">Schedule Post</label>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class="form-group">                                               
                                                    <div class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input2">
                                                        <input class="form-control" size="16" type="text"
                                                        value="" placeholder="schedule date" id="schdlDate" />
                                                            {{-- <span class="input-group-addon"><span class="fa fa-remove"></span></span> --}}
                                                            <button class="input-group-addon text-dark" disabled><span
                                                            class="fa fa-calendar"></span></button>
                                                    </div>
                                                    <input type="hidden" id="dtp_input2" name="schedule_date"value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                           <!-- s.p end -->
                                            <!-- e.p start -->
                                    <div class="col-md-6">   
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="simpleFormEmail">End Date of Post</label>
                                            </div>                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group date form_datetime" data-date=""data-date-format="dd MM yyyy - HH:ii p"data-link-field="dtp_input3">
                                                        <input class="form-control" size="16" type="text"value="" placeholder="End Date of Post"id="endDate" />
                                                        {{-- <span class="input-group-addon"><span class="fa fa-remove"></span></span> --}}
                                                        <span class="input-group-addon"><span
                                                        class="fa fa-calendar"></span></span>
                                                    </div>
                                                    <input type="hidden" id="dtp_input3" name="end_date_post"
                                                    value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>            <!-- e.p end -->
                                            <!-- div 5 end -->
                                            <!-- select category start -->
                                            <!-- div  6 start  -->
                                <div class="row col-md-12 justify-content-evenly">
                                    <div class="col-md-6">   
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="simpleFormEmail">Select Category <sup
                                                style="color:red;">*</sup></label>
                                            </div>                                                    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group ">
                                                        <select id="multiple" class="form-control select2-multiple" data-placeholder="Category List" name="category[]" required multiple>
                                                            @foreach ($category as $key => $value)
                                                                <option value="{{ $value['id'] }}">
                                                                 {{ $value['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>  
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                        <!-- select category end -->
                                        <!-- select tag start -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="simpleFormEmail">Select Tags<sup style="color:red;">*</sup>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <select id="multiple" class="form-control select2-multiple" data-placeholder="Tag List" name="tags[]" required multiple>
                                                            @foreach ($tag as $key => $value)
                                                                <option value="{{ $value['id'] }}">
                                                                {{ $value['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <span class="input-group-addon tag_add " onclick="set_value1(this.value);"><span class="fa fa-plus"></span></span>  --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                 
                                    </div>
                                        <!-- select tag end -->
                                </div>
                                   <!-- div 6 end -->
                                   
                                    <!-- div 7 start -->
                                    <!-- show room start -->
                                <div class="row col-md-12 justify-content-evenly">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="simpleFormEmail">Select Showroom 
                                                <sup style="color:red;"></sup></label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">       
                                                    <select nratingame="rating" class="form-control" id="rating" name="showroom"  required>
                                                        <option value="">Select Showroom</option>
                                                        @foreach ($showrooms as $value)
                                                            <option value="{{ $value->id }}">
                                                            {{ $value->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- show room end -->
                                    </div>
                                    <!-- rating start -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="simpleFormEmail">Rating<sup style="color:red;">*</sup></label>  
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">         
                                                    {{-- <input type="number"  id="title" name="title" value="1" placeholder=""  min="0" step="5" max="100" /> --}}
                                                    <input type="number" class="form-control" name="rating" value="1" min="1" max="100" onkeyup="if(parseInt(this.value)>100){ this.value =100; return false; }">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- rating end -->
                                </div>    
                                <!-- div 7 end -->
                                <!-- div 8 start -->
                                <div class="row col-md-12">
                                    <div class="col-md-2">
                                        <label for="commentin">comment</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                             <input type="text" name="comment" class="form-control" id="commentin"
                                              placeholder="Comment : only for our official use and will not be displayed any were in website" />
                                        </div>
                                    </div>
                                </div> 
                                   <!--div 8 end  -->
                                   <!-- div 9 start -->
                                <div class="row col-md-12 justify content-evenly">
                                    <div class="col-md">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Pdf
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" placeholder="name the title of the pdf">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- pdf title end -->
                                    <div class="col-md p-0">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div id="container-wrapper">
                                                    <div class="container input-group dropdown">
                                                        <input type="text" name="pdf_description[]" placeholder="PDF description"
                                                        class=" form-control col-md-10">
                                                        <label for="pdfNew1" class="m-0 p-0" >
                                                            <input type="file" name="pdf_upload[]" accept="application/pdf"
                                                            id="pdfNew1" style="display:none;" >
                                                            <span class="upload-btn btn btn-primary">Upload</span>
                                                        </label>
                                                        <span class="eye-icon btn btn-success dropdown-toggle" style="display:none;"
                                                        data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i
                                                        class="fa fa-eye"></i></span>
                                                        <div class="pdf-new-preview dropdown-menu dropdown-menu-default animated jello">
                                                       </div>
                                                        <span class="minus-icon btn btn-outline red"><i
                                                        class="fa fa-trash-o"></i></span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-2">
                                                <span class="plus-icon btn blue-bgcolor btn-outline ml-3"><i
                                                class="fa fa-plus"></i></span>
                                                {{-- <div class="col-md-12 p-3 pdf_container input-group">
                                                    <label for="simpleFormEmail">Add Pdf</label>
                                                    <label class="row col-12 m-2 pdf-view" for="pdf">
                                                    <div class="upload-text"><i class="fa fa-cloud-upload"></i><span>Drag &amp; Drop
                                                        files here or click to browse</span></div>
                                                    </label>
                                                    <input type="file" name="sfiles[]" id="pdf" accept=".pdf"
                                                    class="form-control border-0" onchange="pdfPreview(this)" style="display:none;">
                                                </div> --}}
                                            </div>
                                        </div>                              
                                    </div>
                                </div>
                                <!-- div 9 end -->
                                <!-- end of the div  -->
                                <div class="col-md-12">
                                    <div class="form-group text-content">
                                        <label for="simpleFormEmail">Content</label>
                                        <textarea name="content" id="summernote" cols="30" rows="3"><b>Visit us today or call us @+91 9894659125 to know more</b></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 text center">
                                        <button type="reset" name=" reset" value="reset"
                                        class="btn btn-primary">Reset</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" name="cancel" value="cancel"
                                            class="btn btn-primary">cancel</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" name="post_btn" value="1"
                                        class="btn btn-primary">Post</button> 
                                    </div>
                                    <div class="col-md-2">
                                        @if (Auth::user()->auth_level == 9)
                                            <button type="submit" name="post_btn" value="2"
                                            class="btn btn-primary">Post & Approve</button>
                                        @endif 
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $('.input-images-1').imageUploader({

            imagesInputName: 'my_files',
            maxFiles: 5

        });
    </script>

    <script>
        $(document).ready(function() {
            // Add container
            $('.plus-icon').click(function() {
                var prevInput = $(this).prev().find("input[type=file]");
                if (prevInput.val() === "") {
                    alert("Please fill out the previous PDF  before adding a new one.");
                    return;
                }
                var uniqueNumber = $.now();
                var container =
                    `<div class="container p-0 pb-3 input-group dropdown"><input  type="text" name="pdf_description[]" placeholder="PDF description" class="form-control col-md-12"><label for="pdfNew` +
                    uniqueNumber +
                    `" class="m-0"><input type="file" accept="application/pdf" name="pdf_upload[]" id="pdfNew` +
                    uniqueNumber + `" style="display:none;"><span class="upload-btn btn btn-primary">Upload</span></label><span class="eye-icon btn btn-success dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="display:none;"><i class="fa fa-eye"></i></span><div class="pdf-new-preview dropdown-menu dropdown-menu-default animated jello"></div><span class="minus-icon btn btn-outline red"><i class="fa fa-trash-o"></i></span></div>
`;
                $('#container-wrapper').append(container);
                updateMinusIconVisibility();
            });
            // Remove container
            $('#container-wrapper').on('click', '.minus-icon', function() {
                if ($('.container').length > 1) {
                    $(this).parent().remove();
                    updateMinusIconVisibility();
                }
            });
            // Hide minus icon for first container
            $('.container .minus-icon').first().hide();
            // Update minus icon visibility
            function updateMinusIconVisibility() {
                $('.container .minus-icon').each(function(index, element) {
                    if (index === 0 && $('.container').length === 1) {
                        $(element).hide();
                    } else {
                        $(element).show();
                    }
                });
            }
            // Bind change event to inputs
            $('#container-wrapper').on('change', 'input', function() {
                updateMinusIconVisibility();
            });
        });
        $('#container-wrapper').on('change', 'input[type="file"]', function() {
            var file = $(this)[0].files[0];
            if (file && file.type === "application/pdf") {
                $(this).attr('data-file', file.name);
                $(this).parent().siblings('.pdf-new-preview').html('<iframe src="' + URL.createObjectURL(file) +
                    '" width="100%" height="500"></iframe>');
                //   $(this).siblings('.upload-btn').hide();
                $(this).parent().siblings('.eye-icon').show();
            } else {
                alert("Please choose a valid PDF file.");
                $(this).val('').removeAttr('data-file');
            }
            updateMinusIconVisibility();

            dateTime();
            $("#schdlDate").prop("disabled", "true");
            
            


        });

        function category_submit() {
            var category = $("input[name='new_category[]']").val();
            var type = $("input[name='type[]']").val();
            var new_category_id = $("input[name='new_category_id[]']").val();
            var paramsToSend = {};
            var paramsToSend1 = {};
            var paramsToSend2 = {};
            var i = 0;
            var j = 0;
            var k = 0;
            $("input[name='new_category[]']").each(function() {
                paramsToSend[i] = $(this).val();
                i++;
            });
            $("input[name='type[]']").each(function() {
                paramsToSend1[j] = $(this).val();
                j++;
            });
            $("input[name='new_category_id[]']").each(function() {
                paramsToSend2[k] = $(this).val();
                k++;
            });
            var toBeSelected = Object.keys(paramsToSend).map(function(key) {
                return paramsToSend[key];
            });
            $.ajax({
                url: "{{ route('updateCategory') }}",
                type: 'ajax',
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    category: JSON.stringify(paramsToSend),
                    new_category_id: JSON.stringify(paramsToSend2),
                    type: JSON.stringify(paramsToSend1)
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    console.log(data);
                    // $("#exampleModalCenter").modal("hide");
                    // set_value();
                    var data = JSON.parse(result);
                    $('#category')
                        .find('option')
                        .remove();
                    $.each(data, function(key, value) {
                        if (jQuery.inArray(value.name, toBeSelected) !== -1) {
                            var selected = "selected";
                        } else {
                            var selected = "";
                        }

                        var option = '<option ' + selected + ' value="' + value.id + '">' + value
                            .name +
                            '</option>';
                        $('#category').append(option);
                    });
                    set_value();
                    $('[class="input-group mb-1"]').remove();
                    $(".chosen-select").trigger("liszt:updated");
                    $(".chosen-select").trigger("chosen:updated");
                }
            });
        }


        function tag_submit() {
            var tag = $("input[name='new_tag[]']").val();
            var type = $("input[name='tag_type[]']").val();
            var new_tag_id = $("input[name='new_category_id[]']").val();
            var paramsToSend = {};
            var paramsToSend1 = {};
            var paramsToSend2 = {};
            var i = 0;
            var j = 0;
            var k = 0;
            $("input[name='new_tag[]']").each(function() {
                paramsToSend[i] = $(this).val();
                i++;
            });
            $("input[name='tag_type[]']").each(function() {
                paramsToSend1[j] = $(this).val();
                j++;
            });
            $("input[name='new_tag_id[]']").each(function() {
                paramsToSend2[k] = $(this).val();
                k++;
            });
            var toBeSelected = Object.keys(paramsToSend).map(function(key) {
                return paramsToSend[key];
            });
            $.ajax({
                url: "{{ route('updateTag') }}",
                type: 'ajax',
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    tag: JSON.stringify(paramsToSend),
                    new_tag_id: JSON.stringify(paramsToSend2),
                    tag_type: JSON.stringify(paramsToSend1)
                },
                success: function(result) {

                    var data = JSON.parse(result);
                    console.log(data);
                    var data = JSON.parse(result);
                    $('#tags')
                        .find('option')
                        .remove();

                    $.each(data, function(key, value) {
                        if (jQuery.inArray(value.name, toBeSelected) !== -1) {
                            var selected = "selected";
                        } else {
                            var selected = "";
                        }
                        var option = '<option ' + selected + ' value="' + value.id + '">' + value
                            .name +
                            '</option>';
                        $('#tags').append(option);
                    });
                    set_value1();
                    $('[class="input-group mb-1"]').remove();
                    $(".chosen-select").trigger("liszt:updated");
                    $(".chosen-select").trigger("chosen:updated");
                    $("#tagexampleModalCenter").modal("toggle");
                }
            });
        }

        function changeCat(cat_id) {
            if (cat_id == "") {
                $(".category_add").find(".fa-pencil").addClass("fa-plus").removeClass('fa-pencil');
            } else {

                $(".category_add").find(".fa-plus").addClass('fa-pencil').removeClass("fa-plus");
            }


        }

        // function changeCat1(tag_id) {
        //     if (tag_id == "") {
        //         $(".tag_add").find(".fa-pencil").addClass("fa-plus").removeClass('fa-pencil');
        //     } else {

        //         $(".tag_add").find(".fa-plus").addClass('fa-pencil').removeClass("fa-plus");
        //     }


        // }

        function set_value() {

            //  if ($("#category").val() == "") {
            //     $(".category_add").find(".fa-pencil").addClass("fa-plus").removeClass('fa-pencil');
            // }
            // else{

            //     $(".category_add").find(".fa-plus").addClass('fa-pencil').removeClass("fa-plus");
            // }

            $('.category_append').empty();
            var id = [];
            $("#category :selected").map(function(i, el) {
                id.push($(el).val());
            }).get();
            if (id.length !== 0) {
                $.ajax({
                    url: "{{ route('getCategoryDetailsByIds') }}",
                    type: 'ajax',
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        category_id: id,
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        //console.log(data);
                        if (data) {
                            var option = [];
                            var id = [];
                            $.each(data, function(key, value) {
                                if ($.inArray(value, id) == -1) {
                                    option.push(
                                        '<input type="hidden" name="new_category_id[]" id="new_category_id" class="new_category_id" value="' +
                                        value.id +
                                        '"><input type="hidden" name="type[]" id="new_category_type" class="new_category_id" value="update"><input type="text" class="form-control new_category" id="new_category" name="new_category[]" placeholder="New Category..." value="' +
                                        value.name + '"/>');
                                    id.push(value.id);
                                }
                            });
                            $('.category_append').append(option);
                        }

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            } else {
                var option =
                    '<input type="hidden" name="new_category_id[]" id="new_category_id" class="new_category_id" value=""><input type="hidden" name="type[]" id="new_category_type" class="new_category_id" value="post"><input type="text" class="form-control new_category" id="new_category" name="new_category[]" placeholder="New Category..." value=""/>';
                $('.category_append').append(option);
                // $('[id="new_category"]:gt(0)').remove();
            }
            $(".chosen-select").trigger("liszt:updated");
            $(".chosen-select").trigger("chosen:updated");
            $("#exampleModalCenter").modal("toggle");
        }

        function set_value1(tag_id) {
            $('.tag_append').empty();
            var id = [];
            $("#tags :selected").map(function(i, el) {
                id.push($(el).val());
            }).get();
            if (id.length !== 0) {
                $.ajax({
                    url: "{{ route('getTagDetailsByIds') }}",
                    type: 'ajax',
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        tag_id: id,
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        //console.log(data);
                        if (data) {
                            var option = [];
                            var id = [];
                            $.each(data, function(key, value) {
                                if ($.inArray(value, id) == -1) {
                                    option.push(
                                        '<input type="hidden" name="new_tag_id[]" id="new_tag_id" class="new_category_id" value="' +
                                        value.id +
                                        '"><input type="hidden" name="tag_type[]" id="new_tag_type" class="new_tag_id" value="update"><input type="text" class="form-control" id="new_tag" name="new_tag[]" placeholder="New Tag..." value="' +
                                        value.name + '"/>');
                                    id.push(value.id);
                                }
                            });
                            $('.tag_append').append(option);
                        }

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            } else {
                var option =
                    '<input type="hidden" name="new_tag_id[]" id="new_tag_id" class="new_category_id" value=""><input type="hidden" name="tag_type[]" id="new_tag_type" class="new_tag_id" value="post"><input type="text" class="form-control" id="new_tag" name="new_tag[]" placeholder="New Tag..." value=""/>';
                $('.tag_append').append(option);
            }

            $(".chosen-select").trigger("liszt:updated");
            $(".chosen-select").trigger("chosen:updated");
            $("#tagexampleModalCenter").modal("toggle");
        }

        function postImage(event) {
            // console.log(event.checked);
            if (event.checked) {

                $("#socialMediaUrl").prop("disabled", true);
                $(".image-uploader input").prop("disabled", false);
                $(".image-uploader").removeAttr("style");
                $(".image-uploader img").removeAttr("style");
            } else {
                $("#socialMediaUrl").prop("disabled", false);
                $(".image-uploader input").prop("disabled", true);
                $(".image-uploader").css('background', '#f3f0f0');
                $(".image-uploader img").css('filter', 'blur(10px)');

            }
        }


        function postNow(event) {
            // console.log(event.checked);
            if (event.checked) {
                $("#schdlDate").prop("disabled", "true");
                // $("#schdlDate").next("button").prop("disabled", true);
                dateTime();
                // $("#endDate").prop("disabled","true");
            } else {
                // $("#endDate").prop("disabled",false);
                // alert("ok");
                $("#schdlDate").prop("disabled", false);
                // $("#schdlDate").next("button").prop("disabled", false);
            }
        }

        function dateTime() {
            const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                "November", "December"
            ];
            var currentdate = new Date();
            let MonthValue = month[currentdate.getMonth()];
            let hour;
            let timeLevel;
            if (currentdate.getHours() > 12) {
                hour = currentdate.getHours() - 12;
                timeLevel = "pm";
            } else {
                hour = currentdate.getHours();
                timeLevel = "am";
            }
            var datetime = currentdate.getDate() + " " +
                MonthValue + " " +
                currentdate.getFullYear() + " - " +
                hour + ":" +
                String(currentdate.getMinutes()).padStart(2, "0") + " " +
                timeLevel

            $("#schdlDate").val(datetime);
            var param1 = new Date();
            var param2 = param1.getFullYear() + '-' + (param1.getMonth() + 1) + '-' + param1.getDate() + ' ' + param1
                .getHours() + ':' + param1.getMinutes() + ':' + param1.getSeconds();
            $("#dtp_input2").val(param2);
        }








        function addInput(event) {
            if ($(event).parent().parent().find("new_category").val() == "") {
                swal.fire("Please Enter Value");
            } else {
                let inputValue = $(event).parent().find('input');
                console.log(inputValue);
                let Id = $(inputValue).attr('id');
                let name = $(inputValue).attr('name');
                let placeholder = $(inputValue).attr('placeholder');
                $(event).parent().parent().prepend(
                    "<div class='input-group mb-1'><input type='text' class='form-control' id='new_category' name='new_category[]' placeholder='New Category...' /><span class='input-group-addon d-flex align-items-center ' style='background:red;border-color:red;' onclick='removeInput(this);' ><span class='fa fa-minus'></span></span></div><input type='hidden' name='new_category_id[]' id='new_category_id'><input type='hidden' name='type[]' id='new_category_type'>"
                );
            }
        }

        function addInput1(event) {
            // console.log($(event));
            if ($(event).parent().parent().find("#new_tag").val() == "") {
                swal.fire("Please Enter Value");
            } else {
                let inputValue = $(event).parent().find('input');
                console.log(inputValue);
                let Id = $(inputValue).attr('id');
                let name = $(inputValue).attr('name');
                let placeholder = $(inputValue).attr('placeholder');
                $(event).parent().parent().prepend(
                    "<div class='input-group mb-1'><input type='text' class='form-control' id='new_tag' name='new_tag[]' placeholder='New Tag...' /><span class='input-group-addon d-flex align-items-center ' style='background:red;border-color:red;' onclick='removeInput(this);' ><span class='fa fa-minus'></span></span></div><input type='hidden' name='new_tag_id[]' id='new_tag_id'><input type='hidden' name='tag_type[]' id='new_tag_type'>"
                );
            }
        }

        function removeInput(event) {
            $(event).parent().remove();
        }

        function deletepdf(event) {

            var connect = $(event).prev().attr('connect_id');
            $("input").filter("[connect_id='" + connect + "']").remove();
            $("iframe").filter("[connect_id='" + connect + "']").parent().remove();

        }






        function pdfPreview(file) {
            var pdfFile = file.files[0];
            var objectURL = URL.createObjectURL(pdfFile);

            var uniqueNumber = "in-if" + Date.now() + Math.random();

            // file.attr('connect_id',uniqueNumber);
            file.setAttribute('connect_id', uniqueNumber);

            $(".pdf-view").append('<div class="pdf" onclick="event.preventDefault()" ><iframe src="' + objectURL +
                '"  class="pdf-iframe " connect_id="' + uniqueNumber +
                '" scrolling="no"></iframe><button class="btn btn-danger pdf_delete_btn w-100" onclick="deletepdf(this)">Delete</button></div>'
            );
            $(".pdf_container").append('<input type="file" name="sfiles[]" id="' + uniqueNumber +
                '" accept=".pdf" class="form-control border-0" onchange="pdfPreview(this)" style="display:none;">');
            $(".pdf-view").attr("for", uniqueNumber);
        }
        $(document).ready(function () {
            $('#socialMediaUrl').on('input', function() {
                var url = $(this).val();
                var isFacebookReel = url.includes("facebook.com/reel/");
                if (isFacebookReel) {
                    var iframe = '<iframe src="' + url +
                        '" width="560" height="315" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                    $(this).val(iframe);
                }
                var isYoutubeShorts = url.includes("youtube.com/shorts/");
                if (isYoutubeShorts) {
                    var videoId = url.split("/").pop();
                    var iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' +
                        videoId +
                        '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    $(this).val(iframe);
                }

            });
        });

    </script>
@endsection
