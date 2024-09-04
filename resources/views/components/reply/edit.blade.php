<div class="modal fade" id="EditReplyModal-{{ $reply->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('reply update')}}</h1>
          </div>
          <div class="modal-body">
              <form action="{{ route('replies.update', $reply->id) }}" method="post" id="reply-form">
                  @csrf
                  @method('PUT')
                  <div class="row">
                      <div class="col">
                          <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                          <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                          <input type="hidden" name="commentable_type" value="App\Models\Post">
                          <textarea name="original_text" class="form-control" aria-label="comment">{{ $reply->original_text }}</textarea>
                      </div>
                      <div class="col">
                          <button class="btn btn-success fw-semibold text-uppercase">
                              <i class="bi bi-save"></i>
                              {{__('update')}}
                          </button>
                      </div>
                  </div>     
              </form>
          </div>
      </div>
  </div>
</div>