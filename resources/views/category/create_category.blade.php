@extends('news.form_news')
@section('title','CreateCategory ')
@section('content')

<form   action="{{ route('saveCategory') }}" method="post" style="margin-left: 10px ">
	@csrf
	<h4 class="text-md-center">Add Category </h4>

	<div class="form-group ">
		<label class="control-label" for="inputSuccess">Name</label>
		<input type="text" class="form-control" id="inputSuccess" placeholder="Enter ..." name="name" value="{{ old('name') }}">
		@error('name')
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
			icon: 'error',
			title: 'Vui lòng kiểm tra lại !!!',
			showConfirmButton: false,
			timer: 2000
		})
	}
	setTimeout(myFunction(), 2000);
</script>	
@endif

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1'); </script>
@endsection

