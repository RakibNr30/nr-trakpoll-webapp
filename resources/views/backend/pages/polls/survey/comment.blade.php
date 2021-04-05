<!--Comments-->
<div class="container bootstrap snippets bootdey">
    <div class="row">
    <div class="col-md-12">
        <div class="blog-comment">
        <h3>Comments</h3>
                <hr/>
        <ul class="comments">
            @foreach ($poll->comments as $comment)
                <li class="clearfix">
                    <img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="">
                    <div class="post-comments">
                        <p class="meta">{{ $comment->created_at->format('D, d, M, Y') }} <a href="#">{{ Auth::guard('admin')->user()->name }}</a> says : <i class="pull-right">
                            <a href="#"><small class="text-danger">Delete</small>
                            </a>
                            </i>
                        </p>
                        <p>
                            {{ $comment->comment }}
                        </p>
                    </div>
                </li>
            @endforeach
        {{-- <li class="clearfix">
          <img src="https://bootdey.com/img/Content/user_2.jpg" class="avatar" alt="">
          <div class="post-comments">
              <p class="meta">Dec 19, 2014 <a href="#">JohnDoe</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
              <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Etiam a sapien odio, sit amet
              </p>
          </div>
        
          <ul class="comments">
              <li class="clearfix">
                  <img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="">
                  <div class="post-comments">
                      <p class="meta">Dec 20, 2014 <a href="#">JohnDoe</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                          Etiam a sapien odio, sit amet
                      </p>
                  </div>
              </li>
          </ul>
        </li> --}}
        </ul>
      </div>
    </div>
  </div>
<!--/.Comments-->

<!--Reply-->
<div class="card mb-3 wow fadeIn">
    <div class="card-header font-weight-bold">Leave a reply</div>
    <div class="card-body">

        <!-- Default form reply -->
        <form action="{{ route('comment.store', $poll->id) }}" method="POST">
            <!-- Comment -->
            @csrf
            <div class="form-group">
                <label for="comment">Your comment</label>
                <textarea class="form-control" id="comment" rows="5" name="comment" aria-describedby="commentHelp"></textarea>
                @error('comment')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>
        </form>
        <!-- Default form reply -->



    </div>
</div>
<!--/.Reply-->