<div class="modal fade" id="EditCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{('Edit comment')}}</h1>
        </div>
        <div class="modal-body">
          {{-- Edit form --}}

            <form action=" {{route('comments.update',$comment->id)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                
                    <div class="col">
                        <input type="hidden" name="commentable_id"  value="{{ $post->id }}">
                        <input type="text" name="original_text" class="form-control" value="{{ $comment->original_text }}"  aria-label="comment">
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