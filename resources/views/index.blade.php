
@extends('layouts.nav')
@section('content')

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-12">
						<h1 class="text-white">
								<span><?php
                                    $val = count($r);
                                    echo "$val"; ?></span> Jobs posted last week
							</h1>
							<form action="{{url('search')}}" class="serach-form-area" method="POST" role="search">
								{{ csrf_field() }}
								<div class="row justify-content-center form-wrap">
									<div class="col-lg-4 form-cols">
										<input type="text" class="form-control" name="q" placeholder="what are you looging for?"><span class="input-group-btn">
									</div>
									<div class="col-lg-3 form-cols">
										<div class="default-select" id="default-selects">
											<select>
												<option value="1">Select Provence</option>
												<option value="2">Gauteng</option>
												<option value="3">Limpopo</option>
												<option value="4">North West</option>
												<option value="5">Natal</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 form-cols">
										<div class="default-select" id="default-selects2">
											<select>
												<option value="1">All Category</option>
												<option value="2">Medical</option>
												<option value="3">Technology</option>
												<option value="4">Goverment</option>
												<option value="5">Development</option>
											</select>
										</div>
									</div>
									<div class="col-lg-2 form-cols">
									    <button type="submit" class="btn btn-info">
									      <span class="lnr lnr-magnifier"></span> Search
									    </button>
									</div>
								</div>
							</form>
							<p class="text-white"> <span>Search by tags:</span> Tecnology, Business, Consulting, IT Company, Design, Development</p>
						</div>
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start features Area -->
			<section class="features-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Searching</h4>
								<p>
								To be given To be given To be given, To be given.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Applying</h4>
								<p>
								To be given To be given To be given be given.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Security</h4>
								<p>
								To be given To be given To be given To be given.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Notifications</h4>
								<p>
								To be given To be given To be given To be given.
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End features Area -->

			<!-- Start popular-post Area -->
			<section class="popular-post-area pt-100">
				<div class="container">
					<div class="row align-items-center">
						<div class="active-popular-post-carusel">
							<div class="single-popular-post d-flex flex-row">
								<div class="thumb">
									<img class="img-fluid" src="img/p1.png" alt="">
								</div>
								<div class="details">
									<a href="#"><h4>About us</h4></a>
									<p>
										To be given
									</p>
								</div>
							</div>
							<div class="single-popular-post d-flex flex-row">
								<div class="thumb">
									<img src="img/p2.png" alt="">
								</div>
								<div class="details">
									<a href="#"><h4>Category</h4></a>
									<p>
									To be given To be given.
									</p>
								</div>
							</div>
							<div class="single-popular-post d-flex flex-row">
								<div class="thumb">
									<img src="img/p1.png" alt="">
								</div>
								<div class="details">
									<a href="#"><h4>Contact</h4></a>
									<p>
									To be given
									</p>
								</div>
							</div>
							<div class="single-popular-post d-flex flex-row">
								<div class="thumb">
									<img src="img/p2.png" alt="">
								</div>
								<div class="details">
									<a href="#"><h4>Job</h4></a>
									<p>
									To be given To be given.
									</p>
								</div>
							</div>


						</div>
					</div>
				</div>
			</section>
			<!-- End popular-post Area -->

			<!-- Start feature-cat Area -->
			<section class="feature-cat-area pt-100" id="category">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Featured Job Categories</h1>
								<p>Who are in extremely love with eco friendly system.</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="category.html">
									<img src="img/o1.png" alt="">
								</a>
								<p>Accounting</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="category.html">
									<img src="img/o2.png" alt="">
								</a>
								<p>Development</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="category.html">
									<img src="img/o3.png" alt="">
								</a>
								<p>Technology</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="category.html">
									<img src="img/o4.png" alt="">
								</a>
								<p>Media & News</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="category.html">
									<img src="img/o5.png" alt="">
								</a>
								<p>Medical</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="category.html">
									<img src="img/o6.png" alt="">
								</a>
								<p>Goverment</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End feature-cat Area -->

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
                                        <a href="{{ route('details',$row['id']) }}" ><h4>{{ $row['jobTitle']}}</h4></a>
											<h6> {{ $row['companyName'] }}</h6>
										</div>
										<ul class="btns">
											<li><a href="{{ route('login') }}"><span class="lnr lnr-heart"></span></a></li>
											@guest
                                                          <li><a href="{{ route('login') }}">Apply</a></li>
														@else
														
														<li><a href="{{url('/yes', $row['id'])}}">Apply</a></li>
														@endguest
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
                            
                              
						@endforeach



							<a class="text-uppercase loadmore-btn mx-auto d-block" href="category.html">Load More job Posts</a>

							</div>
						<div class="col-lg-4 sidebar">
							<div class="single-slidebar">
								<h4>Jobs by Location</h4>
								<ul class="cat-list">
									<li><a class="justify-content-between d-flex" href="category.html"><p>New York</p><span>37</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Park Montana</p><span>57</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Atlanta</p><span>33</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Arizona</p><span>36</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Florida</p><span>47</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Rocky Beach</p><span>27</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Chicago</p><span>17</span></a></li>
								</ul>
							</div>

						</div>
					</div>
				</div>
			</section>
			<!-- End post Area -->


			<!-- Start callto-action Area -->
			<section class="callto-action-area section-gap" id="join">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-9">
							<div class="title text-center">
								<h1 class="mb-10 text-white">Join us today without any hesitation</h1>
								<p class="text-white"></p>
								<a class="primary-btn" href="#">I am a Candidate</a>
								<a class="primary-btn" href="#">Request Free Demo</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End calto-action Area -->

			<!-- Start download Area -->
			<section class="download-area section-gap" id="app">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 download-left">
							<img class="img-fluid" src="img/d1.png" alt="">
						</div>
						<div class="col-lg-6 download-right">
							<h1>Download the <br>
							Virtual CV App Today!</h1>
							<p class="subs">
								The App is still uder development. Since the introduction of Virtual CV, it has been achieving great heights so far as its popularity and technological advancement are concerned.
							</p>
							<div class="d-flex flex-row">
								<div class="buttons">
									<i class="fa fa-apple" aria-hidden="true"></i>
									<div class="desc">
										<a href="#">
											<p>
												<span>Available</span> <br>
												on App Store
											</p>
										</a>
									</div>
								</div>
								<div class="buttons">
									<i class="fa fa-android" aria-hidden="true"></i>
									<div class="desc">
										<a href="#">
											<p>
												<span>Available</span> <br>
												on Play Store
											</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End download Area -->

@endsection

