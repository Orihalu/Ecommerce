<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        <div class="container">
                        	<div class="row">
                        	    <div class="col-12">
                            	    <div id="custom-search-input">
                                        <div class="input-group">
                                            <input type="text" class="search-query form-control" placeholder="Search" />
                                            <span class="input-group-btn">
                                                <div class="nav-right">
                                                  <div class="nav-search-submit nav-sprite">
                                                    <input type="submit" class="nav-input" value="検索" tabindex="7">
                                                  </div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        	</div>
                        </div>
{{--
                    <div id="nav-search">
                      <div id="nav-bar-left"></div>
                        <form accept-charset="utf-8" action="/s/ref=nb_sb_noss/358-8640043-4782417" class="nav-searchbar" method="GET" name="site-search" role="search">
                          <input type="hidden" name="__mk_ja_JP" value="カタカナ">
                            <div class="nav-left">
                              <div class="nav-search-scope nav-sprite">
                                <div class="nav-search-facade" data-value="search-alias=aps">
                                  <span class="nav-search-label" style="width: auto;">すべて</span>
                                  <i class="nav-icon"></i>
                                </div>
                                <span id="searchDropdownDescription" style="display:none">検索するカテゴリーを選択します。</span>

                                <select aria-describedby="searchDropdownDescription" class="nav-search-dropdown searchSelect" data-nav-digest="x+nq99qAjs5bwXdevLDfgyqyqd8" data-nav-selected="0" id="searchDropdownBox" name="url" style="display: block; top: 0px;" tabindex="5" title="次の中から検索">
                                <option selected="selected" value="search-alias=aps">すべてのカテゴリー</option>
                                <option value="search-alias=computers">パソコン・周辺機器</option>
                                </select>
                              </div>
                            </div>
                          <div class="nav-right">
                            <div class="nav-search-submit nav-sprite">
                              <input type="submit" class="nav-input" value="検索" tabindex="7">
                            </div>
                          </div>
                          <div class="nav-fill">
                            <div class="nav-search-field ">

                              <input type="text" id="twotabsearchtextbox" value="" name="field-keywords" autocomplete="off" placeholder="" class="nav-input" dir="auto" tabindex="6">
                            </div>
                          <div id="nav-iss-attach"></div>
                        </div>
                      </form>
                    </div>
                    --}}

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ action('UserController@showCart',Auth::user()) }}">{{ __('Cart') }}::0</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
  </div>
</body>
</html>
