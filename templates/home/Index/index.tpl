<{include file="Public/header.tpl" title=foo}>
<link href="<{$__CSS__}>/style.css" rel="stylesheet">
<div class="container body-div" style="background: url('{$__IMG__}home/left_backimg.png')">
    <div class="row">
        <div class="col-sm-12 text-message">Learning to Live</div>
        <div class="col-sm-12 text-message">To learn how to manage money</div>
        <div class="col-sm-12 text-message">Starting from an account</div>
        <div class="col-sm-6 sigin-in">
            <p>Existing account？</p>
            <a type="button" class="btn btn-default btn-lg" href="#">Sign in</a>
        </div>
        <div class="col-sm-6 register-in">
            <p>No account？</p>
            <a type="button" class="btn btn-default btn-lg" href="./?m=user&c=register">Register</a>
        </div>

    </div>
</div>
<{include file="Public/footer.tpl" title=foo}>
