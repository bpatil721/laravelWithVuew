<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                
                        @auth
                            <a class="nav-link dropdown-toggle d-flex align-items-center"
                               href="#"
                               id="userDropdown"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">
                
                                {{-- User Avatar --}}
                                @php
                                    $profileImage = Auth::user()->profile_image;
                                    // The accessor returns either:
                                    // 1. A base64 data URI (starts with 'data:image')
                                    // 2. A file path (stored in database)
                                    // 3. null (fallback - should not happen due to accessor)
                                    if ($profileImage) {
                                        if (str_starts_with($profileImage, 'data:image')) {
                                            $imageSrc = $profileImage;
                                        } else {
                                            // It's a file path stored in database
                                            $imageSrc = asset('storage/' . $profileImage);
                                        }
                                    } else {
                                        // Fallback placeholder
                                        $imageSrc = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMTYiIGN5PSIxNiIgcj0iMTYiIGZpbGw9IiNjY2MiLz48dGV4dCB4PSI1MCUiIHk9IjUwJSIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkE8L3RleHQ+PC9zdmc+';
                                    }
                                @endphp
                                <img
                                    src="{{ $imageSrc }}"
                                    alt="{{ Auth::user()->name }}"
                                    class="rounded-circle me-2"
                                    width="32"
                                    height="32"
                                    style="object-fit: cover; background-color: #e0e0e0;">
                
                                <span class="ms-2">{{ Auth::user()->name }}</span>
                            </a>
                
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                aria-labelledby="userDropdown">
                
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        Profile
                                    </a>
                                </li>
                
                                <li><hr class="dropdown-divider"></li>
                
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a class="nav-link text-white" href="{{ route('login') }}">
                                Login
                            </a>
                        @endauth
                
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>