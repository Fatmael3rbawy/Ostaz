
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <div class="multisteps-form__content">
                            <div class="form-group">
                                <label class="form-control-label">Avtar</label>
                                @if(request()->query('view'))
                                <br><img src="{{ asset($user->attachments()->where('key', 'avatar')->first()->file ?? '') }}" alt="Instructor Image" class="border-radius-lg shadow-sm" width="100" height="100">
                               @endif
                                <input class="form-control" type="file" name="image">
                                @error('image')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input class="form-control" type="text" name="name" 
                                {{-- @if(request()->query('view')=='upgrade') --}}
                                value="{{ $user->name ?? ''}}"
                                {{-- @endif --}}
                                    required>
                                @error('name')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input class="form-control" type="email" name="email" 
                                {{-- @if(request()->query('view')=='upgrade') --}}
                                value="{{ $user->email ?? '' }}"
                                {{-- @endif --}}
                                    required>
                                @error('email')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="row mt-3">

                                <div class="col-12 col-sm-6">
                                    <label>Phone Number</label>
                                    <input class="multisteps-form__input form-control" type="text" name="phone"
                                    value="{{ $user->phone ?? '' }}" required /> 
                                    @error('phone')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label>WhatsApp Number</label>
                                    <input class="multisteps-form__input form-control" type="text" name="whatsapp"
                                        value="{{ $user->whatsapp ?? ''}}"/>
                                    @error('whatsapp')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Facebook Account</label>
                                <input class="form-control" type="text" name="facebook" value="{{ $user->facebook ?? ''}}" >
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
                                    <select class="multisteps-form__select form-control" name="city" onchange="changeArea(this)">
                                       
                                        <option value="">Choose City</option>
                                        @foreach ($cities as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                    <label>Area</label>
                                    <select id="areaSelect" class="multisteps-form__select form-control" name="areas[]" multiple>
                                        @foreach ($areas as $item)
                                        <option class="c{{$item->city->id }}" value="{{$item->id}}">{{$item->area}}</option>
                                        @endforeach
                                    </select>
                                    @error('area')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                    <label>Category</label>
                                    <select class="multisteps-form__select form-control" name="specialization" onchange="changeCategory(this)">
                                       
                                        <option value="">Choose Category</option>
                                        @foreach ($specializations as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('specialization')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Sub Category</label>
                                    <select id="subcategorySelect" class="multisteps-form__select form-control" name="subspecializations[]" multiple>
                                        @foreach ($subspecializations as $item)
                                          <option class="subC{{$item->mainSpecialization->id}}" value="{{$item->id}}"> {{$item->name}}</option>
                                        @endforeach
                                       </select>
                                    @error('subspecializations')
                                        <br><label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>Methods </label>
                                <select  class="multisteps-form__select form-control" name="methods[]" multiple>
                                    @foreach ($methods as $item)
                                      <option value="{{$item->id}}"> {{$item->name}}</option>
                                    @endforeach
                                   </select>
                                @error('methods')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="button-row  mt-3 ">
                                <button type="submit" style="width: 90%" class="btn btn-primary ">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
