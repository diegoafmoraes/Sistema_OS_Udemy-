<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usuarios extends BaseController
{

    private $usuarioModel;

    public function __construct() 
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        // Regras de negocio        
        $data = [
            "titulo" => lang("App.Users.UsersTitle"),
        ];

        return view('Usuarios/index', $data);
    }

    public function recuperaUsuarios() {

        if(!$this->request->isAJAX()) {
            redirect()->back();
        };

        $atributos = [
            'id',
            'nome',
            'email',
            'ativo',
            'imagem',
        ];

        $usuarios = $this->usuarioModel->select($atributos)
                                       ->findAll();
        // Recebera o array de objetos de usuarios 
        $data = [];

        foreach($usuarios as $usuario) {

            $data[] = [
                'imagem' => $usuario->imagem,
                'nome'   => anchor("usuarios/exibir/$usuario->id", esc($usuario->nome), 'title="Exibir usuário '.$usuario->nome.' "'),
                'email'  => esc($usuario->email),
                'ativo'  => ($usuario->ativo == true ? '<i class="fa fa-unlock text-warning"></i>&nbsp;Inativo' : '<i class="fa fa-lock text-success"></i>&nbsp;Ativo'),
            ];
        }

        /* echo "<pre>";
        print_r($data);
        exit; */

        $retorno = [
            'data' => $data,
        ];

        // Debug
        /* echo "<pre>";
        print_r($retorno);
        exit;  */
        return $this->response->setJSON($retorno);

    }


    public function exibir(int $id = null) {

        $usuario = $this->buscaUsuarioOu404($id);

        $data = [
            'titulo' => "Detalhando o usuário " . esc($usuario->nome),
            'usuario' => $usuario,
        ];

        return view('Usuarios/exibir', $data);

    }

    public function editar(int $id = null) 
    {

        $usuario = $this->buscaUsuarioOu404($id);

        $data = [
            'titulo' => "Editando o usuário " . esc($usuario->nome),
            'usuario' => $usuario,
        ];

        return view('Usuarios/editar', $data);

    }

    public function atualizar(int $id = null) 
    {

        if(!$this->request->isAJAX()) {
            return redirect()->back();
        };

        // Enviar/Renovar o hash do token do Form
        $retorno['token'] = csrf_hash();
        
        // Recupera o post da requisição
        $post = $this->request->getPost();

        // esse é um bypass temporario
        unset($post['password']);
        unset($post['password_confirmation']);

        // Validamos a existencia do usuario
        $usuario = $this->buscaUsuarioOu404($post['id']);

        // Preenche os atributos do usuario com os valores do 'post'
        $usuario->fill($post);

        // echo "<pre>"; print_r($usuario); exit;

        if(!$usuario->hasChanged() ) {

            $retorno['info'] = 'Não há dados para serem atualizados';
            // Retorno para o AJAX request
            return $this->response->setJSON($retorno);
            
        }

        if($this->usuarioModel->save($usuario)) {

            // VAMOS CONHECER MENSAGENS DE FLASH DATA

            return $this->response->setJSON($retorno);
            
        }

        // Retoprnamos os erros de validação
        $retorno['erro'] = 'Por favor, verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->usuarioModel->errors();

        return $this->response->setJSON($retorno);

    }

    /**
     * Método que recupera o usuario
     *
     * @param integer|null $id
     * @return object
     */
    private function buscaUsuarioOu404(int $id = null): object{

        if(!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário {$id}.");
        }
        
        return $usuario;

    }
}