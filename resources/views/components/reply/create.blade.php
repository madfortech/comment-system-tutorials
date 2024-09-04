      <!-- Modal -->
      <div class="modal fade" id="ReplyModal-{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('reply comment')}}</h1>
              
            </div>
            <div class="modal-body">
              <form action="{{ route('replies.store', $comment->id) }}" method="post" id="reply-form">
                @csrf
           
                <div class="row">
            
                  <div class="col">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                    <input type="hidden" name="commentable_type" value="App\Models\Post">
                    <input type="text" name="original_text" class="form-control" 
                     aria-label="reply" placeholder="reply">
                  </div>
            
                  <div class="col">
                    @auth
                    <button class="btn btn-success fw-semibold text-uppercase">
                      <i class="bi bi-save"></i>
                      {{__('save')}}
                    </button>

                      @else
                      <button type="button" disabled class="btn btn-primary">
                        {{('Reply')}}
                      </button>

                      <a class="btn btn-link text-decoration-none" href="{{url('login')}}">
                        {{('login')}}
                      </a>
                    @endauth
                  </div>
                </div>     
              </form>
            </div>
          </div>
        </div>
      </div>
     