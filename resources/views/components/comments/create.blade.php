  <div>
    <form class="row row-cols-lg-auto g-3" action="{{route('comments.store')}}" 
      method="post">
      @csrf
      <div class="col-12">
        <div class="input-group">
          <div class="input-group-text">
            <i class="bi bi-chat-left-fill"></i>
          </div>
          <input type="hidden" name="commentable_id"  value="{{ $post->id }}">
          <input 
            type="text" 
            class="form-control"
            name="original_text"
            id="inlineFormInputGroupUsername" 
            placeholder="Comment">
        </div>
      </div>
      {{-- name field --}}
      <div class="col-12">
        @if (Auth::check())
          <button type="submit" class="btn btn-primary rounded-0 border-0">
            {{('Post')}}
          </button>
          @else
          <button class="btn btn-primary fw-semibold" disabled>
            {{__('login to comment')}}
          </button>
              
          <a class="btn btn-primary text-decoration-none fw-semibold link-opacity-75" href="{{ route('login') }}">
            {{('Login')}}
          </a>
        @endif
      </div>
    </form>
  </div>