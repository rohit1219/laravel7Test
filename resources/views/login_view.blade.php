<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="_token" content="{{csrf_token()}}" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post" action="login">
					<span class="login100-form-title">
						Sign In
					</span>
					{{@csrf_field()}}
					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						@error('username')
							<span class="focus-input100"></span>
						@enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						@error('password')
							<span class="focus-input100">{{$message}}</span>
						@enderror
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							Username / Password?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Sign in
						</button>
					</div>

					<div class="flex-col-c p-t-100 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account?
						</span>

						<a class="txt3" data-toggle="modal" data-target="#myModal">
							Sign up now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- The Modal -->
	<div class="modal" id="myModal">
		<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		
			<!-- Modal Header -->
			<div class="modal-header">
			<h1 class="modal-title">Add Form</h1>
			<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			
			<!-- Modal body -->
			<div class="modal-body">
					<form id="myForm">
						Name: <input class="form-control" type="text" name="name" value="" id="name">
						@error('name')
							<span style="color:red">{{$message}}</span>
						@enderror<br><br>
						Email: <input class="form-control" type="text" name="email" value="" id="email" >
						@error('email')
							<span style="color:red">{{$message}}</span>
						@enderror<br><br>
						Password: <input class="form-control" type="password" name="password" value="" id="password">
						@error('password')
							<span style="color:red">{{$message}}</span>
						@enderror<br><br>
						Phone: <input class="form-control" type="text" name="phone" value="" id="phone">
						@error('phone')
							<span style="color:red">{{$message}}</span>
						@enderror<br><br>
				
			
				<!-- Modal footer -->
				<div class="modal-footer">
					<!-- <input class="form-control" type="submit" name="submit" > -->
					<button class="btn btn-primary" id="ajaxSubmit" type="submit" value="submit">Submit</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

				</form>
			</div>
			
		</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
<script>
    $('#ajaxSubmit').click(function(){
        event.preventDefault();
        var form = $('#myForm');
        // console.log(form.serialize());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/sample') }}",
            method: 'post',
            data: form.serialize(),
            dateType: 'json',
            success: function(result){
                if(result){
                    $('#myModal').modal('hide');
                    $('.modal-backdrop').remove();  
                    return false;
                }
            }});
    });
</script>