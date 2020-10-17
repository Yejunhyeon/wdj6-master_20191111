<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Web Database</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('ajaxtests.index') }}">Ajax Test</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('members.index') }}">Member</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('programs.index') }}">Program</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('articles.index') }}">Article</a>
        </li>
        @if (Auth::guest())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('sessions.create') }}">Sign in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.create') }}">Sign up</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('sessions.destroy') }}">Sign out</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>