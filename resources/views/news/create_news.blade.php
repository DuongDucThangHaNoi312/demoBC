@extends('news.form_news')
@section('title','Create News ')
@section('content')

<form  enctype="multipart/form-data"  action="{{ route('saveNews') }}" method="post" style="margin-left: 10px ">
	@csrf
	<h4 class="text-md-center">Add News</h4>

	<div class="form-group ">
		<label class="control-label" for="inputSuccess">Title</label>
		<input type="text" class="form-control" id="inputSuccess" placeholder="Enter ..." name="title" value="{{ old('title') }}">
		@error('title')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>


	<div class="form-group">
		<label for="exampleInputPassword1">Text</label>
		<div class="card-body">
			<textarea name="text" class="form-control " id="editor1" >{!! old('text') !!}</textarea>
		</div>

		@error('text')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<label> Ảnh </label>
	<div class="form-group">
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
				<img data-src=""  >
			</div>
			<div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;">
			</div>
			<div>
				<span class="btn btn-default btn-file">
					<span class="fileinput-new">Select image</span>
					<span class="fileinput-exists">Change</span>
					<input type="file" name="avatar">
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
		<select class="form-control select2" style="width: 100%;" data-placeholder="Chọn 1 danh mục "  name="newscategory_id">	
			@foreach ($allCategory as $allCategoryDetails)
			<option ></option>
			<option value="{{ $allCategoryDetails->id }}">{{$allCategoryDetails->name}}</option>
			@endforeach
		</select>
		@error('newscategory_id')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>



	<div class="form-group form-check">

		<div class=" checkbox icheck-info">
			<input type="checkbox" id="htmlRadioId1" name="status1"  value="1" checked   />
			<label for="htmlRadioId1">Active</label>
		</div>	

		<input type="hidden" id="htmlRadioId2" name="status0"  value="0"  />

		@error('status')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
	<button type="submit" class="btn btn-primary" id="btnCreateNews" >Add</button>
</form>





@if ($errors->any())
<script>
	function myFunction() {
		Swal.fire({
			position: 'bottom-end',
			icon: 'error',
			title: 'Vui lòng kiểm tra lại !!!',
			showConfirmButton: false,
			timer: 2000
		})
	}
	setTimeout(myFunction(), 2000);
</script>	
@endif
@endsection

