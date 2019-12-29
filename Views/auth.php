
    <div class="login-page" style="margin-left: 40%; margin-top: 10%">
    <div class="col-3">
        <div class="text-center">
            <p style="color: red"><?=$msg?></p>
        </div>
    </div>
<?if (!$is_auth):?>
<div class="col-3">
    <form class="form-signin" action="/auth/login" method="post" style="margin: auto">

        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Авторизация</h1>
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="text" id="inputEmail" class="form-control" name="name" placeholder="Login" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Пароль" required="">

        <button class="btn btn-lg btn-primary btn-block btn-auth" type="submit">Авторизация</button>
    </form>
</div>
<?else:?>



            <h5 class="">Вы авторизированы, выйти ?</h5>
            <p>
                <a href="/" class="btn btn-primary my-2">Вернутся на главную</a>
                <a href="/auth/logout" class="btn btn-secondary my-2">Выход</a>
            </p>

    </div>
<?endif;?>


