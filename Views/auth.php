<section class="text-center" style="display: flex; align-items: center; padding-top: 40px; padding-bottom: 40px; margin: auto">

<?if (!$is_auth):?>

    <form class="form-signin" action="/auth/login" method="post" style="margin: auto">

        <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="text" id="inputEmail" class="form-control" name="name" placeholder="Login" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Пароль" required="">

        <button class="btn btn-lg btn-primary btn-block btn-auth" type="submit">Авторизация</button>
    </form>

<?else:?>


        <div class="container">
            <h2 class="jumbotron-heading">Вы авторизированы, выйти ?</h2>
            <p>
                <a href="/" class="btn btn-primary my-2">Вернутся на главную</a>
                <a href="/auth/logout" class="btn btn-secondary my-2">Выход</a>
            </p>
        </div>


<?endif;?>


</section>