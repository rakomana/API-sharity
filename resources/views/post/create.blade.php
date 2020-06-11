@extends('layouts.nav')

@section('content')
<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
                            @if (Auth::user()->type == 1) 
                                <div class="row d-flex align-items-center justify-content-center">
                                   <h2 class="text-white">Add New Job Post</h2>
                                </div>
                            @endif
                          @if (Auth::user()->type == 0)
                             <div class="row d-flex align-items-center justify-content-center">
                                <h2 class="text-white">Create CV</h2>
                            </div>
                         @endif
                        </div>											
					</div>
				</div>
			</section>
			
<div class="row">
    <div class="col-lg-12 margin-tb">
    @if (Auth::user()->type == 1) 
        <div class="pull-left">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('post.index') }}"> My posts</a>
        </div>
        @endif
       @if (Auth::user()->type == 0)
        <div class="pull-left">
            <a class="btn btn-primary" href="{{ url('cv') }}"> My CV</a>
        </div>
        @endif
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Auth::user()->type == 1) 
<form action="{{ route('post.store') }}" method="POST">
    @csrf


    <div class="row">
        <div class="col-md-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Job Title:</strong>
                    <input type="text" name="jobTitle" class="form-control" placeholder="jobTitle">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control" type="text" name="companyName" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Location:</strong>
                    <input class="form-control" type="text" name="location" placeholder="Location">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Salary:</strong>
                    <input class="form-control" type="text" name="salary" placeholder="Salary">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone Number:</strong>
                    <input class="form-control" type="text" name="phoneNumber" placeholder="phone numbers">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control" type="text" name="email" placeholder="contact email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Full job description:</strong>
                    <textarea class="form-control" type="text" name="fullDescription" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Experience:</strong>
                    <textarea class="form-control" type="text" name="experience" placeholder="Job Experience"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Skills:</strong>
                    <textarea class="form-control" type="text" name="skills" placeholder="skills"></textarea>
                </div>
            </div>
            <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Employment Type:</strong>
                    <select  class="form-control"  name="type"   placeholder="Employment type">
                        <option value="Permanent" >Permanent</option>
                        <option value="Contract">Contract</option>
                        <option value="Casual">Casual</option>
                        <option value="Internship">Internship</option>
                        <option value="Learnership">Learnership</option>
                        <option value="Part_Time">Part Time</option>
                        <option value="Volunteer">Volunteer</option>
                    </select>
                </div>
            </div>

        </div>

      </div>
</form>
@endif


@if (Auth::user()->type == 0)
<br><br>
<form method="get" action="{{ url('curriculum')}}">{{csrf_field()}}<button type="submit" class="btn btn-primary">get cv</button></form>
<form method="post" action="{{ url('curriculum/self')}}">{{csrf_field()}}<div class="form-group">
        <label for="full" >{{ __('First') }}</label>
        <input id="full" type="text" class="form-control" name="full">
    </div><button type="submit" class="btn btn-primary">update cv</button>
</form>
<form method="post" action="{{ url('curriculum/video-cv')}}" enctype="multipart/form-data">{{csrf_field()}}
    <div class="form-group">
        <label for="cc_a" >{{ __('Additional Documents') }}</label>
        <input id="cc_a" type="file" class="form-control @error('cc_a') is-invalid @enderror" name="cc_a" value="{{ old('cc_a') }}" required autocomplete="cc_a" autofocus>
    </div>
    <button type="submit" class="btn btn-primary">update video-cv</button>
</form>
<form method="post" action="{{ url('curriculum/video-cv/remove')}}">{{csrf_field()}}<button type="submit" class="btn btn-primary">delete video-cv</button></form>
<form method="post" action="{{ url('curriculum/self/remove')}}">{{csrf_field()}}<button type="submit" class="btn btn-primary">delete cv</button></form>

<form method="post" action="{{ url('curriculum')}}" enctype="multipart/form-data">
{{csrf_field()}}  
    <div class="form-group">
        <label for="full" >{{ __('First') }}</label>
        <input id="full" type="text" class="form-control" name="full">
    </div>

    <div class="form-group">
        <label for="cc_a" >{{ __('Additional Documents') }}</label>
        <input id="cc_a" type="file" class="form-control @error('cc_a') is-invalid @enderror" name="cc_a" value="{{ old('cc_a') }}" required autocomplete="cc_a" autofocus>
    </div>
    <div class="form-group mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('submit') }}
            </button>
        </div>
    </div>
</form>
@endif
@endsection
