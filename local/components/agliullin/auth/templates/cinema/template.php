<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["AUTH"] == false) {?>
<?php if ($arResult["ERROR"] != null) {
	echo $arResult["ERROR"];
} ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Авторизация</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST">
            <fieldset>
                <div class="form-group">
                    <label for="inputLogin" class="col-lg-3 control-label">Логин</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="LOGIN" placeholder="Логин" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="col-lg-3 control-label">Пароль</label>
                    <div class="col-lg-9">
                        <input type="password" class="form-control" name="PASSWORD" placeholder="Пароль">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10">
                        <button type="submit" name="LOG_IN" class="btn btn-default btn-sm">Войти</button>
                    </div>
                </div>

                <a href="<?=$arResult["REGISTER_URL"]?>">Регистрация</a>
            </fieldset>
        </form>
    </div>
</div>

<?
} else {
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Профиль</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST">
            <fieldset>
                <div class="well"><?=$arResult["NAME"]?></div> 
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" name="LOG_OUT" class="btn btn-default btn-sm  btn-block">Выйти</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?}?>