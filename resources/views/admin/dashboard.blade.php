@extends('layouts.apps')

@section('side-navbar')
	@include('layouts.side_navbar')
@endsection

@section('top-navbar')
	@include('layouts.top_navbar')
@endsection

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="header">
							<h4 class="title">Edit Profile</h4>
						</div>
						<div class="content">
							<form>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label>Company (disabled)</label>
											<input type="text" class="form-control" disabled placeholder="Company" value="Creative Code Inc.">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Username</label>
											<input type="text" class="form-control" placeholder="Username" value="michael23">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control" placeholder="Email">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" class="form-control" placeholder="Company" value="Mike">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" class="form-control" placeholder="Last Name" value="Andrew">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Address</label>
											<input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control" placeholder="City" value="Mike">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Country</label>
											<input type="text" class="form-control" placeholder="Country" value="Andrew">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Postal Code</label>
											<input type="number" class="form-control" placeholder="ZIP Code">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>About Me</label>
											<textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
										</div>
									</div>
								</div>

								<button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-user">
						<div class="image">
							<img src="{{ URL::asset('bootstrap/assets/img/full-screen-image-3.jpg') }}" alt="..."/>
						</div>
						<div class="content">
							<div class="author">
								<a href="#">
									<img class="avatar border-gray" src="{{ URL::asset('bootstrap/assets/img/default-avatar2.png') }}" alt="..."/>

									<h4 class="title">Steven Gerrad<br />
										<small>michael24</small>
									</h4>
								</a>
							</div>
							<p class="description text-center"> "Lamborghini Mercy <br>
								Your chick she so thirsty <br>
								I'm in that two seat Lambo"
							</p>
						</div>
						<hr>
						<div class="text-center">
							<button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
							<button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
							<button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('footer')
	@include('layouts.footer')
@endsection