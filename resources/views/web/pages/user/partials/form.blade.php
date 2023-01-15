<form method="POST" action="{{ route('instructors.upgrade') }}" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">

                        <div class="multisteps-form__content">
                            <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $user->name }}"
                                    required>
                                @error('name')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input class="form-control" type="email" name="email" value="{{ $user->email }}"
                                    required>
                                @error('email')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="row mt-3">

                                <div class="col-12 col-sm-6">
                                    <label>Phone Number</label>
                                    <input class="multisteps-form__input form-control" type="text" name="phone"
                                        value="{{ $user->phone }}" required />
                                    @error('phone')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>


                                <div class="col-12 col-sm-6">
                                    <label>WhatsApp Number</label>
                                    <input class="multisteps-form__input form-control" type="text" name="whatsapp"
                                        value="{{ $user->whatsapp }}" required />
                                    @error('whatsapp')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Facebook Account</label>
                                <input class="form-control" type="text" name="facebook" required>
                                @error('facebook')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Country</label>
                                    <select class="multisteps-form__select form-control" name="country">
                                        <option> egypt</option>                                     
                                    </select>
                                    @error('country')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                    <label>City</label>
                                    <select class="multisteps-form__select form-control" name="city">
                                        <option selected="selected">masr</option>
                                        <option value="1">State 1</option>
                                        <option value="2">State 2</option>
                                    </select>
                                    @error('city')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                    <label>Area</label>
                                    <select class="multisteps-form__select form-control" name="area">
                                        <option selected="selected">masr</option>
                                        <option value="1">State 1</option>
                                        <option value="2">State 2</option>
                                    </select>
                                    @error('area')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Seciaization</label>
                                    <select class="multisteps-form__select form-control" name="specializatin">

                                        <option> egypt</option>
                                        <option> egypt</option>
                                        <option> egypt</option>

                                    </select>
                                    @error('specializatin')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="button-row  mt-3 ">
                                <button type="submit" class="btn btn-primary ">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <!--progress bar-->
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                        <div class="multisteps-form__progress">
                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                <span>User Info</span>
                            </button>
                            <button class="multisteps-form__progress-btn" type="button" title="Address">Address</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Socials">Socials</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Profile">Profile</button> 
                        </div>
                    </div>
                </div>
                <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form mb-8">
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">About me</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label> Name</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                             name="name" value="{{$user->name}}" required  />
                                                 @error('name')
                                                <br><label style="color: red">{{ $message }}</label>
                                                @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="row mt-3">
                                        
                                        <div class="col">
                                            <label>Email Address</label>
                                            <input class="multisteps-form__input form-control" type="email" name="email"
                                            value="{{$user->email}}" required />
                                            @error('email')
                                            <br><label style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        
                                        <div class="col-12 col-sm-6">
                                            <label>Phone Number</label>
                                            <input class="multisteps-form__input form-control" type="text" name="phone"
                                            value="{{$user->phone}}" required />
                                            @error('phone')
                                            <br><label style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                   
                                        
                                        <div class="col-12 col-sm-6">
                                            <label>WhatsApp Number</label>
                                            <input class="multisteps-form__input form-control" type="text" name="whatsapp"
                                            value="{{$user->whatsapp}}" required />
                                            @error('whatsapp')
                                            <br><label style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn btn-primary  ms-auto mb-0 js-btn-next" type="button"
                                            title="Next">Next</button>
                                    </div>
                                </div>
                            </div>
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder">Address</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label>Address 1</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="eg. Street 111" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label>Address 2</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="eg. Street 221" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>City</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="eg. Tokyo" />
                                        </div>
                                        <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                            <label>State</label>
                                            <select class="multisteps-form__select form-control">
                                                <option selected="selected">...</option>
                                                <option value="1">State 1</option>
                                                <option value="2">State 2</option>
                                            </select>
                                        </div>
                                        <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                            <label>Zip</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="7 letters" />
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                            title="Prev">Prev</button>
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                            title="Next">Next</button>
                                    </div>
                                </div>
                            </div>
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder">Socials</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label>Twitter Handle</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="@soft" />
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label>Facebook Account</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="https://..." />
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label>Instagram Account</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="https://..." />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="button-row d-flex mt-4 col-12">
                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--single form panel-->
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder">Profile</h5>
                                <div class="multisteps-form__content mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Public Email</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="Use an address you don't use frequently." />
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label>Bio</label>
                                            <textarea class="multisteps-form__textarea form-control" rows="5"
                                                placeholder="Say a few words about who you are or what you're working on."></textarea>
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                            title="Prev">Prev</button>
                                        <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                            title="Send">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
