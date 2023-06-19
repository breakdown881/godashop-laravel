@foreach ($comments as $comment)
<hr>
<span class="date pull-right">{{$comment->created_date}}</span>
<input class="answered-rating-input" name="rating" type="text" title="" value="{{$comment->star}}" readonly />
<span class="by">{{$comment->fullname}}</span>
<p>{{$comment->description}}</p>
@endforeach