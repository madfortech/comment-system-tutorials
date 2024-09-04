<div class="card mb-2">
    <div class="card-body">
      <h1 class="card-text">
        {{$post->title}}
      </h1>
      <p class="card-text">
        {{$post->description}}
      </p>
      <a href="#" class="btn btn-primary rounded-0">
        {{ $post->user_name }} 
      </a>
      @if(Auth::id() == $post->user_id)
        <form action="{{route('posts.destroy',$post->id)}}" method="post" class="mt-2">
          @csrf
          @method('delete')
          <div class="row mb-0">
            <div class="col">
              <button type="submit" class="btn btn-danger rounded-pill">
                <i class="bi bi-trash-fill"></i>
              </button>
            </div>
          </div>
        </form>
      @endif
    </div>
</div>