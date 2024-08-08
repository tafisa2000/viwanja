<header id="page-topbar">
    <style>
        /* Styling for the dropdown container */
        .language-dropdown {
            position: relative;
            display: inline-block;
            margin-top: 10px;
        }

        /* Styling for the select element */
        .language-select {
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            color: #333;
            font-size: 14px;
            cursor: pointer;
            appearance: none;
            /* Remove default dropdown icon */
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        /* Add a custom arrow icon */
        .language-dropdown::after {
            content: '\25BC';
            /* Downward arrow */
            font-size: 12px;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            pointer-events: none;
            color: #333;
        }

        /* Hover effect */
        .language-select:hover {
            background-color: #e9e9e9;
        }
    </style>
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="{{ route('login') }}" class="logo logo-light">
                    {{-- <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light" height="20">
                    </span> --}}
                    <h3 style="color:white;text-align:center;font-size: 15px; margin-top: 10px; ">

                        J.J.MKENYE & SONS COMPANY LTD </h3>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form> --}}

        </div>
        @php
            $id = Auth::user()->id;
            $adminData = App\Models\User::find($id);
        @endphp


        <div class="d-flex">
            {{-- <div class="language-dropdown">
                <select name="" id="changeLang" class="language-select">
                    <option value="en" {{ Session::get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="sw" {{ Session::get('locale') == 'sw' ? 'selected' : '' }}>Swahili</option>
                </select>
            </div> --}}

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>


            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src=" {{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/no_image.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ $adminData->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                            class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('change.password') }}"><i
                            class="ri-wallet-2-line align-middle me-1"></i> change password</a>
                    <a class="dropdown-item d-block" href="#"><span
                            class="badge bg-success float-end mt-1">11</span><i
                            class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i>
                        Lock
                        screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>
<script>
    $(document).ready(function() {
        var url = "{{ route('change') }}";
        $('#changeLang').change(function() {
            var lang = $(this).val();
            window.location.href = url + '?lang=' + lang;
        });
    });
</script>
