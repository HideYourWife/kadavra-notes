<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body edit-box">

                    <div class="py-5 text-center">
                        <h2>Редактирование элемента</h2>
                        <?if (!empty($errors)):?>
                            <?foreach ($errors as $error):?>
                                <p style="color: red"><?=$error?></p>
                            <?endforeach;?>
                        <?endif;?>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-2 small-paddings">
                            <span>Имя</span>
                        </div>
                        <div class="col-md-2 mb-2 small-paddings">
                            <span>Email</span>
                        </div>
                        <div class="col-md-7 mb-7 small-paddings">
                            <span>Текст задания</span>
                        </div>
                        <div class="col-md-1 custom-control custom-checkbox">
                            <span>Выполнено</span>
                        </div>
                    </div>

                    <form action="/home/update/" class="form-task-create" style="margin: auto" method="POST">
                        <div class="row">
                            <div class="col-md-2 mb-2 small-paddings">
                                <label for="inputName" class="sr-only">Имя</label>
                                <input type="text" id="inputName" class="form-control" value="<?=$task['name']?>" name="name" disabled>
                            </div>
                            <div class="col-md-2 mb-2 small-paddings">
                                <label for="inputEmail" class="sr-only">Email</label>
                                <input type="email" id="inputEmail" class="form-control" value="<?=$task['email']?>" name="email" disabled>
                            </div>
                            <div class="col-md-7 mb-7 small-paddings">
                                <label for="inputText" class="sr-only">Текст задачи</label>
                                <input type="text" id="inputText" class="form-control" value="<?=$task['text']?>" required="" name="text">
                            </div>
                            <div class="col-md-1 custom-control custom-checkbox">
                                <input type="checkbox" id="inputStatus" class="form-control" <?=$task['resolved'] ? 'checked' : ''?> name="resolved">
                                <label for="inputStatus" class="sr-only">Выполнено</label>
                            </div>
                            <input type="hidden" value="<?=$task['id']?>" name="id">
                        </div>

                            <div class="col-md-2 mb-2 float-right">
                                <button class="btn btn-lg btn-primary btn-block edit-task" type="submit">Сохранить</button>
                            </div>

                    </form>



                </div>
            </div>
        </div>
    </div>
</section>