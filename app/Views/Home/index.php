<?=$this->extend('Layout/principal') ?>

<?=$this->section('titulo') ?>
<?= $titulo; ?>
<?=$this->endSection() ?>

<?=$this->section('estilos') ?>
<!-- Aqui vao os estilos das views -->
<?=$this->endSection() ?>

<?=$this->section('conteudo') ?>
<!-- Aqui vao os conteudos das views -->
<h1><?= lang('App.Home.HomeTitle') ?></h1>
<?=$this->endSection() ?>

<?=$this->section('scripts') ?>
<!-- Aqui vao os scripts das views -->
<?=$this->endSection() ?>