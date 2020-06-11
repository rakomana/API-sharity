@extends('layouts.nav')
@section('content')



			<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row search-page-top d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-12">
							<h1 class="text-white">
								Search Results
							</h1>
							<p class="text-white link-nav">
								<a href="index.html">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="search.html"> Job details page</a>
							</p>
                            <form action="/search" class="serach-form-area" method="POST" role="search">
								{{ csrf_field() }}
								<div class="row justify-content-center form-wrap">
									<div class="col-lg-4 form-cols">
										<input type="text" class="form-control" name="q" placeholder="what are you looging for?"><span class="input-group-btn">
									</div>
									<div class="col-lg-3 form-cols">
										<div class="default-select" id="default-selects">
											<select>
												<option value="1">Select area</option>
												<option value="2">Dhaka</option>
												<option value="3">Rajshahi</option>
												<option value="4">Barishal</option>
												<option value="5">Noakhali</option>
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
                            @if(isset($details))
							<p class="text-white"> <?php
                                $val = count($details);
                                echo "$val"; ?> Results found for <span>" {{ $query }}"</span></p>
						</div>
					</div>
				</div>
			</section>
			<!-- End banner Area

            <p> The Search results for your query <b> {{ $query }} </b> are :</p>
        <h2>Sample User details</h2> -->
			<!-- Start post Area -->
			<section class="post-area section-gap">
				<div class="container">
					<div class="row justify-content-center d-flex">
						<div class="col-lg-8 post-list">


                        @foreach($details as $user)
                            <div class="single-post d-flex flex-row ">
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
                                        <a href="{{ route('details',$user['id']) }}" ><h4>{{ $user['jobTitle']}}</h4></a>
											<h6> {{ $user['companyName'] }}</h6>
										</div>
										<ul class="btns">
											<li><a href="#"><span class="lnr lnr-heart"></span></a></li>
											<li><a href="#">Apply</a></li>
										</ul>
									</div>
									<p>
										{{ $user['fullDescription'] }}
									</p>
									<h5>Job Nature: {{ $user['type'] }}</h5>
									<p class="address"><span class="lnr lnr-map"></span>Location: {{ $user['location'] }}</p>
									<p class="address"><span class="lnr lnr-database"></span>Salary R {{ $user['salary'] }}</p>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
						<div class="col-lg-4 sidebar">

							<div class="single-slidebar">
								<h4>Jobs by Location</h4>
								<ul class="cat-list">
									<li><a class="justify-content-between d-flex" href="#"><p>New York</p><span>37</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Park Montana</p><span>57</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Atlanta</p><span>33</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Arizona</p><span>36</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Florida</p><span>47</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Rocky Beach</p><span>27</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Chicago</p><span>17</span></a></li>
								</ul>
							</div>

							<div class="single-slidebar">
								<h4>Top rated job posts</h4>
								<div class="active-relatedjob-carusel">
									<div class="single-rated">
										<img class="img-fluid" src="img/r1.jpg" alt="">
										<h4>Creative Art Designer</h4>
										<h6>Premium Labels Limited</h6>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut dolore magna aliqua.
										</p>
										<h5>Job Nature: Full time</h5>
										<p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka</p>
										<p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p>
										<a href="#" class="btns text-uppercase">Apply job</a>
									</div>
									<div class="single-rated">
										<img class="img-fluid" src="img/r1.jpg" alt="">
										<h4>Creative Art Designer</h4>
										<h6>Premium Labels Limited</h6>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut dolore magna aliqua.
										</p>
										<h5>Job Nature: Full time</h5>
										<p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka</p>
										<p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p>
										<a href="#" class="btns text-uppercase">Apply job</a>
									</div>
									<div class="single-rated">
										<img class="img-fluid" src="img/r1.jpg" alt="">
										<h4>Creative Art Designer</h4>
										<h6>Premium Labels Limited</h6>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut dolore magna aliqua.
										</p>
										<h5>Job Nature: Full time</h5>
										<p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka</p>
										<p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p>
										<a href="#" class="btns text-uppercase">Apply job</a>
									</div>
								</div>
							</div>

							<div class="single-slidebar">
								<h4>Jobs by Category</h4>
								<ul class="cat-list">
									<li><a class="justify-content-between d-flex" href="#"><p>Technology</p><span>37</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Media & News</p><span>57</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Goverment</p><span>33</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Medical</p><span>36</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Restaurants</p><span>47</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Developer</p><span>27</span></a></li>
									<li><a class="justify-content-between d-flex" href="#"><p>Accounting</p><span>17</span></a></li>
								</ul>
							</div>

							<div class="single-slidebar">
								<h4>Carrer Advice Blog</h4>
								<div class="blog-list">
									<div class="single-blog " style="background:#000 url(img/blog1.jpg);">
										<a href="#"><h4>Home Audio Recording <br>
										For Everyone</h4></a>
										<div class="meta justify-content-between d-flex">
											<p>
												02 Hours ago
											</p>
											<p>
												<span class="lnr lnr-heart"></span>
												06
												 <span class="lnr lnr-bubble"></span>
												02
											</p>
										</div>
									</div>
									<div class="single-blog " style="background:#000 url(img/blog2.jpg);">
										<a href="#"><h4>Home Audio Recording <br>
										For Everyone</h4></a>
										<div class="meta justify-content-between d-flex">
											<p>
												02 Hours ago
											</p>
											<p>
												<span class="lnr lnr-heart"></span>
												06
												 <span class="lnr lnr-bubble"></span>
												02
											</p>
										</div>
									</div>
									<div class="single-blog " style="background:#000 url(img/blog1.jpg);">
										<a href="#"><h4>Home Audio Recording <br>
										For Everyone</h4></a>
										<div class="meta justify-content-between d-flex">
											<p>
												02 Hours ago
											</p>
											<p>
												<span class="lnr lnr-heart"></span>
												06
												 <span class="lnr lnr-bubble"></span>
												02
											</p>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</section>
			<!-- End post Area -->

			<!-- Start callto-action Area -->
			<section class="callto-action-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-9">
							<div class="title text-center">
								<h1 class="mb-10 text-white">Join us today without any hesitation</h1>
								<p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
								<a class="primary-btn" href="#">I am a Candidate</a>
								<a class="primary-btn" href="#">Request Free Demo</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End calto-action Area -->


@endsection
