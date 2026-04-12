<!-- SUCESSO -->
<?php if (session()->has('sucesso')) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Deu certo!</strong>
        <?php // retorno de FlashDatas 
        echo session('sucesso'); ?>
        <!-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. -->
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>

<!-- INFO -->
<?php if (session()->has('info')) : ?>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Informação!</strong>
        <?php // retorno de FlashDatas 
        echo session('info'); ?>
        <!-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. -->
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>

<!-- ATENCAO -->
<?php if (session()->has('atencao')) : ?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atenção!</strong>
        <?php // retorno de FlashDatas 
        echo session('info'); ?>
        <!-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. -->
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>

<!-- ERROS_MODEL (Utilizaremos quando for feitopost sem ajax request) -->
<?php if (session()->has('erros_model')) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>

            <?php foreach ($erros_model as $erro) : ?>

                <li class="text-danger"></li>

            <?php endforeach; ?>

        </ul>
    </div>

<?php endif; ?>

<!-- Utilizamos quanto o form for interceptado por erros do backend
ou quando estivermos fazendo um debug para ver o que esta vindo do POST -->
<?php if (session()->has('erro')) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erro:</strong>
        <?php // retorno de FlashDatas 
        echo session('error'); ?>
        <!-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. -->
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>