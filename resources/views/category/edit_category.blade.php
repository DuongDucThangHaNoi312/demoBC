@extends('news.form_news')
@section('title','EditCategory ')
@section('content')

<form   action="{{ route('updateCategory',$categoryEdit->id) }}" method="post" style="margin-left: 10px ">
	@csrf
	<h4 class="text-md-center">Edit Categories</h4>


	<div class="form-group ">
		<label class="control-label" for="inputSuccess">Name</label>
		<input type="text" class="form-control" id="inputSuccess"  name="name" value="{{$categoryEdit->name}}">
		@error('title')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="form-group form-check">
		@if($categoryEdit->status == 1)
		<div class=" checkbox icheck-info">
			<input type="checkbox" id="htmlRadioId1" name="statusOld"  value="1" checked   />
			<label for="htmlRadioId1">On</label>	
			<input type="hidden" id="htmlRadioId1" name="statusNew"  value="0"   />
		</div>	
		@else
		<div class=" checkbox icheck-info">
			<input type="checkbox" id="htmlRadioId1" name="statusOld"  value="0"   checked />
			<label for="htmlRadioId1">Off</label>
			<input type="hidden" id="htmlRadioId1" name="statusNew"  value="1"   />

		</div>	
		@endif

		@error('status')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
	<button type="submit" class="btn btn-primary" id="btnCreateNews" >Save</button>
</form>



<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1'); </script>


@endsection