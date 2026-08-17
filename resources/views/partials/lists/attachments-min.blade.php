<li class="list-group-item"><a href="{{url('attachments')}}/{{$attachment->filename_new}}"
	target="_blank" alt="{{$attachment->filename_original}}"
	title="{{$attachment->filename_original}}">
	<i class="fa fa-file"></i>&nbsp;&nbsp;{{\Illuminate\Support\Str::limit($attachment->filename_original,30)}}</a></li>
