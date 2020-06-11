@extends('layouts.nav')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Job Post</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('post.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @foreach ($r as $row)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>jobTitle:</strong>
                {{ $row['jobTitle']}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>companyName:</strong>
                {{ $row['companyName'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>location:</strong>
                {{ $row['location'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>salary:</strong>
                {{ $row['salary'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>fullDescription:</strong>
                {{ $row['fullDescription'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>experience:</strong>
                {{ $row['experience'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>skills:</strong>
                {{ $row['skills'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>phoneNumber:</strong>
                {{ $row['phoneNumber'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>email:</strong>
                {{ $row['email'] }}
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m">
        Open modal
      </button>

      <!-- The Modal -->
      <div class="modal fade" id="m">
        <div class="modal-dialog modal-md">
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
                                <li><a href="#"><span class="lnr lnr-heart"></span></a></li>
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

      <!--testing-->

    @endforeach
@endsection
