<p class="lead">
  <i class="fa fa-tags"></i>
  태그
</p>

<ul>
  @foreach($allTags as $tag)
    <li {!! Str::contains(request()->path(), $tag->slug) ? 'class="active"' : '' !!}>
        <button class ="btn__tag__article btn btn-primary" data-id="{{ $tag->slug }}">{{ $tag->name }}</button>
        @if ($count = $tag->articles->count())
        <span class="badge badge-default">{{ $count }}</span>
        @endif
    </li>

  @endforeach
</ul>