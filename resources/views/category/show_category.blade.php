@extends('news.form_news')
@section('title','ShowCategory ')
@section('content')

<form action="{{route('searchCategory')}}" method="post" class="container-fluid">
	@csrf
	<div class="row">
		

		<div class="row">

			<div class="col-md-3">
				<div class="form-group">
					<label>Danh mục:</label>
					<select class="form-control select2" style="width: 100%;" data-placeholder="Chọn 1 danh mục "  name="keySearchCategory" >	

						@foreach ($allCategories as $allCategory)
						<option value=""></option>
						@if(isset($keySearchCategory))
						<option value="{{ $allCategory->name }}"  {{ $keySearchCategory == $allCategory->name ? 'selected' : '' }}  >{{ $allCategory->name }} </option>
						@else
						<option  value="{{ $allCategory->name }}" >{{ $allCategory->name }}</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label>Date range:</label>

					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						@if(isset($searchByTime))
						<input type="text" class="form-control pull-right" id="reservation" name="searchByTime" value="{{ $searchByTime }}"> 
						@else
						<input type="text" class="form-control pull-right" id="reservation" name="searchByTime"  > 
						@endif
					</div>
				</div>
			</div>


			<div class="col-md-3" >
				<div class="form-group">
					<label>Số mục hiển thị</label>
					<select  class="form-control select2"  data-placeholder="Tất cả" style="width: 100%;"  name="searchByShow">


						<option value=""></option>
						@if(isset($searchByShow))
						<option value="5"  {{ $searchByShow == 5 ? 'selected' : '' }} >5 mục </option>
						<option value="10" {{ $searchByShow == 10 ? 'selected' : '' }} >10 mục</option>
						<option value="15" {{ $searchByShow == 15 ? 'selected' : '' }} >15 mục</option>
						@else

						<option value="5"  >5 mục </option>
						<option value="10" >10 mục</option>
						<option value="15" >15 mục</option>

						@endif
					</select>
				</div>
			</div>

			<div class="col-md-3" >
				<div class="form-group">
					<label>Trạng thái</label>
					<select  class="form-control select2"  data-placeholder="Tất cả" style="width: 100%;"  name="searchByStatus">
						<option value=""></option>
						@if(isset($searchByStatus))
						<option value="1" {{ $searchByStatus == 1 ? 'selected' : '' }}  >Active</option>
						<option value="0" {{ $searchByStatus == 0 ? 'selected' : '' }}  >Inactive</option>
						@else
						<option value="1"  >Active</option>
						<option value="0" >Inactive</option>
						@endif
					</select>
				</div>
			</div>

			<div class="col-md-2">
				<label>Thao tác </label>
				<div class="form-group">
					<button  type="submit" class="btn btn-default" >
						<i class="fas fa-search"></i>Tìm kiếm
					</button>
				</div>
			</div>

			<div class="col-md-2">
				<label> Tất cả </label>
				<div class="form-group">
					<a  class="btn btn-default" href="{{route('showCategory')}}" >
						<i class="fas fa-sync-alt"></i> Refesh	
					</a>
				</div>
			</div>


		</div>
	</div>
</form>



<div class="container-fluid" >

	<div class="row">
		<div style="float: left;" >
			<a href="{{route('createCategory')}}" class="btn  btn-primary"> <i class="fas fa-plus"></i>Thêm mới</a>
		</div>

		<div style="float: right;" >
			{{$categories->links()}}
		</div>
	</div>
</div>

<div class="container-fluid">

	<table class="table " >
		<div class="row">
			<div class=" text-bold " style="float: left;">
				<a id="resultCheckbox" class="text-bold"> </a> mục đã lựa chọn ||Chú giải :
				<a class="btn btn-warning"><i class="fas fa-edit"></i></a> Cập nhật 
				<a  class="btn btn-danger " ><i class="fas fa-trash-alt"></i></a> Xóa
			</div>
			<div class=" text-bold " style="float: right;">
				Tổng :	{{$categories->total()}}
			</div>
		</div>
		<thead>
			<tr>
				<th scope="row">
					<input type="checkbox" id="selectAll">
				</th>
				<th scope="col">STT</th>
				<th scope="col">Name</th>
				<th scope="col">Status</th>
	<!-- 			<th scope="col">Create Day</th>
		<th scope="col">Update Day</th> -->
		<th scope="col">Edit</th> 
		<th scope="col">Delete</th> 

	</tr>
