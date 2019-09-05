<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Advocate</title>
    
    <style>
		
   </style>
    
  </head>
  <body>
  <section>
   <div class="container">
   <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
    <a class="navbar-brand" href="{{ route('index') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item {{ Request::is('next') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('next') }}">Next</a>
      </li>
     
    </ul>
    <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('search') }}">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
    </form>
   </div>
   </nav>
   </div>
  </section>
@php
  $user =App\User::with('employee')->find(1)
@endphp
   <section class="mt-4">
   	<div class="container">
   		<div class="row mx-5 px-5">
   			<div class="col-md-2 ml-auto">
         @if ($user->employee->photo)
   				<img src="{{asset('storage/user/photo/'.$user->employee->photo)}}" alt="">
          @else
          <img src="{{asset('img/profile.jpg')}}" alt="">
         @endif
   			</div>
   			<div class="col-md-8 ml-auto">
   				<h3> {{get_option('owner_name')?get_option('owner_name'):'অ্যাডভোকেটএইচ এম হেলাল উদ্দিন'}}</h3>
  				<span><small>{!!get_option('education')?get_option('education'):'বিএসএস (অনার্স),এমএসএস (মাস্টার্স),এলএলবি (জাবি) <br>আইসিটি (ডিপ্লোমা), এমএম (কামিল), এমএ (ফার্স্ট ক্লাস)'!!}</small>  </span>
 				
   				<p><i>{!!get_option('address')?get_option('address'):'দেওয়ানী ও ফৌজদারী আদালত, জজকোর্ট, চাঁদপুর।<br> আয়কর আইনজীবী, চাঁদপুর টেক্স বার এসোসিয়েশন'!!}</i> </p>
   				<p> <i>ফোন:{{get_option('phone')?get_option('phone'):'01712-771190'}} ,  ই-মেইল- {{get_option('email')?get_option('email'):'hmhelal@gmail.com'}}</i></p>
   				<p>{{get_option('landmark')?get_option('landmark'):'চেম্বার: সুইটি সেন্টার (নীচতলা), চেয়ারম্যান ঘাট, চাঁদপুর।'}}</p>
   			</div>
   		</div>
   	</div>
   </section>
   @section('content')
   @show
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>