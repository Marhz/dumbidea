<a href="{{ $award->path }}">
    <li class="group-list-item award__latest">
        <div class="award__latest-img flex">
            <async-img src="{{ $award->image }}" class="" />
        </div>
        <p class="award__latest-title">{{ $award->title }}</p>     
    </li>                
</a>
