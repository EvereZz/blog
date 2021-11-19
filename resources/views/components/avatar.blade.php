@props(['source', 'id', 'width' => 100, 'class' => "ml-6 mt-6"])

<img 
    src="{{ ($source == null) ? 'https://i.pravatar.cc/60?u=' . $id  : asset('storage/' . $source) }}" 
    alt="avatar" 
    class="{{$class}}"
    width='{{$width}}'>