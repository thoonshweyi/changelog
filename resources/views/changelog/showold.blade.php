@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    {{-- <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Create Change Log</h4>
                            </div>
                        </div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div> --}}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                </div>

                <div class="col-md-8">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h2 class="fw-bold"><i class="bi bi-pencil-square me-2"></i>
                                    {{-- {{__('document.show_change_log')}} --}}
                                    ထပ်တိုးပြင်ဆင်မှု အသေးစိတ်
                                    <p class="alert alert-info mb-0">
                                         စနစ်၏အဆင့်မြှင့်တင်မှုများနှင့်ပတ်သက်သော အချက်အလက်များကို အသုံးပြုသူများ သိရှိနိုင်စေရန် ဤစာမျက်နှာကို ပြုလုပ်ထားပါသည်။ ကျေးဇူးပြု၍ အောက်ဖော်ပြပါ ပြင်ဆင်မှုများကို သေချာစွာဖတ်ရှုပြီး သဘောတူပါက "သဘောတူပါသည်" ခလုတ်ကို နှိပ်၍ ဆက်လက်ဆောင်ရွက်ပေးပါရန် မေတ္တာရပ်ခံအပ်ပါသည်။
                                    </p>
                                </h2>
                            </div>


                            <div id="changelogheader" class="card-modern">
                                <input type="hidden" id="change_log_id" name="change_log_id" value="{{ $changelog->id }}" />
                                <div class="mb-3 d-flex">
                                    <i class="fas fa-rocket fa-2x"></i>
                                    <h5 class="ml-2">{{ $changelog->title }}</h5>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-alt"></i>
                                    <h6 class="ml-2 mb-0">Published on: {{ $changelog->created_at->format('d M Y') }}</h6>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user"></i>
                                    <h6 class="ml-2 mb-0">Published by: {{ $changelog->user->name }}</h6>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-cogs"></i>
                                    <h6 class="ml-2 mb-0">Roles:
                                        {{-- @foreach($changelog->roles as $role)
                                            {{ $role->name }}
                                        @endforeach --}}
                                        @php

                                            $role_names = $changelog->roles->pluck('name')->toArray();
                                            // dd($role_names);
                                            $role_names_str = join(', ',$role_names)
                                        @endphp
                                        {{ $role_names_str }}
                                    </h6>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle"></i>
                                    <h6 class="ml-2 mb-0">{{ $changelog->description }}</h6>
                                </div>
                            </div>


                            <!-- Sub Changes -->
                            <div id="subChangeContainer">
                                <div class="card-modern">
                                    <div class="mb-3 d-flex">
                                        <i class="fas fa-list fa-2x"></i>
                                        <h5 class="ml-2">Sub Changes</h5>
                                    </div>

                                    <ul class="list-unstyled subchanges-lists">
                                        @foreach($changelog->subchanges as $subchange)
                                            <li>
                                                <div class="">
                                                    <span class="badge  {{ $subchange->changetype->id == 1 ? 'bg-danger' : ( $subchange->changetype->id == 2 ? 'bg-warning' : (  $subchange->changetype->id == 3 ? 'bg-success' : ''  )) }} badge-success">{{ $subchange->changetype->name }}</span>
                                                    <p class="d-inline"> {{  $subchange->description  }}</p>
                                                </div>
                                                <div id="previewimgs${subchangeidx}" class="previewimgs px-5">
                                                     {{-- <a href="{{ asset('images/branch_image.png') }}" data-lightbox="image-{{ $subchange->id }}"> --}}

                                                    {{-- <img src="{{ asset('./images/branch_image.png') }}" id="myImg{{ $subchange->id }}" alt="" --}}
                                                    {{-- onclick="showImageDetail({{ $subchange->id }})" --}}
                                                    {{-- /> --}}
                                                    {{-- </a> --}}

                                                    @foreach($subchange->changelogfiles as $changelogfile)
                                                        <a href="{{ asset($changelogfile->image) }}" data-lightbox="image-{{ $subchange->id }}">
                                                            <img src="{{ asset($changelogfile->image) }}" id="myImg{{ $subchange->id }}" alt=""

                                                            />

                                                        </a>
                                                    @endforeach
                                                </div>

                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>


                            <!-- Footer -->
                            <div class="text-end">
                                <a href="{{ route("changelogs.index") }}" class="btn btn-outline-dark me-2 btn-pill"><i class="bi bi-x-circle me-1"></i>Cancel</a>
                                {{-- @if(!$changelog->isRead()) --}}
                                    <button type="button" class="btn btn-success btn-pill accept_btns"><i class="bi bi-check-circle me-1"></i>သဘောတူပါသည်</button>
                                {{-- @endif --}}
                            </div>
                </div>

            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
{{-- <div class="modal fade show_image" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="show_image_div">

        </div>
    </div>
</div> --}}

