@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('posts.store')}}" method="post">
                @csrf

                <div class="mb-3">
                  <label for="title" class="form-label">{{__('title')}}</label>
                   <input class="form-control" name="title" id="title" placeholder="title">
                </div>
                {{-- title --}}

                <div class="mb-3">
                  <label for="description" class="form-label">{{__('description')}}</label>
                  
                  <textarea class="form-control" name="description" id="description" cols="30" rows="4" placeholder="description">

                  </textarea>
                </div>
                
              
                </script>
                {{-- description --}}
              
                <div class="mb-3 form-check">
                    <button type="submit" class="btn btn-primary">
                        {{__('Save')}}
                    </button>
                </div>
              
              </form>
        </div>
    </div>
</div>
@endsection