@include('shared._error')

<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <div class="form-group">
            <textarea class="form-control" placeholder="分享您的见解~" name="content" rows="3"></textarea>
        </div>
        <button type="submit" class="btn-primary btn btn-sm"><i class="fa fa-share mr-1"></i> 回复</button>
    </form>
</div>
<hr>