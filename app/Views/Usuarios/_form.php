<div class="form-group">
    <label class="form-control-label">Nome completo</label>
    <input type="text" name="nome" placeholder="Insira o nome" class="form-control" value="<?php echo $usuario->nome ?>">
</div>

<div class="form-group">
    <label class="form-control-label">E-mail</label>
    <input type="email" name="email" placeholder="Insira o e-mail" class="form-control" value="<?php echo $usuario->email ?>">
</div>

<div class="form-group">
    <label class="form-control-label">Senha</label>
    <input type="password" name="password" placeholder="Senha de acesso" class="form-control">
</div>

<div class="form-group">
    <label class="form-control-label">Confirmação de Senha</label>
    <input type="password" name="password_confirmation" placeholder="Confirme a Senha de acesso" class="form-control">
</div>

<div class="custon-conrol custom-checkbox">
    <input type="hidden" name="ativo" value="0">

    <input type="checkbox" name="ativo" value="1" class="custon-control-input" id="ativo" <?php if($usuario->ativo == 1): ?> checked <?php endif; ?> >
    
    <label class="custon-control-label ml-2" for="ativo">Usuário Ativo</label>
</div>