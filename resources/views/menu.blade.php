<ul class="nav flex-column mb-2">
    @foreach ($categories as $category)
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                {{ $category['category_name'] }}
            </a>
        </li>
    @endforeach
</ul>
