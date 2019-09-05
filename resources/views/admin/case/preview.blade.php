@php
  $pdf =['pdf','txt'];
  $docx =['docx','doc'];
@endphp
@if (in_array(get_file_extention($hearing_date->file), $pdf))
	<embed src= "{{asset('/storage/case/file/'.$hearing_date->file)}}" width= "500" height= "375">
	@elseif (in_array(get_file_extention($hearing_date->file), $docx))
	<iframe src="https://docs.google.com/gview?url={{asset('/storage/case/file/'.$hearing_date->file)}}&embedded=true"></iframe>
	@else
	<img class="img-fluid" src="{{asset('/storage/case/file/'.$hearing_date->file)}}" alt="File">
@endif
