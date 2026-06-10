<div>
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
    <Header />
   <div