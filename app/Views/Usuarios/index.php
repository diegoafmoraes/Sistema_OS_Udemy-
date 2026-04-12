<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('estilos') ?>
<!-- Aqui vao os estilos das views -->
<!-- DataTables -->
<link href="https://cdn.datatables.net/v/bs4/dt-2.3.5/r-3.0.7/datatables.min.css" rel="stylesheet" integrity="sha384-7BuMUZVY1n5/MC0a4MwlfSWYITJAWwNfOI3Pn3G37vlXjjKMqKowKM15z2TY/7Nt" crossorigin="anonymous">
<?= $this->endSection() ?>

<?= $this->section('conteudo') ?>
<!-- Aqui vao os conteudos das views -->
<div class="row">
    <div class="col-lg-12">
        <div class="block">

            <a href="<?= site_url('usuarios/criar'); ?>" class="btn btn-danger mb-5 float-left">Criar Novo Usuário</a>

            <div class="table-responsive">
                <table id="ajaxTable" class="table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <!-- Cont. Dinamico AJAX -->
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Aqui vao os scripts das views -->
<!-- DataTables -->
<script src="https://cdn.datatables.net/v/bs4/dt-2.3.5/r-3.0.7/datatables.min.js" integrity="sha384-xNl4KzWHw1EHKaRnrmS9oDxGXAqYaJgo7L5Pl8yXfLXP6eJD5IN1poOMFK4UcBeV" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        const DATATABLE_PTBR = {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registro(s)",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Carregando...",
            "sZeroRecords": "Nenhum registro encontrado.",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sFirst": "Primeito",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último",
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente ",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "",
                    "1": "Selecionado 1 linha"
                }
            }
        }

        new DataTable('#ajaxTable', {

            "oLanguage": DATATABLE_PTBR,

            "ajax": "<?php echo site_url("usuarios/recuperaUsuarios"); ?>",
            "columns": [{
                    data: 'imagem'
                },
                {
                    data: 'nome'
                },
                {
                    data: 'email'
                },
                {
                    data: 'ativo'
                },
            ],
            "deferRender": true, // https://datatables.net/reference/option/deferRender
            "processing": true, // https://datatables.net/manual/server-side
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>'
            },
            "responsive": true, // https://datatables.net/reference/option/responsive
            "pagingType": $(window).width() < 768 ? 'simple' : "simple_numbers", // https://datatables.net/reference/option/pagingType // "full_numbers", "simple", "simple_numbers"

        });

    });
</script>
<?= $this->endSection() ?>
<!-- DataTables warning: table id=ajaxTable - Requested unknown parameter 'Imagem' for row 0, column 0. For more information about this error, please see https://datatables.net/tn/4 -->