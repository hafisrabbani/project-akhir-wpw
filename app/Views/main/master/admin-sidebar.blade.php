<li class="sidebar-item {{ ($_SERVER['REQUEST_URI'] == '/dashboard/manage-user/') ? 'active' : '' }}">
    <a href=" {{ route('manage-user') }} " class="sidebar-link">
        <i class="fas fa-users"></i>
        <span>Manage User</span>
    </a>
</li>

<li class="sidebar-item {{ ($_SERVER['REQUEST_URI'] == '/dashboard/enrollment/') ? 'active' : '' }}">
    <a href=" {{ route('enrollment') }} " class="sidebar-link">
        <i class="fas fa-user-tag"></i>
        <span>Enrollment</span>
    </a>
</li>

<li class="sidebar-item {{ ($_SERVER['REQUEST_URI'] == '/dashboard/courses/') ? 'active' : '' }}">
    <a href=" {{ route('courses') }} " class="sidebar-link">
        <i class="fas fa-book"></i>
        <span>Courses</span>
    </a>
</li>