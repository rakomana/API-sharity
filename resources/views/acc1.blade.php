@extends('layouts.nav')

@section('content')
<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
                            
                                <div class="row d-flex align-items-center justify-content-center">
                                   <h2 class="text-white">My CV</h2>

                                </div>

                        </div>											
					</div>
				</div>
            </section>
            @foreach($r as $read)
                <video width="320" height="240" controls>
                    <source src="{{$read->getFirstMediaUrl('images')}}" type="video/mp4">
                </video> 
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
            <th>Delete</th>
        </tr>
        @foreach ($r as $row)
        <tr>
            <td>{{$row->getFirstMediaUrl('images')}}</td><!--{{$row->getMedia('images')}}-->
            <td>{{ $row['cc_a'] }}</td>
            <td>{{ $row['cc_usal'] }}</td>
            <td>{{ $row['cc_usk'] }}</td>
            <td>{{ $row['cc_uicon'] }}</td>
            <td>{{ $row['cc_ufield'] }}</td>
            <td>{{ $row['cc_uijob'] }}</td>
            <td>{{ $row['cc_ui'] }}</td>
            <td><button type="submit" href class="btn btn-danger">Delete</button> </td>
        </tr>
        @endforeach
    </table>

    <script>
        
    </script>
@endsection