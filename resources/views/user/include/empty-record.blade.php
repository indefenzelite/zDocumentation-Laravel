@php
if(!isset($width)){
  $width = 15;
}
if(!isset($image)){
  $image = asset('user/icons/empty.png');
}
@endphp

<div class="text-center mx-auto py-3 pt-4 m-5">
  <img src="{{ asset($image) }}" alt="" style="width:{{ $width }}%">
  <p class="mt-3">{{ $title }}</p>
</div>
