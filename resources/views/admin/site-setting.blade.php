@extends('layouts.app')
@section('title', 'Site Setting')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>

                <div class="panel-body">
                    @if($site->count() < 1)
                        
                        <div class="col-md-6 col-xs-12 col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form id="site-setting" method="post" action="/manage/admin/site/setting">
                                        {{csrf_field()}}
                                        <label>Google reCAPTCHA Site Key</label>
                                        <input type="text" name="g_captcha_site" class="form-control" placeholder="Ex: 6LdEbw8UAAAAAMFeJ0fc_Eix_xxxxxxx_xxxxxx">
                                        <label>Google reCAPTCHA Secret Key</label>
                                        <input type="password" name="g_captcha_secret" class="form-control" placeholder="Ex: 6LdEbw8UAAAAAMuqoRdtKiW28kxxxxxxxxxxxx">
                                        <label>Cloudflare Api Key</label>
                                        <input type="password" name="cloudflare_api_key" class="form-control" placeholder="Ex: bb36k8sj3nk92ojxxxxxxxxxx">
                                        <label>Cloudflare Email Address</label>
                                        <input type="text" name="cloudflare_email_address" class="form-control" placeholder="Ex: blabla@gmail.com">
                                        <label>Site Wtermark</label>
                                        <input type="text" name="watermark" class="form-control" placeholder="Ex: domain.com (domain.com-userssh)">
                                        <label>Crons Allowed IP</label>
                                        <input type="text" name="allowed_ip" class="form-control" placeholder="Ex: 128.199.22.11">
                                        <hr />
                                        <button id="btn-site-setting" class="btn btn-success" type="submit" style="width: 100%;text-align: center;">Save!</button>
                                    </form>
                               </div>
                            </div>
                        </div>
                    @else
                        <h2 style="text-align: center;">NO NEED TO SETTING.</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
