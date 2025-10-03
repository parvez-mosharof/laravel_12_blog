<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->post_title }} - Larablog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        /* Center full post section */
        .full-post {
            max-width: 800px; 
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        /* Comment styling */
        .comment {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .comment strong {
            color: #333;
        }

        .comment small {
            color: #666;
        }

        .comment-form textarea, 
        .comment-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .comment-form button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #0056b3;
        }
    </style>
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
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">
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

    <section class="container full-post">
        <h2>{{ $post->post_title }}</h2>
        <p><small>Posted on {{ $post->created_at->format('F j, Y') }}</small></p>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" 
                 alt="{{ $post->post_title }}" 
                 style="max-width:100%; height:auto; margin:20px 0;">
        @endif

        <div class="post-body">
            <p>{{ $post->description }}</p>
        </div>
        <br>
        <br>

        <a href="{{ url()->previous() }}" class="btn btn-xs mb-2">Go Back</a>
        <br>

        <hr>

        <!-- Comments Section -->
        <h3>Comments:</h3>
        @if($post->comments->count() > 0)
            @foreach($post->comments as $comment)
                <div class="comment">
                    <strong>{{ $comment->author_name }}</strong> said:<br>
                    {{ $comment->content }}
                    <br>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        @else
            <p>No comments yet. Be the first to comment!</p>
        @endif

        <hr>

        <!-- Comment Form (only for logged-in users) -->
        @auth
            <h3>Leave a Comment:</h3>
            @if(session('success'))
                <p style="color:green">{{ session('success') }}</p>
            @endif

            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="comment-form">
                @csrf
                <input type="text" name="author_name" placeholder="Your name" required value="{{ auth()->user()->name }}">
                <textarea name="content" placeholder="Write your comment..." required rows="4"></textarea>
                <button type="submit">Post Comment</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Login</a> to leave a comment.</p>
        @endauth

    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Larablog. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

