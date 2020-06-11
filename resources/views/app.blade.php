@extends('layouts.nav')

@section('content')

<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
                                <div class="row d-flex align-items-center justify-content-center">
                                   <h2 class="text-white">job Seekers</h2>
                                </div>
                          
                        </div>											
					</div>
				</div>
            </section>
    @foreach ($r as $row)
    @if ($row->posts['user_id'] == Auth::user()->id)
    <video width="320" height="240" controls>
        <source src="{{asset('uploads/p/'. $row->cc_v)}}" type="video/mp4">
    </video>
    @endif
    @endforeach 
<table class="table table-bordered">
        <tr>
            <th>CV</th>
            <th>Additional Documents</th>
            <th>Salary</th>
            <th>Address</th>
            <th>Contract</th>
            <th>Field</th>
            <th>Category</th>
            <th>ID</th>
        </tr>

        @foreach ($r as $row)
        @if ($row->posts['user_id'] == Auth::user()->id && $row->posts->id == $row->mixs->v_id)

        <tr>
            <td>{{ $row['cc_d'] }}</td>
            <td>{{ $row['cc_a'] }}</td>
            <td>{{ $row['cc_usal'] }}</td>
            <td>{{ $row['cc_usk'] }}</td>
            <td>{{ $row['cc_uicon'] }}</td>
            <td>{{ $row['cc_ufield'] }}</td>
            <td>{{ $row['cc_uijob'] }}</td>
            <td>{{ $row['cc_ui'] }}</td>
        </tr>
        
        @endif
        @endforeach
    </table>

@endsection
