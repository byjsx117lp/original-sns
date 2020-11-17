<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>original-app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
</head>

<body class="container-fluid">
    <header>
        <div id="header-box" class="row">
            <div id="logo" class="col-md-6">
                <p><a href="/">Original App</a></p>
            </div>
            <div id="welcome" class="col-md-6">
                @if(Auth::check())
                <div class="col">
                    <p>ようこそ、{{ Auth::user()->name }}さん</p>
                    <a class="menu-name" href="logout" id="logout">
                        <i class="fas fa-unlock">ログアウト</i>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>
                @else
                <div class="col">
                    <p>ようこそ、ゲストさん</p>
                    <a class="menu-name" href="{{ route('posts.index') }}">
                        <i class="fas fa-search">記事検索</i>
                    </a>
                    <a class="menu-name" href="{{ route('login') }}">
                        <i class="fas fa-lock">ログイン</i>
                    </a>
                    <a class="menu-name" href="{{ route('register') }}">
                        <i class="fas fa-pen">新規登録</i>
                    </a>
                </div>
                @endif
            </div>
            <div id="sp-welcome" class="col-md-6">
                @if(Auth::check())
                <div class="col">
                    <p>ようこそ、{{ Auth::user()->name }}さん</p>
                    <a class="menu-name" href="logout" id="sp-logout">
                        <i class="fas fa-unlock">ログアウト</i>
                        <form id="sp-logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>
                @else
                <div class="col">
                    <p>ようこそ、ゲストさん</p>
                    <a class="menu-name" href="{{ route('login') }}">
                        <i class="fas fa-lock">ログイン</i>
                    </a>
                    <a class="menu-name" href="{{ route('register') }}">
                        <i class="fas fa-pen">新規登録</i>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <ul id="menu-nav" class="row">
            @if(Auth::check())
            <li class="col-6 col-md-3 menu">
                <a class="menu-name" href="{{ route('posts.index') }}">
                    <i class="fas fa-search">記事検索</i>
                </a>
            </li>
            <li class="col-6 col-md-3 menu">
                <a href="{{ route('posts.create') }}">
                    <i class="fas fa-copy">記事作成</i>
                </a>
            </li>
            <li class="col-6 col-md-3 menu">
                <a href="{{ route('mypage') }}">
                    <i class="fas fa-user-circle">マイページ</i>
                </a>
            </li>
            <li class="col-6 col-md-3 menu">
                <a href="{{ route('rooms.index')}}">
                    <i class="fas fa-comments">メッセージ</i>
                </a>
            </li>
            @endif
        </ul>
    </header>
    <div id="burger-menu">
        <div @click="active()" class="btn-trigger" v-bind:class="[{ active : isActive }]">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <div id="sp-menu" v-if="isPanelShow">
            <ul>
                <li>
                    <a href="{{ route('posts.index') }}">記事検索</a>
                </li>
                @if(Auth::check())
                <li>
                    <a href="{{ route('posts.create') }}">記事作成</a>
                </li>
                <li>
                    <a href="{{ route('mypage') }}">マイページ</a>
                </li>
                <li>
                    <a href="{{ route('rooms.index') }}">メッセージ</a>
                </li>
                <li>
                    
                </li>
                @else
                <li>
                    <a href="{{ route('login') }}">ログイン</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">新規登録</a>
                </li>
                @endif
            </ul>
        </div>
                    
    </div>
    
    <main>
        @yield('content')
    </main>
    <footer id="copyright">
        <p>© 2020 RyuyaTsuruta</p>
    </footer>

    <script src="/js/app.js"></script>

    @if(Auth::check())
    <script>
    document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });

    document.getElementById('sp-logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('sp-logout-form').submit();
    });
    </script>
    @endif

    <script>
    new Vue({
        el: '#burger-menu',
        data: {
            isActive: false,
            isPanelShow: false,
        },
        methods: {
            active: function() {
                this.isActive = !this.isActive;
                this.isPanelShow = !this.isPanelShow;
            },
        },
    });
    </script>

    @yield('scripts')
</body>

</html>
