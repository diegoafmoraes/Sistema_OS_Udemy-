<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('estilos') ?>
<!-- Aqui vao os estilos das views -->
<?= $this->endSection() ?>

<?= $this->section('conteudo') ?>
<!-- Aqui vao os conteudos da view -->
<div class="row">
    <div class="col-lg-8">
        <div class="block">

            <div class="block-body">

                <!-- Recebera os retornos do Backend -->
                <div id="response">

                </div>

                <?php echo form_open('/', ['id' => 'form'], ['id' => "$usuario->id"]); ?>

                <?php echo $this->include('Usuarios/_form') ?>

                <div class="form-group mt-5 mb-2">

                    <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-sm btn-danger mr-2">
                    <a href="<?= site_url("usuarios/exibir/{$usuario->id}") ?>" class="btn btn-sm btn-secondary my-2">Voltar</a>

                </div>

                <?php echo form_close(); ?>

            </div>

        </div> <!-- / block -->
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Aqui vao os scripts dessa view -->
<script>
    $(document).ready(function() {

        $("#form").on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('usuarios/atualizar'); ?>',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {

                    $("#response").html('');
                    $("#btn-salvar").val('Por favor, aguarde...');

                },
                success: function(response) {

                    $("#btn-salvar").val('Salvar');
                    $("#btn-salvar").removeAttr("disabled");

                    $('[name=csrf_ordem]').val(response.token);

                    if (!response.erro) {

                        if (response.info) {

                            $("#response").html('<div class="alert alert-info">' + response.info + '</div>');

                        } else {

                            // Tudo certo com a atualizacao do usuario
                            // Podemos agora redireciona-lo tranquilamente

                            window.location.href = "<?php echo site_url("usuarios/exibir/{$usuario->id}"); ?>";

                        }

                    }

                    if (response.erro) {

                        // Existem erros de validacao
                        $("#response").html('<div class="alert alert-danger">"' + response.erro + '"</div>');

                        if (response.erros_model) {

                            $.each(response.erros_model, function(key, value) {

                                $("#response").append('<ul class="ml-3 list-unstyled"><li class="text-danger"><h5>' + value + '</h5></li></ul>');

                            });

                        }
                    }
                },
                error: function() {

                    alert('Não foi possível processar a solicitação. Por favor, enre em contato com o suporte técnico.');
                    $("#btn-salvar").val('Salvar');
                    $("#btn-salvar").removeAttr("disabled");

                }

            });

        });

        $("#form").submit(function() {

            $(this).find(":submit").attr('disabled', 'disabled');

        });

    });
</script>
<?= $this->endSection() ?>