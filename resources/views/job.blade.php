@extends('layouts.nav')

@section('content')
	<!-- Start post Area -->
    <section class="post-area section-gap">
				<div class="container">
					<div class="row justify-content-center d-flex">
						<div class="col-lg-8 post-list">
							<ul class="cat-list">
								<li><a href="#">Recent</a></li>
								<li><a href="#">Full Time</a></li>
								<li><a href="#">Intern</a></li>
								<li><a href="#">part Time</a></li>
							</ul>
					@foreach ($r  as $row)
							<div class="single-post d-flex flex-row">
								<div class="thumb">
									<img src="img/post.png" alt="">
									<ul class="tags">
										<li>
											<a href="#">Art</a>
										</li>
										<li>
											<a href="#">Media</a>
										</li>
										<li>
											<a href="#">Design</a>
										</li>
									</ul>
								</div>
								<div class="details">
									<div class="title d-flex flex-row justify-content-between">
										<div class="titles">
                                        <a href="#" ><h4>{{ $row['jobTitle']}}</h4></a>
											<h6> {{ $row['companyName'] }}</h6>
										</div>
										<ul class="btns">
											<li><a href="{{ route('login') }}"><span class="lnr lnr-heart"></span></a></li>
											<li><a href="{{ route('login') }}">Apply</a></li>
										</ul>
									</div>
									<p>
										{{ $row['fullDescription'] }}
									</p>
									<h5>Job Nature: {{ $row['type'] }}</h5>
									<p class="address"><span class="lnr lnr-map"></span>Location: {{ $row['location'] }}</p>
									<p class="address"><span class="lnr lnr-database"></span>Salary R {{ $row['salary'] }}</p>

                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" >
                                Open modal
                              </button>

                              <!-- The Modal -->
                              <div class="modal fade" id="myModal">
                                <div class="modal-dialog modal-sm">
                                  <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Modal Heading</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="single-post d-flex flex-row">
                                            <div class="thumb">
                                                <img src="img/post.png" alt="">
                                                <ul class="tags">
                                                    <li>
                                                        <a href="#">Art</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Media</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Design</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="details">
                                                <div class="title d-flex flex-row justify-content-between">
                                                    <div class="titles">
                                                    <a href="#" data-toggle="modal" data-target="#myModal"><h4>{{ $row['jobTitle']}}</h4></a>
                                                        <h6> {{ $row['companyName'] }}</h6>
                                                    </div>
                                                    <ul class="btns">
                                                        <li><a href="{{ route('login') }}"><span class="lnr lnr-heart"></span></a></li>
                                                        <li><a href="{{ route('login') }}">Apply</a></li>
                                                    </ul>
                                                </div>
                                                <p>
                                                    {{ $row['fullDescription'] }}
                                                </p>
                                                <h5>Job Nature: {{ $row['type'] }}</h5>
                                                <p class="address"><span class="lnr lnr-map"></span>Location: {{ $row['location'] }}</p>
                                                <p class="address"><span class="lnr lnr-database"></span>Salary R {{ $row['salary'] }}</p>

                                            </div>
                                        </div>

                                        <div class="single-post job-details">
                                            <h4 class="single-title">Whom we are looking for</h4>
                                            <p>
                                                {{ $row['fullDescription'] }}
                                            </p>

                                        </div>
                                        <div class="single-post job-experience">
                                            <h4 class="single-title">Experience Requirements</h4>
                                            <ul>
                                                <li>
                                                    <img src="img/pages/list.jpg" alt="">
                                                    <span>{{ $row['experience'] }}</span>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="single-post job-experience">
                                            <h4 class="single-title">Education Requirements</h4>
                                            <ul>
                                                <li>
                                                    <img src="img/pages/list.jpg" alt="">
                                                    <span>{{ $row['skills'] }}</span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>

                                  </div>
                                </div>
                              </div>
						@endforeach
@endsection
