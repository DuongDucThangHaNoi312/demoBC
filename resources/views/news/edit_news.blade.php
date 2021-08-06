@extends('news.form_news')
@section('title','EditNews ')
@section('content')

<form   action="{{ route('updateNews',$newsEdit->id) }}" method="post" style="margin-left: 10px "  enctype="multipart/form-data">
	@csrf
	<h4 class="text-md-center">Edit News</h4>


	<div class="form-group ">
		<label class="control-label" for="inputSuccess">Title</label>
		<input type="text" class="form-control" id="inputSuccess"  name="title" value="{{$newsEdit->title}}">
		@error('title')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>



	<div class="form-group">
		<label for="exampleInputPassword1">Text</label>
		<input type="text"  id="exampleInputText" name="text">

		<div class="card-body">
			<textarea name="text" class="form-control " id="editor1" >{!!$newsEdit->text!!}</textarea>
		</div>

<!-- 		@error('text')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
-->

<!-- <div class="form-group">
	<label for="exampleInputPassword1">Text</label>
	<div class="card-body">
		<textarea name="text" class="form-control " id="editor1" >{!! old('text') !!}</textarea>
	</div>

	@error('text')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>
 -->

<label> Ảnh </label>
<div class="form-group">
	<input type="hidden" name="avatarOld" value="{{ $newsEdit->avatar }}">
	<div class="fileinput fileinput-new" data-provides="fileinput">
		<div class="fileinput-new img-thumbnail" >
			<img src="{{ $newsEdit->avatar }}"   >
		</div>
		<div class="fileinput-preview fileinput-exists img-thumbnail" >
		</div>
		<div>
			<span class="btn btn-default btn-file">
				<span class="fileinput-new">Change</span>
				<span class="fileinput-exists">Change</span>
				<input type="file" name="avatarNew">
			</span>
			<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		</div>
	</div>

	@error('avatar')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>


<div class="form-group">
	<label>Danh mục:</label>
	<select class="form-control select2" style="width: 100%;" data-placeholder="Chọn 1 danh mục "  name="newscategory_id_new">	
		@foreach ($allCategory as $allCategoryDetails)
		<option value="{{ $allCategoryDetails->id }}"  {{ $newsEdit->newscategory->id == $allCategoryDetails->id ? 'selected' : '' }} >{{$allCategoryDetails->name}}</option>
		@endforeach
	</select>
	<input type="hidden" name="newscategory_id_old" value="{{ $newsEdit->newscategory->id }}">
	@error('newscategory_id')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>

<div class="form-group form-check">


	@if($newsEdit->status == 1)
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