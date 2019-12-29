<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    <div class="table-responsive">
                        <table class="table table-borered table-hover">
                            <thead>
                            <tr class="row no-gutters">
                                <th class="col-md-2">
                                    <form action="/home" method="post">
                                        <a href="javascript:void(0);" onclick="parentNode.submit();">Имя</a>
                                        <input type="hidden" name="sort" value="name">
                                    </form>
                                </th>
                                <th class="col-md-3">
                                    <form action="/home" method="post">
                                        <a href="javascript:void(0);" onclick="parentNode.submit();">Email</a>
                                        <input type="hidden" name="sort" value="email">
                                    </form>
                                </th>
                                <th class="col-md-6">
                                    <form action="/home" method="post">
                                        <a href="javascript:void(0);" onclick="parentNode.submit();">Задача</a>
                                        <input type="hidden" name="sort" value="text">
                                    </form>
                                </th>
                                <th class="col-md-1">
                                    <form action="/home" method="post">
                                        <a href="javascript:void(0);" onclick="parentNode.submit();">Действия</a>
                                        <input type="hidden" name="sort" value="text">
                                    </form>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            <?foreach ($tasks as $task):?>

                                <tr class="row no-gutters">
                                    <td class="col-md-2"><?=$task['name']?></td>
                                    <td class="col-md-3"><?=$task['email']?></td>
                                    <td class="col-md-6"><?=$task['text']?></td>

                                    <td class="col-md-1">
                                        <a href="/home/update/?id=<?=$task['id']?>" title="Редактировать">
                                            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M13.293 3.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM14 4l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"></path>
                                                <path fill-rule="evenodd" d="M14.146 8.354l-2.5-2.5.708-.708 2.5 2.5-.708.708zM5 12v.5a.5.5 0 00.5.5H6v.5a.5.5 0 00.5.5H7v.5a.5.5 0 00.5.5H8v-1.5a.5.5 0 00-.5-.5H7v-.5a.5.5 0 00-.5-.5H5z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>


                                        <a class="delete" href=""
                                           title="Перевести статус = On">
                                            <i class="fa fa-fw fa-refresh"></i>
                                        </a>


                                    </td>
                                </tr>

                            <?endforeach;?>
                            </tbody>
                        </table>
                    </div>


                    <div class="text-center d-flex">
                        <ul class="pagination row mx-auto" style="margin-top: 50px; margin-bottom: 50px">
                            <?if ($pages > 1):?>
                                <?for($page=0; $page < $pages; $page++):?>
                                    <?if($page == $current_page):?>
                                        <li class="page-item active"><a href="" class='page-link'><?=$page+1?></a></li>
                                    <?else:?>
                                        <li class="page-item"><a href="?PAG=<?=$page?>" class="page-link"><?=$page+1?></a></li>
                                    <?endif;?>
                                <?endfor;?>
                            <?endif;?>
                        </ul>
                    </div>



                        <form action="/home/create" class="form-task-create" style="margin: auto" method="POST">
                            <div class="row">
                                <div class="col-md-2 mb-2 small-paddings">
                                    <label for="inputName" class="sr-only">Имя</label>
                                    <input type="text" id="inputName" class="form-control" placeholder="Имя" required="" autofocus="" name="name">
                                </div>
                                <div class="col-md-2 mb-2 small-paddings">
                                    <label for="inputEmail" class="sr-only">Email</label>
                                    <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="email">
                                </div>
                                <div class="col-md-6 mb-6 small-paddings">
                                    <label for="inputText" class="sr-only">Текст задачи</label>
                                    <input type="text" id="inputText" class="form-control" placeholder="Текст задачи" required="" name="text">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button class="btn btn-lg btn-primary btn-block save-task" type="submit">Сохранить</button>
                                </div>
                            </div>
                        </form>


                    <?if (!empty($errors)):?>
                        <div class="text-center">
                            <?foreach ($errors as $error):?>
                                <h3 style="color: red">
                                    <?=$error?>
                                </h3>
                            <?endforeach;?>
                        </div>
                    <?endif;?>



                    <div class="text-center">
                        <a class="btn btn-lg btn-primary btn-block sign-in" type="submit" href="/auth">Sign in</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var pag = new URLSearchParams(window.location.search).get('PAG');

</script>