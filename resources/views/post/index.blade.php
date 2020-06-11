@extends('layouts.nav')

@section('content')
<br>
<br>
<br>

        <!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Active Job Posts
							</h1>
							<p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="single.html"> Job Details</a></p>
						</div>
					</div>
				</div>
			</section>
            <!-- End banner Area -->

    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('post.create') }}"> Create New Job Post</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Job Title</th>
            <th>Name</th>
            <th>Location</th>
            <th>Salary</th>
            <th>Description</th>
            <th>Experience</th>
            <th>Skills</th>
            <th>Type</th>
            <th>Phone Nubera</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($user as $r)
        <tr>
            <td>{{ $r['jobTitle']}}</td>
            <td>{{ $r['companyName'] }}</td>
            <td>{{ $r['location'] }}</td>
            <td>{{ $r['salary'] }}</td>
            <td>{{ $r['fullDescription'] }}</td>
            <td>{{ $r['experience'] }}</td>
            <td>{{ $r['skills'] }}</td>
            <td>{{ $r['type'] }}</td>
            <td>{{ $r['phoneNumber'] }}</td>
            <td>{{ $r['email'] }}</td>
            <td>
                <form action="{{ route('post.destroy',$r['id']) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('post.show',$r['id']) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('post.edit',$r['id']) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td> 
        </tr>
        @endforeach
    </table>



@endsection
