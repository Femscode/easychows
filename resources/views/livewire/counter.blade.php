<div>
  
    <button class='btn btn-success' wire:click="increment">+</button>
    <h1>{{ $count }}</h1>
    @foreach ($rests as $post)
      <p> {{$post->name}}</p>
    @endforeach
</div>