@section('css')
     <!-- Lightbox2 css1 js1  -->
     <link href="{{ asset('assets/libs/lightbox2-dev/dist/css/lightbox.min.css') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('js')
    <!-- Lightbox2 css1 js1  -->
     <script src="{{ asset('assets/libs/lightbox2-dev/dist/js/lightbox.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#supplier_id').select2({
            width: '100%',
            placeholder: "Select an Supplier",
            allowClear: true,
        });


        {{-- Start Accept Button --}}
        const change_log_id = $("#change_log_id").val();
        console.log(change_log_id);
        $(".accept_btns").click(function(e){
            e.preventDefault();
            $.ajax({
                url: `/userchangelogreads/mark-read`,
                type: "POST",
                dataType:"json",
                data: {
                    change_log_id: change_log_id,
                    _token: "{{ csrf_token() }}"
                },
                success:function(response){
                    console.log(response);
                    if(response.status == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: "ကျေးဇူးတင်ပါသည်။ စနစ်၏ အဆင့်မြှင့်တင်မှုများအတွက် သဘောတူညီချက်ကို အတည်ပြုပြီးဖြစ်ပါသည်။",
                            text: "စနစ်၏ အသစ်ထည့်သွင်းထားသော လုပ်ဆောင်ချက်များကို သင်အသုံးပြုနိုင်ပါပြီ။",
                            confirmButtonText: "{{ __('message.ok') }}",
                        });
                        window.location.href = '/home';
                    }
                },
                error:function(response){
                        console.log("Error:( ",response);
                }
            });
        })
        {{-- End Accept Button --}}
    });
    function validateForm() {
        // if ($('#document_type').val() == "") {
        //     Swal.fire({
        //         icon: 'warning',
        //         title: "{{ __('message.warning') }}",
        //         text: "{{ __('message.need_document_type') }}",
        //         confirmButtonText: "{{ __('message.ok') }}",
        //     });
        //     return false;
        // }
        if ($('#document_remark').val() == "") {
            Swal.fire({
                icon: 'warning',
                title: "{{ __('message.warning') }}",
                text: "{{ __('message.need_document_remark') }}",
                confirmButtonText: "{{ __('message.ok') }}",
            });
            return false;
        }
        if ($('#category_id').val() == "") {
            Swal.fire({
                icon: 'warning',
                title: "{{ __('message.warning') }}",
                text: "{{ __('message.need_category') }}",
                confirmButtonText: "{{ __('message.ok') }}",
            });
            $('#category_id').parent().addClass("is-invalid");
            return false;
        }
    }
    {{-- function addSubChange() {
      const container = document.getElementById("subChangeContainer");
      const template = document.getElementById("subChangeTemplate").content.cloneNode(true);
      container.appendChild(template);
    } --}}

    let subchangeidx = 0;
    function addSubChange() {
      const container = document.getElementById("subChangeContainer");
      subchangeidx++;
        let html = `
            <div class="card-modern position-relative">
                <div class="d-flex justify-content-between align-items-start">
                    <h6 class="mb-2">
                        <i class="fas fa-angle-double-right fa-2x"></i>
                        Sub Change</h6>
                    <button type="button" class="action-icon" onclick="removeSubChange(this)" title="Remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>

                <div id="previewimgs${subchangeidx}" class="previewimgs"></div>
                <textarea rows="2" name="subchanges[${subchangeidx}]" class="form-control" placeholder="Describe this sub-change..."></textarea>


                <label for="subchangelbl${subchangeidx}">
                    <span type="button" class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                </label>
                <div class="dropdown d-inline">
                    <a href="javascript:void(0);" id="lbltext${subchangeidx}" class="badge bg-light dropdown-togglessss" data-toggle="dropdown">No Label</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item d-flex align-items-center"> <input type="radio" id="check${subchangeidx}-1"  name="checks[${subchangeidx}]" class="form-check-input checks" value="1"  data-subchangeidx = "${subchangeidx}"/> <label class="m-0" for="check${subchangeidx}-1"><a class="badge bg-danger">Bug Fixes</a></label> </li>
                        <li class="dropdown-item d-flex align-items-center"> <input type="radio" id="check${subchangeidx}-2"   name="checks[${subchangeidx}]" class="form-check-input checks" value="2"  data-subchangeidx = "${subchangeidx}"/> <label class="m-0" for="check${subchangeidx}-2"><a class="badge bg-warning">Improvements</a></label> </li>
                        <li class="dropdown-item d-flex align-items-center"> <input type="radio" id="check${subchangeidx}-3"  name="checks[${subchangeidx}]" class="form-check-input checks" value="3"  data-subchangeidx = "${subchangeidx}"/>  <label class="m-0" for="check${subchangeidx}-3"><a class="badge bg-success">New Feature</a></label> </li>
                    </ul>
                </div>
                <input type="file" id="subchangelbl${subchangeidx}" name="subchangesimgs[${subchangeidx}][]" class="form-control d-none subchangesimgs" multiple data-subchangeidx = "${subchangeidx}" />
            </div>
        `;

        $("#subChangeContainer").append(html);
    }

    function removeSubChange(button) {
      const card = button.closest(".card-modern");
      card.remove();
    }


    {{-- Start Preview Image --}}

        var previewimages = function(input,output){

            // console.log(input.files);

            if(input.files){
                    var totalfiles = input.files.length;
                    // console.log(totalfiles);
                    if(totalfiles > 0){
                        $('.gallery').addClass('removetxt');
                    }else{
                        $('.gallery').removeClass('removetxt');
                    }
                    console.log(input.files);

                    for(let i = 0 ; i < totalfiles ; i++){
                        var filereader = new FileReader();


                        filereader.onload = function(e){
                            // $(output).html("");
                            {{-- console.log(input.files[i].type) --}}
                            if(input.files[i].type == 'application/pdf'){
                                $($.parseHTML('<img>')).attr({
                                    'src':'{{ asset('images/pdf-icon.png') }}',
                                    'title': `${input.files[i].name}`
                                }).appendTo(output);
                            }else{
                                $($.parseHTML('<img>')).attr({
                                    'src':e.target.result,
                                    'title': `${input.files[i].name}`
                                }).appendTo(output);
                            }
                        }

                        filereader.readAsDataURL(input.files[i]);

                    }
            }

        };

        $(document).on('change','.subchangesimgs',function(){
            let subchangeidx = $(this).data('subchangeidx')
            console.log(subchangeidx);
            previewimages(this,'#previewimgs'+subchangeidx);
        });
        {{-- End Preview Image --}}


        $(document).on('change','.checks',function(){
            console.log('adsf')
            let subchangeidx = $(this).data('subchangeidx')
            let labeltext = $(this).parent().find('a').text();
            {{-- console.log(labeltext); --}}

            let lblcolor = $(this).parent().find('a').attr("class");
            {{-- console.log(lblcolor) --}}

            $("#lbltext"+subchangeidx).text(labeltext);
            $("#lbltext"+subchangeidx).attr('class',lblcolor);
        })


        {{-- function showImageDetail(id)
        {

            var src = $('#myImg'+id).attr("src");
            console.log(src);
            if(src.substr(-3) == 'mp4') {
                $('#show_image_div').html('');
                $('#show_image_div').append(`
                    <iframe class="rounded img-fluid" id="table_image" src="" alt="profile" style="height: 750px; width: 100%;" frameborder="0" scrolling="no">
                `);
            }else{
                $('#show_image_div').html('');
                $('#show_image_div').append(`
                    <img class="rounded img-fluid" id="table_image" src="" alt="profile" width="" height="" style="text-align:center;">
                `);

            }
            $("#table_image").prop('src', src);
            $('.show_image').modal('show');
        } --}}
        lightbox.option({
               'resizeDuration': 100,
               // 'wrapAround': true
          })
</script>
@endsection
