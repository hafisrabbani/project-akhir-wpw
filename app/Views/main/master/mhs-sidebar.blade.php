<li class="sidebar-item {{ str_contains($_SERVER['REQUEST_URI'], '/dashboard/mhs/list-course/') ? 'active' : '' }}">
    <a href=" {{ route('mhs.list-course') }} " class="sidebar-link">
        <i class="fas fa-book"></i>
        <span>List Course</span>
    </a>
</li>
