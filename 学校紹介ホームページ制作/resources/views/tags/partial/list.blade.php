@if ($tags->count())
  <ul class="tags__article">
    @foreach ($tags as $tag)
      <li>
        <label>{{ $tag->name }}</label>
      </li>
    @endforeach
  </ul>
@endif