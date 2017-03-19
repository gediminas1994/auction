@extends('layouts.app')

@section('content')
	
	<div class="container">
		<ul>
			<li>{{ $user->name }}</li>
			<li>{{ $user->email }}</li>
			<li>{{ $user->created_at }}</li>
		</ul>
	</div>


@endsection