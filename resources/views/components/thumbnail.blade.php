@props(['source', 'id'])

<img 
    src="{{ ($source == null) ? 'https://picsum.photos/seed/' . $id .'/1000/700' : asset('storage/' . $source) }}" 
    alt="Blog Post illustration" 
    class="rounded-xl"
    >