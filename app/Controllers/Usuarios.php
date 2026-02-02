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

        $usuario = $this->buscaUsuaroOu404($id);

        $data = [
            'titulo' => "Detalhando o usuário " . esc($usuario->nome),
            'usuario' => $usuario,
        ];

        return view('Usuarios/exibir', $data);

    }

    public function editar(int $id = null) 
    {

        $usuario = $this->buscaUsuaroOu404($id);

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

        $retorno['token'] = csrf_hash();

        $retorno['erro'] = "Mensagem de Erro de Validação";
        $retorno['erros_model'] = [
            'nome' => 'O nome é obrigatório',
            'email' => 'Email inválido',
            'password' => 'A senha é muito curta',
        ];

        return $this->response->setJSON($retorno);


        $post = $this->request->getPost();

        echo '<pre>';
        print_r($post);
        exit;

    }

    /**
     * Método que recupera o usuario
     *
     * @param integer|null $id
     * @return object
     */
    private function buscaUsuaroOu404(int $id = null): object{

        if(!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário {$id}.");
        }
        
        return $usuario;


    }
}