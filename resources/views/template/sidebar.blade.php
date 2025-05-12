 <div id="sidebar">
    <div class="sidebar-wrapper active">
       <div class="sidebar-header position-relative">

          <div class="d-flex flex-column align-items-center">
             <div class="logo mb-1" style="font-size: 1rem;">
                <a href="{{ route('admin.dashboard') }}" style="font-size: 2rem; white-space: nowrap;">
                   <img src="{{asset('asset/picture/logoajwa.png')}}" alt="" style="width: 130px; height: auto;">
                </a>
             </div>

             <div class="theme-toggle d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="20" height="20"
                   preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                   <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3" />
                      <g transform="translate(-210 -1)">
                         <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                         <circle cx="220.5" cy="11.5" r="4"></circle>
                         <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                      </g>
                   </g>
                </svg>
                <div class="form-check form-switch fs-6">
                   <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                   <label class="form-check-label" for="toggle-dark"></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="20" height="20"
                   preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                   <path fill="currentColor"
                      d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                   </path>
                </svg>
             </div>
          </div>

       </div>
       <div class="sidebar-menu">
          <ul class="menu">
             <li class="sidebar-item">
                <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                   <i class="bi bi-speedometer2"></i>
                   <span>Dashboard</span>
                </a>
             </li>

             <li class="sidebar-item">
                <a href="{{route('admin.pendaftaran')}}" class='sidebar-link'>
                   <i class="bi bi-person-plus-fill"></i>
                   <span>Pendaftaran</span>
                </a>
             </li>

             <li class="sidebar-title">Data Master</li>

             <li class="sidebar-item">
                <a href="{{route('admin.biojemaah.list')}}" class='sidebar-link'>
                   <i class="bi bi-people-fill"></i>
                   <span>Data Biodata Jamaah</span>
                </a>
             </li>

             <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                   <i class="bi bi-box-seam-fill"></i>
                   <span>Data Paket</span>
                </a>

                <ul class="submenu">
                   <li class="submenu-item">
                      <a href="{{route('admin.paket.list')}}" class="submenu-link">List Paket</a>
                   </li>
                   <li class="submenu-item">
                      <a href="{{route('admin.paket.listAllGroup')}}" class="submenu-link">List Keberangkatan</a>
                   </li>
                </ul>
             </li>

             <li class="sidebar-item">
                <a href="{{route('admin.sales.list')}}" class='sidebar-link'>
                   <i class="bi bi-person-badge-fill"></i>
                   <span>Data Sales</span>
                </a>
             </li>


             <li class="sidebar-title">Data Mobile</li>

             <li class="sidebar-item">
                <a href="{{route('admin.news.list')}}" class='sidebar-link'>
                   <i class="bi bi-newspaper"></i>
                   <span>Data News</span>
                </a>
             </li>

             <li class="sidebar-item">
                <a href="{{route('admin.faq.list')}}" class='sidebar-link'>
                   <i class="bi bi-question-circle-fill"></i>
                   <span>Data FaQ</span>
                </a>
             </li>


             <li class="sidebar-title">Data Admin</li>

             <li class="sidebar-item">
                <a href="" class='sidebar-link'>
                   <i class="bi bi-people-fill"></i>
                   <span>List Admin</span>
                </a>
             </li>
             <li class="sidebar-item">
                <a href="" class='sidebar-link'>
                   <i class="bi bi-person-circle"></i>
                   <span>Profile</span>
                </a>
             </li>

             <li class="sidebar-title">Auth</li>
             <li class="sidebar-item">
                <a href="{{route('admin.logout')}}" class='sidebar-link'>
                   <i class="bi bi-box-arrow-left"></i>
                   <span>Logout</span>
                </a>
             </li>
          </ul>
       </div>
    </div>
 </div>

 <script>
    document.addEventListener('DOMContentLoaded', function() {
       // Get current URL path
       const currentPath = window.location.pathname;

       // Get all sidebar links
       const sidebarLinks = document.querySelectorAll('.sidebar-link');
       const submenuLinks = document.querySelectorAll('.submenu-link');

       // Remove all active classes first
       document.querySelectorAll('.sidebar-item').forEach(item => {
          item.classList.remove('active');
       });
       document.querySelectorAll('.submenu-item').forEach(item => {
          item.classList.remove('active');
       });

       // Check main menu items
       sidebarLinks.forEach(link => {
          if (link.getAttribute('href') && link.getAttribute('href').includes(currentPath)) {
             link.parentElement.classList.add('active');
             // If parent has submenu, expand it
             if (link.parentElement.classList.contains('has-sub')) {
                link.parentElement.querySelector('.submenu').style.display = 'block';
             }
          }
       });

       // Check submenu items
       submenuLinks.forEach(link => {
          if (link.getAttribute('href') && link.getAttribute('href').includes(currentPath)) {
             link.parentElement.classList.add('active');
             // Add active class to parent sidebar-item
             link.closest('.sidebar-item').classList.add('active');
             // Show submenu
             link.closest('.submenu').style.display = 'block';
          }
       });
    });
 </script>