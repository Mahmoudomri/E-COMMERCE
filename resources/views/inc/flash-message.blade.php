@if($message=Session::get('success'))

 <div class="alert alert-solid-success">
   {{$message}}
   
 </div>

@endif