</thead >

<tbody  id="countCheckbox">
	@php
	$i = 1;
	@endphp
	@foreach ($categories as $categories)
	<tr>
		<th scope="row"  class="selectCheckbox">
			<input  type="checkbox">
		</th>
		<th scope="row">{{$i}}</th>
		<td>{{$categories->name}}</td>
		@if($categories->status == 1)
		<td>
			<div class="icheck-success d-inline">
				<input type="checkbox" checked id="checkboxSuccess1" disabled>
				<label for="checkboxSuccess1">
				</label>
			</div>
		</td>
		@else
		<td>
			<div class="icheck-success d-inline">
				<input type="checkbox"  id="checkboxSuccess1" disabled>
				<label for="checkboxSuccess1">
				</label>
			</div>
		</td>
		@endif
		<!-- 		<td>{!! date('m/d/Y',strtotime($allCategory->created_at)) !!}</td>
			<td>{!! date('m/d/Y',strtotime($allCategory->updated_at)) !!}</td>	 -->
				<!-- <td>{!! $allCategory->created_at !!}</td>
					<td>{!! $allCategory->updated_at !!}</td> -->
					<td ><a  href="{{route('editCategory',$categories->id)}}"class="btn btn-warning"><i class="fas fa-edit"></i></a></td> 

					@if($categories->id == 1)
					<td ><a  href="" 
						class="btn btn-danger btnDeleteNews" id="btnDeleteNews" >
						<i class="fas fa-trash-alt"></i></a>
					</td> 
					@else
					<td ><a  href="{{route('deleteCategory',$categories->id)}}" 
						class="btn btn-danger btnDeleteNews" id="btnDeleteNews" >
						<i class="fas fa-trash-alt"></i></a>
					</td> 
					@endif

				</tr>

				@php
				$i ++;
				@endphp
				@endforeach



			</tbody>
		</table>
	</div>


	<script>
		$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
}
</script>

<script language="javascript">
	document.getElementById('selectAll').onclick = function(e){
		if (this.checked){
			$('.selectCheckbox input').prop('checked', true);
			var cout = $('.selectCheckbox input:checkbox:checked').length;
			$('#resultCheckbox').text(cout);
		}
		else{
			$('.selectCheckbox input').prop('checked', false);
			var cout = $('.selectCheckbox input:checkbox:checked').length;
			$('#resultCheckbox').text(cout);
		}
	};
</script>

<!-- count checkbox -->
<script type="text/javascript">
	$(document).ready(function(){

		var $checkboxes = $('#countCheckbox  th input[type="checkbox"]');

		$checkboxes.change(function(){
			var cout = $checkboxes.filter(':checked').length;
			$('#resultCheckbox').text(cout);
		});

	});
</script>






@if(Session::has('messageAddCategory'))
<script type="text/javascript">

	function updateSuccess(){
		Swal.fire({
							// position: 'bottom-end',
							icon: 'success',
							title: '{{ Session::get('messageAddCategory') }}',
							showConfirmButton: false,
							timer: 2000
						})
	}
	setTimeout(updateSuccess(), 2000);

</script>
@endif

@if(Session::has('messageUpdateCategory'))
<script type="text/javascript">

	function updateSuccess(){
		Swal.fire({
							// position: 'bottom-end',
							icon: 'success',
							title: '{{ Session::get('messageUpdateCategory') }}',
							showConfirmButton: false,
							timer: 2000
						})
	}
	setTimeout(updateSuccess(), 2000);

</script>
@endif

@if(Session::has('messageDeleteCategory'))
<script type="text/javascript">

	function deleteSuccess(){
		Swal.fire({
							// position: 'bottom-end',
							icon: 'success',
							title: '{{ Session::get('messageDeleteCategory') }}',
							showConfirmButton: false,
							timer: 2000
						})
	}
	setTimeout(deleteSuccess(), 2000);

</script>
@endif




<script >

	$('.btnDeleteNews').on('click',  function(event) {
		event.preventDefault();
		const  href = $(this).attr('href')


		Swal.fire({
			title: 'Bạn chắc chắn muốn xóa',
			text: 'Thực hiện xóa!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Enter!'
		}).then((result) => {
			if (result.value) {
				document.location.href = href;
			}

		})
	})


</script>

<script >

	$(".searchId").select2({
		placeholder: "Select a News",
		allowClear: true,
	});

</script>



@endsection
