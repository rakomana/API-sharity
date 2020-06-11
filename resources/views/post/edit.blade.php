@extends('layouts.nav')
@section('content')


<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Edit Job Posts
                </h1>

            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('post.index') }}"> Back</a>
            </div>
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

    <form action="{{ route('post.update',$post['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Job Title:</strong>
                    <input type="text" name="jobTitle" value="{{ $post['jobTitle'] }}" class="form-control" placeholder="Job Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control" type="text" name="companyName" value="{{ $post['companyName'] }}" placeholder="Name">
                </div>
            </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Location:</strong>
                    <input type="text" name="location" value="{{ $post['location'] }}" class="form-control" placeholder="Location">
                </div>
            </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Salary:</strong>
                    <input type="text" name="salary" value="{{ $post['salary'] }}" class="form-control" placeholder="Salary">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone Numbers:</strong>
                    <input type="text" name="phoneNumber" value="{{ $post['phoneNumber'] }}" class="form-control" placeholder="Phone numbers">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $post['email'] }}" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
            <div class="col-md-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Full description:</strong>
                    <textarea type="text" name="fullDescription" value="{{ $post['fullDescription'] }}" class="form-control" placeholder="description"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Experience:</strong>
                    <textarea type="text" name="experience" value="{{ $post['experience'] }}" class="form-control" placeholder="Experience"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Skills:</strong>
                    <textarea type="text" name="skills" value="{{ $post['skills']}}" class="form-control" placeholder="Skills"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Employment Type:</strong>
                    <select  class="form-control"  name="type" value="{{ $post['type']}}"  placeholder="Employment type">
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
    </div>
    </form>
@endsection
