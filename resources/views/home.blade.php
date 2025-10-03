<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larablog - Home</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="container nav-content">
            <h1 class="logo">Larablog</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>

                    @auth
                        @if(auth()->user()->usertype === 'admin')
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-xs">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth

                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section with Posts -->
    <section class="hero">
        <div class="container hero-content">
            <h2>Latest from <span>Larablog</span></h2>
            <p>Fresh posts from our admin team</p>
        </div>
    </section>

    <!-- Blog Preview Section -->
    <section class="posts container">
        @foreach($posts as $post)
            <div class="post-card">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->post_title }}"
                    class="w-64 h-40 object-cover rounded">
                @else
                    <img src="https://source.unsplash.com/400x250/?blog,writing" alt="default image">
                @endif
                <div class="post-content">
                    <h3>{{ $post->post_title }}</h3>
                    <h5>{{ Str::limit($post->description, 60) }}...</h5>
                    <h6>{{ $post->created_at->format('d M, Y') }}</h6>
                    <br> 
                    <a href="{{ route('fullpost', $post->id) }}" class="btn">
                        Read More
                    </a>
                </div>
            </div>
        @endforeach
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Larablog. By Parvez Mosharof

