<ul>
    @foreach($childs as $child)
        <li>
            {{ $child->name }}
            @if(count($child->children))
                @include('manageChild',['childs' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
