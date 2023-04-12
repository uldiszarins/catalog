<ul class="nav flex-column mb-2">
    @foreach ($categories as $key => $category)
        <li class="nav-item">
            <a class="nav-link" href="/?cat={{ $category }}">
                <span data-feather="file-text"></span>
                {{ $key }} {{ $categoriesCount[$category] }}
            </a>
        </li>
    @endforeach
</ul>
