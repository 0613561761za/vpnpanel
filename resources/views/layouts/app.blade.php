<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VPN Panel - @yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/sweetalert.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Scripts -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style type="text/css">
        .opt {
            font-size: 100px !important;
            text-align: center !important;
            display: block !important;
        }
    </style>
</head>
<body style="margin-top: 25px; ">

    <!-- Navigation Bar -->

    <div class="container">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{url('/')}}">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="{{url('/server/ssh?utm_source=nav&hash_id=' . md5(uniqid()))}}">SSH <span class="sr-only">(current)</span></a></li>
                    <li><a href="{{url('/server/vpn?utm_source=nav&hash_id=' . md5(uniqid()))}}">VPN</a></li>
                    <li><a href="{{url('/server/panel?utm_source=nav&hash_id=' . md5(uniqid()))}}">PANEL</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TOOLS <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{url('/tools/host-to-ip?utm_source=nav&hash_id=' . md5(uniqid()))}}">Host To IP</a></li>
                        <li><a href="{{url('/tools/dns-creator?utm_source=nav&hash_id=' . md5(uniqid()))}}">DNS Creator</a></li>
                        <li><a href="{{url('/tools/port-check?utm_source=nav&hash_id=' . md5(uniqid()))}}">Open Port Check</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PAGES <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{url('/pages/vpn-config?utm_source=nav&hash_id=' . md5(uniqid()))}}">VPN Config Download</a></li>
                        <li><a href="{{url('/pages/ssh-checker?utm_source=nav&hash_id=' . md5(uniqid()))}}">SSH Account Checker</a></li>
                        <li><a href="{{url('/pages/squid-proxy?utm_source=nav&hash_id=' . md5(uniqid()))}}">SQUID List</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GROUPS <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li>{{@App\groupss::groups()}}</li>
                      </ul>
                    </li>

          @if(!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SERVER <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{url('/manage/admin/server/add?utm_source=nav&hash_id=' . md5(uniqid()))}}">Add Server</a></li>
                          <li><a href="{{url('/manage/admin/server/list?utm_source=nav&hash_id=' . md5(uniqid()))}}">List Server</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ACCOUNT <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{url('/manage/admin/ssh/list?utm_source=nav&hash_id=' . md5(uniqid()))}}">SSH Account List</a></li>
                          <li><a href="{{url('/manage/admin/vpn/list?utm_source=nav&hash_id=' . md5(uniqid()))}}">VPN Account List</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SQUID <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{url('/manage/admin/squid/?utm_source=nav&hash_id=' . md5(uniqid()))}}">SQUID List</a></li>
                          <li><a href="{{url('/manage/admin/squid/add?utm_source=nav&hash_id=' . md5(uniqid()))}}">Add SQUID</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GROUP <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{url('/manage/admin/server/group?utm_source=nav&hash_id=' . md5(uniqid()))}}">Group List</a></li>
                          <li><a href="{{url('/manage/admin/server/group/add?utm_source=nav&hash_id=' . md5(uniqid()))}}">Add Group</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DNS <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{url('/manage/admin/dns/add?utm_source=nav&hash_id=' . md5(uniqid()))}}">Add DNS</a></li>
                          <li><a href="{{url('/manage/admin/dns/?utm_source=nav&hash_id=' . md5(uniqid()))}}">DNS List</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ADS <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{url('/manage/admin/ads/add?utm_source=nav&hash_id=' . md5(uniqid()))}}">Add Ads</a></li>
                          <li><a href="{{url('/manage/admin/ads/?utm_source=nav&hash_id=' . md5(uniqid()))}}">Ads List</a></li>
                        </ul>
                      </li>
                      <li><a href="{{url('manage/admin/logout?utm_source=nav&hash_id=' . md5(uniqid()))}}">LOGOUT <span class="sr-only">(current)</span></a></li>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </ul>
              @endif
          </nav>
      </div>

    <!-- End of Navigation Bar -->
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->

    <script src="/js/config.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/sweetalert.min.js"></script>


</body>
</html>
