<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('user_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/style.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{asset('user_assets/css/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('user_assets/css/slick-theme.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I&libraries=places"></script>

    <title>Our Postcode</title>
    <style>
        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            top: 61%;
            left: 0;
            right: 0;
        }


        .autocomplete-items div {
            padding: 5px;
            cursor: pointer;
            background-color: #dadada;
            border-bottom: 1px solid #d4d4d4 !important;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <section class="banner_wraper">
        <div class="container">
            <div class="menu_wrap">
                <a href="{{route('user.welcome')}}" class="logo_icon"><img src="{{asset('user_assets/image/logo.png')}}"></a>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="banner_inner">
                        <h2 class="banner_title font-bebas text-white">OUR POSTCODE</h2>
                        <h2 class="banner_title2 text-white">Where Local Matters</h2>
                        <p class="banner_content text-white">Australia’s Newest Website to Help Local Businesses Promote Achieve Marketing Success</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
              
                    <div class="form_wrapper">
                        <img src="{{asset('user_assets/image/form-border.png')}}" class="form_bg">
                        <form class="needs-validation" method="post" name="" action="{{route('admin.add_userbusiness')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if(Route::current()->getName() == 'GMBsignup')
                            <!--Longitude Latitude-->
                            
                            <input type="hidden" name="longitude" id="selectedLongitude" value="">
                            <input type="hidden" name="latitude" id="selectedLatitude" value="">
                            {{-- <input type="hidden" name="pincode" id="pincode" value=""> --}}

                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/Science-Business-icon.png')}}">
                                {{-- <label>BUSINESS NAME</label> --}}
                                <input type="text" name="name" value="{{old('name')}}" id="inputSearchTextFilter" class="textbox" placeholder="BUSINESS NAME" autofocus required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @else
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/Science-Business-icon.png')}}">
                                {{-- <label>BUSINESS NAME</label> --}}
                                <input type="text" name="name" value="{{old('name')}}" id="name" class="textbox" required placeholder="BUSINESS NAME">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                            
                            <div class="sign_in_form">
                                {{-- <img src="{{asset('user_assets/image/Science-Business-icon.png')}}"> --}}
                                {{-- <label>BUSINESS Category</label> --}}
                                <select id="business_categoryId" name="business_categoryId" class="form-control" required="">
                                    <option value="{{ old('business_categoryId') }}">SELECT BUSINESS CATEGORY</option>
                                    @foreach($businessCategories as $businessCategory)
                                    <option value="{{$businessCategory->id}}">{{$businessCategory->name}}</option>
                                    @endforeach
                                </select>
                                @error('business_categoryId')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/email-icon.png')}}">
                                {{-- <label>ADDRESS</label> --}}
                                <input type="text" name="address" value="{{ old('address') }}" id="address" class="textbox" maxlength="255" placeholder="ADDRESS" required>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            

                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/email-icon.png')}}">
                                {{-- <label>pincode</label> --}}
                                <input type="text" name="pincode" value="{{ old('pincode') }}" id="pincode" class="textbox" maxlength="4" placeholder="PINCODE" onkeypress="return isNumberKey(event);" required>
                                @error('pincode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/abn.png')}}">
                                {{-- <label>ABN</label> --}}
                                <input type="text" name="abn" value="{{ old('abn') }}" id="abn" class="textbox" onkeypress="return isNumberKey(event);" placeholder="ABN">
                                @error('abn')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/team.png')}}">
                                {{-- <label>COMPANY WEBSITE</label> --}}
                                <input type="text" name="company_website" value="{{ old('company_website') }}" id="company_website" class="textbox" placeholder="COMPANY WEBSITE">
                                @error('company_website')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/email-icon.png')}}">
                                {{-- <label>EMAIL ADDRESS</label> --}}
                                <input type="email" name="email" value="{{ old('email') }}" id="email" class="textbox" required placeholder="EMAIL ADDRESS">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/Science-Business-icon.png')}}">
                                {{-- <label>PHONE NO.</label> --}}
                                <input type="text" name="mobile" value="{{ old('mobile') }}" id="mobile" class="textbox" onkeypress="return isNumberKey(event);" placeholder="PHONE NO." required>
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/upload.png')}}">
                                <label>UPLOAD AN IMAGE</label>
                                <input type="file" name="image" value="{{ old('image') }}" id="image" required class="textbox">
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div id="file-upload-filename"></div>
                                <button class="img_upload">BROWSE</button>
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/clock.png')}}">
                                {{-- <label>opening hours</label> --}}
                                <input type="time" name="open_hour" value="{{ old('open_hour') }}" id="open_hour" class="textbox" required placeholder="OPENING HOUR" onkeypress="return false;">
                                @error('open_hour')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form_btn-grp">
                                <a href="{{route('user.welcome')}}" class="back_btn">back</a>
                                <input type="submit" class="form_submit" name="" value="SUBMIT">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature_wrapper feature_wrapper-mod">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h2 class="section_title text-center">TOP features</h2>
                    <p class="section_content">Donec orci nisl, porttitor vel consequat vitae, aliquet vel sapien. Sed et posuere libero, in vulputate nibh sed ut ornare dolor liquam nisi enim.</p>
                </div>
                <div class="col-12">
                    <ul class="feature_list">
                        <li>
                            <img src="{{asset('user_assets/image/online-ads-concept-illustration_114360-5188.png')}}">
                            <h5>ADVERTISE YOUR BUSINESS</h5>
                            <p>When designing a new business website, there are certain things you have to keep in mind. Style, layout and accessibility all have their roles to play in helping it look slick, so let’s take a look at them now. Time to get your business online and looking fine!</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                        <li>
                            <img src="{{asset('user_assets/image/colleagues-working-together-workflow-organization-effective-task-planning.png')}}">
                            <h5>VIEW EVENTS IN YOUR AREA</h5>
                            <p>When designing a new business web-site, there are certain...</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                        <li>
                            <img src="{{asset('user_assets/image/employees-giving-hands-helping.png')}}">
                            <h5>CONNECT WITH YOUR COMMUNITY</h5>
                            <p>When designing a new business web-site, there are certain things....</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                        <li>
                            <img src="{{asset('user_assets/image/feedback-isometric-illustration-customers.png')}}">
                            <h5>REVIEW LOCAL BUSINESS</h5>
                            <p>When designing a new business website, there are certain things you have to keep in mind. Style, layout and accessibility all have their roles to play in helping it look slick, so let’s take a look at them now. Time to get your business online and looking fine!</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 text-center">
                    <a href="#" class="orange_btn text-capitalize">More Features</a>
                </div>
            </div>
        </div>
    </section>

    
    <section class="newsletter_wraper">
        @include('user.newsletter')
    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- latest jquery-->
    <script src="{{asset('user_assets/js/jquery-3.2.1.min.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{asset('user_assets/js/slick.min.js')}}"></script>

    <script>
        // AutoComplete Start

        google.maps.event.addDomListener(window,'load',initialize);

        function initialize(){

            var autocomplete= new google.maps.places.Autocomplete(document.getElementById('inputSearchTextFilter'));

            google.maps.event.addListener(autocomplete, 'place_changed', function(){

                var places = autocomplete.getPlace();
                console.log(places);
                // console.log(places.formatted_address);
                // console.log(places.address_components.length);
                addressObj = places.address_components;
                // console.log(addressObj);
                addressObjLength = places.address_components.length;
                // console.log(addressObj.addressObjlength);
                for (let index = 0; index < addressObjLength; index++) {
                    if(index = addressObjLength-1) {
                        const pinCode = addressObj[index].long_name;
                        console.log(pinCode);
                        $("#pincode").val(pinCode)
                    }
                }
                // console.log(places.website);
                $('#inputSearchTextFilter').val(places.name);
                $('#company_website').val(places.website);
                $('#address').val(places.formatted_address);

                if(places.formatted_phone_number){
                    function phpneNumberFormatted(phNum){
                        var i,newValue='';
                        for(i = 0; i < phNum.length; i++){
                            if($.isNumeric(phNum[i])){
                                newValue+=phNum[i];
                            }
                        }
                        return newValue;
                    }
                    var phNum = phpneNumberFormatted(places.formatted_phone_number);
                    // console.log(phNum);
                
                    $('#mobile').val(phNum);
                } else {
                    $('#mobile').val('');
                }
                
                $('#selectedLongitude').val(places.geometry.location.lng());

                $('#selectedLatitude').val(places.geometry.location.lat());

            });

        }

    </script>

    <script>
        $('.textbox').on('keyup keydown keypress change paste', function() {
            if ($(this).val() == '') {
                $(this).parent().removeClass('label_up');
            } else {
                $(this).parent().addClass('label_up');
            }
        });

        var input = document.getElementById('image');
        var infoArea = document.getElementById('file-upload-filename');

        input.addEventListener('change', showFileName);

        function showFileName(event) {

            // the change event gives us the input it occurred in 
            var input = event.srcElement;

            // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
            var fileName = input.files[0].name;

            // use fileName however fits your app best, i.e. add it into a div
            infoArea.textContent = 'File name: ' + fileName;
        }

        $(document).ready(function() {
            // $("#course_butt").click(function() {
            //             var business_search = $("#business_search").val();
            //             if (business_search != '') {
            //                 window.location = "/business_search/" + business_search;
            //             }
            //         });
        });
    </script>
    <script>
        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
             the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                //alert(val.length);
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                if (val.length < 2) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                // a.setAttribute("class", "");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    var arr_val = arr[i].toUpperCase();
                    var vall = val.toUpperCase();
                    var res = arr_val.match(vall);

                    if (res != null) {
                        var searched_item = arr[i];
                        var strong_val = "<span style='font-weight:bolder;color: #2579d3;' >" + val + "</span>"
                        var after_search = searched_item.replace(val, strong_val);

                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");

                        /*make the matching letters bold:*/
                        // b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML = after_search;
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "' >";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {

                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                             (or any other open lists of autocompleted values:*/
                            closeAllLists();
                            // window.location = "/business_search/" + inp.value;
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x)
                    x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                     increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                     decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x)
                            x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x)
                    return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length)
                    currentFocus = 0;
                if (currentFocus < 0)
                    currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                 except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);

            });
        }
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "/search_main",
            type: "post",
            data: {
                '_token': token
            },
            success: function(response) {
                autocomplete(document.getElementById("business_search"), response);

            }
        });
    </script>
    <script>
        function isNumberKey(evt){
            if(evt.charCode >= 48 && evt.charCode <= 57){
                return true;
            }
            return false;
        }
    </script>
</body>

</html>