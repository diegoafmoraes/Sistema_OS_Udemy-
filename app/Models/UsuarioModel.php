<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    // protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\Usuario';
    protected $useSoftDeletes   = true;
    // protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'password',
        'reset_hash',
        'reset_expira_em',
        'imagem',
        // campo 'ativo' nao vai - form manipula
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    // Validation
    protected $validationRules    = [
        'id'                    => 'permit_empty|is_natural_no_zero', // <-- ESSA LINHA DEVE SER ADICIONADA
        // as existentes
        'nome'                  => 'required|min_length[3]|max_length[125]',
        'email'                 => 'required|valid_email|max_length[230]|is_unique[usuarios.email,id,{id}]', // Não pode ter espaços
        'password'              => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]'
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O campo nome precisa ter pelo menos 3 caracteres',
            'max_length' => 'O campo nome deve ter no máximo 125 caracteres',
        ],
        'email' => [
            'required' => 'O campo E-mail é obrigatório.',
            'max_length' => 'O campo E-mail deve ter no máximo 230 caracteres',
            'is_unique' => 'Esse e-mail já foi incluído. Por favor, escolha outro.',
        ],
        'password_confirmation' => [
            'required_with' => 'Por favor, confirme a sua senha.',
            'matches' => 'Senha e Confirmação de Senha precisam sr iguais.',
        ],
    ];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];
    // protected $afterInsert    = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }


        return $data;
    }
    
}
