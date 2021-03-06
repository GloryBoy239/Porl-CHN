@extends('layouts.minimal')

@section('title')
Setup
@endsection

@section('css')
<link rel='stylesheet' href='/css/default-bootstrap.min.css'>
<link rel='stylesheet' href='/css/setup.css'>
@endsection

@section('content')
<div class="navbar navbar-default navbar-fixed-top">
    <a class="navbar-brand" href="/">Polr</a>
</div>

<div class="row" ng-controller="SetupCtrl" class="ng-root">
    <div class='col-md-3'></div>

    <div class='col-md-6 setup-body well'>
        <div class='setup-center'>
            <img class='setup-logo' src='/img/logo.png'>
        </div>

        <form class='setup-form' method='POST' action='/setup'>
            <h4>数据库设置</h4>

            <p>数据库地址:</p>
            <input type='text' class='form-control' name='db:host' value='localhost'>

            <p>数据库端口:</p>
            <input type='text' class='form-control' name='db:port' value='3306'>

            <p>数据库用户名:</p>
            <input type='text' class='form-control' name='db:username' value='root'>

            <p>数据库密码:</p>
            <input type='password' class='form-control' name='db:password' value='password'>

            <p>
                数据库名:
                <setup-tooltip content="必须是存在的数据库, 你需要手动创建."></setup-tooltip>
            </p>
            <input type='text' class='form-control' name='db:name' value='polr'>


            <h4>应用设置</h4>

            <p>网站名称:</p>
            <input type='text' class='form-control' name='app:name' value='Polr'>

            <p>网站访问方式:</p>
            <input type='text' class='form-control' name='app:protocol' value='http://'>

            <p>网站域名 (不要包括 http(s)://, 将与上面的访问方式组成一个完整的域名.):</p>
            <input type='text' class='form-control' name='app:external_url' value='yoursite.com'>

            <p>
                高级分析:
                <button data-content="启用高级分析以收集诸如访问来源、地理位置和点击次数等数据. 启用会降低性能, 并增加磁盘空间使用量."
                    type="button" class="btn btn-xs btn-default setup-qmark" data-toggle="popover">?</button>
            </p>
            <select name='setting:adv_analytics' class='form-control'>
                <option value='false' selected='selected'>关闭</option>
                <option value='true'>启用</option>
            </select>

            <p>
                MaxMind GeoIP 许可证密钥 (仅高级分析需要):
            </p>
            <p>
            <input type='text' class='form-control' name='maxmind:license_key' value=''>

            <p class='text-muted'>
                要获得免费的 MaxMind GeoIP 许可证密钥, 请按照 Polr 网站上的 <a href="https://docs.polrproject.org/en/latest/user-guide/maxmind-license">文档说明</a> .
            </p>

            <p>权限:</p>
            <select name='setting:shorten_permission' class='form-control'>
                <option value='false' selected='selected'>所有人都可以生成 URLs</option>
                <option value='true'>只有注册用户可以生成 URLs</option>
            </select>

            <p>公共接口:</p>
            <select name='setting:public_interface' class='form-control'>
                <option value='true' selected='selected'>显示公共接口 (默认)</option>
                <option value='false'>重定向到指定 URL</option>
            </select>

            <p>错误信息:</p>
            <select name='setting:redirect_404' class='form-control'>
                <option value='false' selected='selected'>展示错误信息 (默认)</option>
                <option value='true'>重定向到指定 URL</option>
            </select>

            <p>
                重定向 URL:
                <setup-tooltip content="如果您希望将首页或 404 重定向到其他 URL, 则此为必需项。要使用 Polr，请先登录 yoursite.com/login."></setup-tooltip>
            </p>
            <input type='text' class='form-control' name='setting:index_redirect' placeholder='http://your-main-site.com'>
            <p class='text-muted'>
                如果启用了重定向, 您需要先转到 http://yoursite.com/login 进行登录.
            </p>

            <p>
                URL 展示风格:
                <setup-tooltip content="如果选择使用伪随机字符串，则不能按顺序排列."></setup-tooltip>
            </p>
            <select name='setting:pseudor_ending' class='form-control'>
                <option value='false' selected='selected'>使用 base62 或者 base32  (更短但更可预测, e.g 5a)</option>
                <option value='true'>使用伪随机字符串 (更长更不可预测, e.g 6LxZ3j)</option>
            </select>

            <p>
                URL 结尾样式:
                <setup-tooltip content="如果选择使用伪随机结束, 这将没有效果."></setup-tooltip>
            </p>
            <select name='setting:base' class='form-control'>
                <option value='32' selected='selected'>32 -- 小写字母 & 数字 (默认)</option>
                <option value='62'>62 -- 大/小写字母 & 数字</option>
            </select>

            <h4>
                管理员设置
                <setup-tooltip content="这些设置将作用于管理员."></setup-tooltip>
            </h4>

            <p>Admin 用户名:</p>
            <input type='text' class='form-control' name='acct:username' value='polr'>

            <p>Admin Email:</p>
            <input type='text' class='form-control' name='acct:email' value='polr@admin.tld'>

            <p>Admin 密码:</p>
            <input type='password' class='form-control' name='acct:password' value='polr'>

            <h4>
                SMTP 设置
                <setup-tooltip content="Required only if the email verification or password recovery features are enabled."></setup-tooltip>
            </h4>

            <p>SMTP 服务器:</p>
            <input type='text' class='form-control' name='app:smtp_server' placeholder='smtp.gmail.com'>

            <p>SMTP 端口:</p>
            <input type='text' class='form-control' name='app:smtp_port' placeholder='25'>

            <p>SMTP 用户名:</p>
            <input type='text' class='form-control' name='app:smtp_username' placeholder='example@gmail.com'>

            <p>SMTP 密码:</p>
            <input type='password' class='form-control' name='app:smtp_password' placeholder='password'>

            <p>SMTP From:</p>
            <input type='text' class='form-control' name='app:smtp_from' placeholder='example@gmail.com'>
            <p>SMTP From Name:</p>
            <input type='text' class='form-control' name='app:smtp_from_name' placeholder='noreply'>

            <h4>API 设置</h4>

            <p>公共 API:</p>
            <select name='setting:anon_api' class='form-control'>
                <option selected value='false'>关闭: 只有注册用户可用</option>
                <option value='true'>启用: 接受空的 key API 要求</option>
            </select>

            <p>
                公共 API 限制:
                <setup-tooltip content="空的 key API 要求的限制 (每分钟)."></setup-tooltip>
            </p>
            <input type='text' class='form-control' name='setting:anon_api_quota' placeholder='10'>

            <p>自动 API 生成:</p>
            <select name='setting:auto_api_key' class='form-control'>
                <option selected value='false'>关闭: 管理员必须逐一启用</option>
                <option value='true'>启用: 每个用户在注册时即生成</option>
            </select>

            <h4>其他设置</h4>

            <p>
                注册:
                <setup-tooltip content="启用注册, 允许任何人创建帐户."></setup-tooltip>
            </p>
            <select name='setting:registration_permission' class='form-control'>
                <option value='none'>关闭</option>
                <option value='email'>启用, 需电子邮箱验证</option>
                <option value='no-verification'>启用, 不用邮箱验证</option>
            </select>

            <p>
                限制注册电子邮件域域名:
                <setup-tooltip content="限制某些邮件域注册."></setup-tooltip>
            </p>
            <select name='setting:restrict_email_domain' class='form-control'>
                <option value='false'>允许任何邮件域注册</option>
                <option value='true'>只允许下面的邮件域注册</option>
            </select>

            <p>
                允许的电子邮件域名:
                <setup-tooltip content="请用英文逗号分隔."></setup-tooltip>
            </p>
            <input type='text' class='form-control' name='setting:allowed_email_domains' placeholder='company.com,company-corp.com'>

            <p>
                找回密码:
                <setup-tooltip content="密码恢复, 允许用户通过电子邮件重置密码."></setup-tooltip>
            </p>
            <select name='setting:password_recovery' class='form-control'>
                <option value='false'>关闭</option>
                <option value='true'>启用</option>
            </select>
            <p class='text-muted'>
                在启用找回密码功能之前，请正确设置 SMTP.
            </p>

            <p>
                注册时开启 reCAPTCHA 验证码 (大陆可用)
                <setup-tooltip content="您必须提供您的reCAPTCHA密钥才能使用此功能."></setup-tooltip>
            </p>
            <select name='setting:acct_registration_recaptcha' class='form-control'>
                <option value='false'>关闭</option>
                <option value='true'>启用</option>
            </select>

            <p>
                reCAPTCHA 设置:
                <setup-tooltip content="如果您打算使用任何与reCAPTCHA相关的功能, 则必须提供reCAPTCHA密钥."></setup-tooltip>
            </p>

            <p>
                reCAPTCHA Site Key
            </p>
            <input type='text' class='form-control' name='setting:recaptcha_site_key'>

            <p>
                reCAPTCHA Secret Key
            </p>
            <input type='text' class='form-control' name='setting:recaptcha_secret_key'>

            <p class='text-muted'>
                你可以访问 <a href="https://www.google.com/recaptcha/admin">Google's reCAPTCHA website</a> 获取 KEY (请搭梯子).
            </p>

            <p>预览 (<a href='https://github.com/cydrobolt/polr/wiki/Themes-Screenshots'>截屏</a>):</p>
            <select name='app:stylesheet' class='form-control'>
                <option value=''>Modern (default)</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cyborg/bootstrap.min.css'>Midnight Black</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css'>Orange</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/simplex/bootstrap.min.css'>Crisp White</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css'>Cloudy Night</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css'>Calm Skies</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css'>Google Material Design</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css'>Blue Metro</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/sandstone/bootstrap.min.css'>Sandstone</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/lumen/bootstrap.min.css'>Newspaper</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/solar/bootstrap.min.css'>Solar</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css'>Cosmo</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css'>Flatly</option>
                <option value='//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css'>Yeti</option>
            </select>
            <p>
                请仔细检查，确认无误后点击安装！
            </p>

            <div class='setup-form-buttons'>
                <input type='submit' class='btn btn-success' value='安装'>
                <input type='reset' class='btn btn-warning' value='清除字段'>
            </div>
            <input type="hidden" name='_token' value='{{csrf_token()}}' />
        </form>
    </div>

    <div class='col-md-3'></div>
</div>

<div class='setup-footer well'>
    Polr 是根据 <a href='//www.gnu.org/copyleft/gpl.html'>GPLv2+
    </a> 许可授权的 <a href='https://opensource.org/osd' target='_blank'>开源软件</a> .

    <div>
        Polr Version {{env('VERSION')}} released {{env('VERSION_RELMONTH')}} {{env('VERSION_RELDAY')}}, {{env('VERSION_RELYEAR')}} -
        <a href='//github.com/cydrobolt/polr' target='_blank'>Github</a>

        <div class='footer-well'>
            &copy; Copyright {{env('VERSION_RELYEAR')}}
            <a class='footer-link' href='//cydrobolt.com' target='_blank'>Chaoyi Zha</a> &amp;
            <a class='footer-link' href='//github.com/Cydrobolt/polr/graphs/contributors' target='_blank'>其他 Polr 贡献者</a>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="/js/bootstrap.min.js"></script>
<script src='/js/angular.min.js'></script>
<script src='/js/base.js'></script>
<script src='/js/SetupCtrl.js'></script>
@endsection
