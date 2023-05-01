@extends('layouts.app')
@section('content')
    <!-- end sidebar menu -->
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12 col-sm-6">
                    <div class="card shadow-none mt-0">
                        <div class="card-head">
                            <header>Edit Post | {{ $post_id }}</header>
                            <ol class="breadcrumb page-breadcrumb pull-right m-0">
                                <li><i class="fa-regular fa-folder-plus"></i>&nbsp;<a class="parent-item"
                                        href="/">POST</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> <a href="{{ $link }}">{{ $page }}</a> </li>
                            </ol>
                        </div>
                        @if (Session::has('success'))
                            <div class="row justify-content-center m-1">
                                <div class="alert alert-info col-md-4">{{ Session::get('success') }}</div>
                            </div>
                        @endif

                        <div class="card-body " id="bar-parent">
                            <form action="{{ route('updatePost', ['id' => $post_id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row col-md-12">

                                    <input type="hidden" class="form-control" name="post_id" id="simpleFormEmail"
                                        placeholder="Enter Post ID" value="{{ $post_id }}" readonly />

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="simpleFormPassword">Post Image</label>
                                            <br>
                                            <label class="switchToggle">
                                                <input type="checkbox" <?php if ($default->post_type == 1) {
                                                    echo 'checked';
                                                } ?> name="post_image"
                                                    onchange="postImage(this)" />
                                                <span class="slider green round"></span>
                                            </label>

                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <label for="simpleFormEmail">Social Media URL</label>
                                        <div class="form-group">
                                            <textarea id="socialMediaUrl" name="socialMediaUrl" rows="3 " cols="50" disabled>
                                            {{ isset($socialMediaUrl->social_media_url) ? $socialMediaUrl->social_media_url : '' }}
                                        </textarea>
                                            {{-- <input type="hidden" class="form-control" id="youtubeId" name="youtube_url" disabled placeholder="YouTube URL"  value="{{$default->youtube_link}}" /> --}}

                                        </div>
                                    </div>
                                </div>

                                {{-- Old Code For Image Preview --}}

                                {{--
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Add maximum of 5 images</label>
                                    <input type="file" class="form-control" id="images" name="my_files[]" onchange="preview_images();" multiple />
                                    <div class="row" id="image_preview"></div>
                                </div>
                                <div class="row container">

                                    @foreach ($default_images as $images)
                                    <div class="col-xs-4"><img class="img-responsive" src="{{asset($images->medium_thumbnail)}}" width="50" hright="50" />
                    </div>&nbsp;&nbsp;
                    @endforeach

                </div>
            </div> --}}


                                {{-- New Code For Image Preview --}}

                                <div class="col-md-12">
                                    <div class="input-field">
                                        <label class="active">Photos</label>
                                        <div class="input-images-2" style="padding-top: .5rem;"></div>
                                    </div>
                                </div>

                                <br><br>
                                {{-- <div class="col-md-12 p-3 pdf_container input-group">
                <label for="simpleFormEmail">Add Pdf</label>
                <label class="row col-12 m-2 pdf-view" for="pdf">
                    <div class="upload-text"><i class="fa fa-cloud-upload"></i><span>Drag &amp; Drop files here or click to browse</span></div>
                    {{-- @foreach ($default_pdfs as $default_pdf)
                    <div class="pdf" onclick="event.preventDefault()">
                        <iframe src="{{ asset('pdffiles/'.$default_pdf->file_path) }}"  class="pdf-iframe" scrolling="no"></iframe>
                        <label class="btn btn-danger pdf_delete_btn" pdf_del="{{$default_pdf->id}}" onclick="editPdfDelete(this)">Delete</label>
                    </div>
                     
                    @endforeach 
                </label>
                    
           
               
                <input type="file" name="sfiles[]" id="pdf" accept=".pdf" class="form-control border-0" onchange="pdfPreview(this)" style="display:none;">
              
        
           
    
        </div> --}} 
                                @if (count($pdfUploads)>0)
                                    @foreach ($pdfUploads as $pdf)
                                        <div class="col-md-12  p-0">
                                            <div id="container-wrapper" class="col-md-12 p-0 pt-3 pb-1">
                                                <div class="container p-0 pb-3 input-group dropdown">
                                                    <input type="text" name="pdf_description[]"
                                                        placeholder="PDF description" value="{{ $pdf['pdf_description'] }}"
                                                        class=" form-control col-md-12">
                                                    {{-- <label for="pdfNew1" class="m-0">
                                                        <input type="file" name="pdf_upload[]" accept="application/pdf"
                                                            id="pdfNew1" style="display:none;"
                                                            pdfId="{{ $pdf['id'] }}">
                                                        <span class="upload-btn btn btn-primary">Upload</span>
                                                    </label> --}}
                                                    <span class="eye-icon btn btn-success dropdown-toggle"
                                                        data-toggle="dropdown" data-hover="dropdown"
                                                        data-close-others="true"><i class="fa fa-eye"></i></span>
                                                    <div
                                                        class="pdf-new-preview dropdown-menu dropdown-menu-default animated jello">
                                                        <iframe src="{{ asset('pdffiles/' . $pdf['file_path']) }}"
                                                            height="500" frameborder="0"></iframe>
                                                    </div>
                                                    <button pdfName="{{ $pdf['file_path'] }}" type="button"
                                                        class="minus-icon btn btn-outline red pdfName" data-type="cancel"
                                                        onclick="delete_item(<?php echo $pdf['id']; ?>);"><i
                                                            class="fa fa-trash-o"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <span class="plus-icon btn blue-bgcolor btn-outline ml-3"><i
                                            class="fa fa-plus"></i></span>
                                @else
                                <div class="col-md-12  p-0">
                                    <div id="container-wrapper" class="col-md-12 p-0 pt-3 pb-1">
                                        <div class="container p-0 pb-3 input-group dropdown">
                                            <input type="text" name="pdf_title[]" placeholder="PDF description"
                                                class=" form-control col-md-12">
                                            <label for="pdfNew1" class="m-0">
                                                <input type="file" name="pdf_file[]" accept="application/pdf"
                                                    id="pdfNew1" style="display:none;">
                                                <span class="upload-btn btn btn-primary">Upload</span>
                                            </label>
                                            <span class="eye-icon btn btn-success dropdown-toggle" style="display:none;"
                                                data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i
                                                    class="fa fa-eye"></i></span>
                                            <div
                                                class="pdf-new-preview dropdown-menu dropdown-menu-default animated jello">
                                            </div>
                                            <span class="minus-icon btn btn-outline red d-none"><i
                                                    class="fa fa-trash-o"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <span class="plus-icon btn blue-bgcolor btn-outline ml-3"><i
                                    class="fa fa-plus"></i></span>
                                        @endif
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="simpleFormEmail">Title <sup style="color:red;">*</sup></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter Title" value="{{ $default->title }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="simpleFormEmail">Text Color</label>

                                            <div class="form-group row">

                                                <div id="cp1" class="input-group colorpicker-component col-md-8">
                                                    <input type="text" value="{{ $default->title_text_color }}"
                                                        id="text_color" name="text_color" class="form-control" />
                                                    <span class="input-group-addon"><i></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="simpleFormPassword">Post Now</label>
                                            <br>
                                            <label class="switchToggle">
                                                <input type="checkbox" id="schdlCheck" <?php if ($default->post_now == 1) {
                                                    echo 'checked';
                                                } ?>
                                                    name="post_now" onchange="postNow(this)" />
                                                <span class="slider green round"></span>
                                            </label>

                                        </div>
                                    </div>

                                </div>

                                <div class="row col-md-12 justify-content-between">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="simpleFormEmail">.</label>
                                            <div class="checkboxnew checkbox-new-icon-black">
                                                <input id="p2h" type="checkbox" class="d-none" <?php if ($default->pin_to_home == 1) {
                                                    echo 'checked';
                                                } ?>
                                                    name="pin_to_home" />
                                                <label for="p2h">
                                                    <svg height="45" width="50">

                                                        <path
                                                            d="M41.41,12,30.05.59a2,2,0,0,0-3.36,1.87l.55,2.4-12,9.19-6.52.72a3,3,0,0,0-1.79,5.11l5.31,5.3L.23,40.37a1,1,0,0,0,1.4,1.4l15.19-12,5.3,5.31a3,3,0,0,0,5.11-1.79L28,26.78l9.19-12,2.4.55A2,2,0,0,0,41.41,12Z" />

                                                    </svg>
                                                    Pin To Home
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="simpleFormEmail">Schedule Post</label>
                                            <div class="form-group row">
                                                <div class="input-group date form_datetime" data-date=""
                                                    data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input2">
                                                    <input class="form-control" size="16" type="text"
                                                        id="schdlDate" value="{{ $default->schedule_date }}"
                                                        placeholder="schedule date" />

                                                    {{-- <span class="input-group-addon"><span class="fa fa-remove"></span></span> --}}
                                                    <button class="input-group-addon text-dark"><span
                                                            class="fa fa-calendar"></span></button>
                                                </div>
                                                <input type="hidden" id="dtp_input2" name="schedule_date"
                                                    value="{{ $default->schedule_date }}" />
                                                <br />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="simpleFormEmail">End Date of Post</label>
                                            <div class="form-group row">
                                                <div class="input-group date form_datetime" data-date=""
                                                    data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input3">
                                                    <input class="form-control" size="16" type="text"
                                                        value="{{ $default->post_end_date }}"
                                                        placeholder="End Date of Post" />
                                                    {{-- <span class="input-group-addon"><span class="fa fa-remove"></span></span> --}}
                                                    <span class="input-group-addon"><span
                                                            class="fa fa-calendar"></span></span>
                                                </div>
                                                <input type="hidden" id="dtp_input3" name="end_date_post"
                                                    value="{{ $default->post_end_date }}" />
                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- Old Code For Category Tags --}}


                                {{-- <div class="row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="category" class="form-control" id="category">
                                            <option value="">Select Category</option>
                                            @foreach ($category as $key => $value)
                                            <option <?php //if ($default->category_id == $value['id']) {
                                            //echo "selected";
                                            // }
                                            ?> value="{{ $value['id'] }}">
            {{ $value['name'] }}
            </option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <select name="tags" class="form-control" id="tags">
                <option value="">Select Tag</option>
                @foreach ($tag as $key => $value)
                <option <?php //if ($default->tag_id == $value['id']) {
                // echo "selected";
                //  }
                ?> value="{{ $value['id'] }}">
                    {{ $value['name'] }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div> --}}


                                {{-- New Code For Category Tags --}}

                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="simpleFormEmail">Select Cate ory <sup
                                                    style="color:red;">*</sup></label>


                                            <select name="category[]" multiple class="form-control category select2-multiple"
                                                id="category" onchange="changeCat(this.value)" required data-placeholder="Category List">
                                                {{-- <option value="">Select Category</option> --}}
                                                @foreach ($category as $key => $value)
                                                    <option <?php if (in_array($value['id'], $default_categories)) {
                                                        echo 'selected';
                                                    } ?> value="{{ $value['id'] }}">
                                                        {{ $value['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    {{-- Modal For New Category --}}

                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Create New
                                                        Category
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <!-- <input type="hidden" name="new_category_id[]" id="new_category_id" class="new_category_id">
                                                                    <input type="hidden" name="type[]" id="new_category_type" class="new_category_id">
                                                                    <input type="text" class="form-control new_category" id="new_category" name="new_category[]" placeholder="New Category..." /> -->
                                                            <div class="category_append col-11 p-0"></div>
                                                            <span class="input-group-addon"
                                                                onclick="addInput(this);"><span
                                                                    class="fa fa-plus"></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick='category_submit()'><i class="fa fa-plus">
                                                            Add</i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="simpleFormEmail">Select Tags </label>

                                            <select name="tags[]" multiple class="form-control select2-multiple" data-placeholder="Tag List"
                                                id="tags" onchange="changeCat1(this.value);">
                                                {{-- <option value="">Select Tag</option> --}}
                                                @foreach ($tag as $key => $value)
                                                    <option <?php if (in_array($value['id'], $default_tags)) {
                                                        echo 'selected';
                                                    } ?> value="{{ $value['id'] }}">
                                                        {{ $value['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>


                                {{-- Modal For New Tag --}}

                                <div class="modal fade" id="tagexampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Create New Category
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="tag_append col-11 p-0"></div>
                                                        <!-- <input type="hidden" name="new_tag_id[]" id="new_tag_id" class="new_category_id">
                                                                <input type="hidden" name="tag_type[]" id="new_tag_type" class="new_tag_id">
                                                                <input type="text" class="form-control" id="new_tag" name="new_tag[]" placeholder="New Tag..." /> -->
                                                        <span class="input-group-addon d-flex align-items-center"
                                                            onclick="addInput1(this);"><span
                                                                class="fa fa-plus"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick='tag_submit()'><i
                                                        class="fa fa-plus"></i> Add </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="row col-md-12">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" name="comment" class="form-control" id="comment"
                                                placeholder="Comment : only for our official use and will not be displayed any were in website"
                                                value="{{ $default->comment }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="rating" class="form-control"
                                                id=""value="{{ $default->rating }}" />

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="simpleFormEmail">Content</label>
                                        <textarea name="content" id="summernote" cols="30" rows="10">{{ $default->content }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <input type="hidden" class="image_ids" name="image_ids">
                                    <button type="submit" name="post" value="post"
                                        class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Add container
            $('.plus-icon').click(function() {
                var prevInput = $(this).prev().find("input[type=file].new-pdf-input");
                if (prevInput.val() === "") {
                    alert("Please fill out the previous PDF  before adding a new one.");
                    return;
                }
                var uniqueNumber = $.now();
                var container =
                    `<div class="container p-0 pb-3 input-group dropdown"><input type="text" name="pdf_title[]" placeholder="PDF description" class="form-control col-md-12"><label for="pdfNew` +
                    uniqueNumber +
                    `" class="m-0"><input type="file" class="new-pdf-input" accept="application/pdf" name="pdf_file[]" id="pdfNew` +
                    uniqueNumber + `" style="display:none;"><span class="upload-btn btn btn-primary">Upload</span></label><span class="eye-icon btn btn-success dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="display:none;"><i class="fa fa-eye"></i></span><div class="pdf-new-preview dropdown-menu dropdown-menu-default animated jello"></div><span class="plus-icon btn btn-outline red "><i class="fa fa-trash-o"></i></span></div>
`;
                $('#container-wrapper').append(container);
                updateMinusIconVisibility();
            });
            // Remove container
            $('#container-wrapper').on('click', '.plus-icon', function() {
                if ($('.container').length > 1) {
                    $(this).parent().remove();
                    updateMinusIconVisibility();    
                }
            });
            // Hide minus icon for first container
            // $('.container .minus-icon').first().hide();
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

            // console.log($("#schdlDate").prop("checked"));

            if ($("#schdlCheck").prop("checked")) {
                $("#schdlDate").prop("disabled", "true");
                $("#schdlDate").next("button").prop("disabled", true);
                // dateTime();
                // $("#endDate").prop("disabled","true");
            } else {
                // $("#endDate").prop("disabled",false);
                $("#schdlDate").prop("disabled", false);
                $("#schdlDate").next("button").prop("disabled", false);
            }
            // $("#schdlDate[readOnly]").click(function(){
            //     $('#schdlDate').off('click');
            // });
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
                    $("#exampleModalCenter").modal("hide");
                    $(".category-clone").html(
                        '<div class="input-group"><input type="hidden" name="new_category_id[]" id="new_category_id" class="new_category_id"><input type="hidden" name="type[]" id="new_category_type" class="new_category_id"><input type="text" class="form-control new_category" id="new_category" name="new_category[]" placeholder="New Category..." /><span class="input-group-addon" onclick="addInput(this);"><span class="fa fa-plus"></span></span></div>'
                    );

                    var data = JSON.parse(result);

                    // alert(opt);
                    $('#category')
                        .find('option')
                        .remove();
                    // $("#category").prepend("<option value=''>Select Category</option>").val('');
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
                    $("#tagexampleModalCenter").modal("hide");
                    $(".tag-clone").html(
                        '<div class="input-group"><input type="hidden" name="new_tag_id[]" id="new_tag_id" class="new_category_id"><input type="hidden" name="tag_type[]" id="new_tag_type" class="new_tag_id"><input type="text" class="form-control" id="new_tag" name="new_tag[]" placeholder="New Tag..." /><span class="input-group-addon d-flex align-items-center"  onclick="addInput1(this);"><span class="fa fa-plus"></span></span></div>'
                    );
                    var data = JSON.parse(result);
                    // alert(opt);
                    $('#tags')
                        .find('option')
                        .remove();
                    // $("#tags").prepend("<option value=''>Select Tags</option>").val('');
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
                    $(".chosen-select").trigger("liszt:updated");
                    $(".chosen-select").trigger("chosen:updated");
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

        function changeCat1(tag_id) {
            if (tag_id == "") {
                $(".tag_add").find(".fa-pencil").addClass("fa-plus").removeClass('fa-pencil');
            } else {

                $(".tag_add").find(".fa-plus").addClass('fa-pencil').removeClass("fa-plus");
            }


        }

        function set_value() {

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



        $(function() {
            var checked = "<?php echo $default->post_type; ?>";
            if (checked == 1) {
                $("#youtube").prop("disabled", true);
                $("#youtubeId").prop("disabled", true);
                $(".image-uploader input").prop("disabled", false);
                $(".image-uploader").removeAttr("style");
                $(".image-uploader img").removeAttr("style");
            } else {
                $("#youtube").prop("disabled", false);
                $("#youtubeId").prop("disabled", false);
                $(".image-uploader input").prop("disabled", true);
                $(".image-uploader").css('background', '#f3f0f0');
                $(".image-uploader img").css('filter', 'blur(10px)');

            }

        })

        function postImage(event) {
            // console.log(event.checked);
            if (event.checked) {

                $("#socialMediaUrl").prop("disabled", true);
               $(".image-uploader input").prop("disabled", false);
                $(".image-uploader").removeAttr("style");
                $(".image-uploader img").removeAttr("style");
            } else {

                $("#socialMediaUrl").prop("disabled", false);
                $("#youtubeId").prop("disabled", false);
                $(".image-uploader input").prop("disabled", true);
                $(".image-uploader").css('background', '#f3f0f0');
                $(".image-uploader img").css('filter', 'blur(10px)');

            }
        }

        function postNow(event) {

            // console.log(event.checked);
            if (event.checked) {
                $("#schdlDate").prop("disabled", "true");
                $("#schdlDate").next("button").prop("disabled", true);
                dateTime();
                // $("#endDate").prop("disabled","true");
            } else {
                // $("#endDate").prop("disabled",false);
                $("#schdlDate").prop("disabled", false);
                $("#schdlDate").next("button").prop("disabled", false);
            }
        }
        $(function() {
            $("input#files[type='file']").change(function() {
                var $fileUpload = $("input#files[type='file']");
                if (parseInt($fileUpload.get(0).files.length) > 6) {
                    alert("You can only upload a maximum of 5 files");
                    return false;
                }
            });
        });

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



        $('#add_more').click(function() {
            "use strict";
            $(this).before($("<div/>", {
                id: 'filediv'
            }).fadeIn('slow').append(
                $("<input/>", {
                    name: 'file[]',
                    type: 'file',
                    id: 'file',
                    multiple: 'multiple',
                    accept: 'image/*'
                })
            ));
        });

        $('#upload').click(function(e) {
            "use strict";
            e.preventDefault();

            if (window.filesToUpload.length === 0 || typeof window.filesToUpload === "undefined") {
                alert("No files are selected.");
                return false;
            }

            // Now, upload the files below...
            // https://developer.mozilla.org/en-US/docs/Using_files_from_web_applications#Handling_the_upload_process_for_a_file.2C_asynchronously
        });


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

        function youtubeUrl(events) {

            function getId(url) {
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
                const match = url.match(regExp);

                return (match && match[2].length === 11) ?
                    match[2] :
                    null;
            }
            const videoId = getId(events.value);

            $("#youtubeId").val(videoId);

        }

        function removeInput(event) {
            $(event).parent().remove();
        }

        function delete_item(id) {
            var name = $('.pdfName').attr('pdfName');
            if (id && name) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(isConfirmed => {
                    if (isConfirmed.value) {
                        $.ajax({
                            url: "{{ route('deletePdf') }}",
                            type: 'ajax',
                            method: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                                name: name,
                            },
                            success: function(result) {
                                console.log(result);
                                if (result == 1) {
                                    window.location.reload();
                                }
                            }
                        });
                        if (isConfirmed.value) {
                            Swal.fire(
                                'Deleted!',
                                'Tag has been deleted.',
                                'success'
                            );

                        }
                    }
                });
            }

        }



        function addpdf(event) {

            $(event).parent().before(
                ' <label class="pdf_upload w-100 p-2 input-group" for="pdf"><input type="file" name="sfiles[]" id="pdf" accept=".pdf" class="form-control border-0"><span class="input-group-addon delete-pdf" onclick="deletepdf(this)"><i class="fa fa-trash"></i></span></label>'
            );
        }


        function editPdfDelete(get) {
            let id = get.getAttribute("pdf_del");

            $("form").append("<input name='pdf_delete[]' type='hidden' value='" + id + "'>");
            get.parentElement.remove();
        }
    </script>

    <script>
        let preloaded = [
            @foreach ($default_images as $images)
                {
                    id: {{ $images->id }},
                    src: "{{ asset($images->medium_thumbnail) }}"
                },
            @endforeach
        ];
    </script>

    <script>
        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'my_files',
            preloadedInputName: 'old_files',
            maxFiles: 5
        });
    </script>
    <script>
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
    </script>
@endsection
