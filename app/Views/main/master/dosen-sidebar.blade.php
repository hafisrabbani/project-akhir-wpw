<li class="sidebar-item {{ ($_SERVER['REQUEST_URI'] == '/dashboard/list-course/') ? 'active' : '' }}">
    <a href=" {{ route('list-course') }} " class="sidebar-link">
        <i class="fas fa-book"></i>
        <span>List Course</span>
    </a>
</li>