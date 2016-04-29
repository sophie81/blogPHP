<ul>
	<li><a href="{{url('/')}}">Home</a></li>
	@forelse($categories as $id=>$title)
		<li><a href="{{url('category', [$id])}}">{{$title}}</a></li>
	@empty
	@endforelse
	<li><a href="{{url('login')}}">Connexion</a></li>
</ul>