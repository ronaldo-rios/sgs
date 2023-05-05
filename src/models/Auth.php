<?php 

declare(strict_types=1);

namespace src\models;

use src\dao\UsuarioDaoMySql;

class Auth
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // se o token da sessão pertence a algum usuário, retorna o usuário logado.
    // Senão, volta para o a página de login login:
    public static function checkToken()
    {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            // cria nova instância e usa o método findByToken para procurar o usuário pelo token:
            $usuarioDao = new UsuarioDaoMySql(self::$pdo);
            $usuario = $usuarioDao->findByToken($token);
            if($usuario){
                return $usuario;
            }
        }
        header('Location: public/login.php');
        exit;
    }
        
    public function validateLogin($email, $senha)
    {
        $usuarioDao = new UsuarioDaoMysql($this->pdo);
        // verifica se existe usuário com o e-mail:
        $usuario = $usuarioDao->findByEmail($email);

        if($usuario){
            // verifica se a senha está correta:
            if(password_verify($senha, $usuario->getSenha())){
                // gera um token e salva no banco de dados e na sessão:
                // $token = md5(time().rand(0, 9999));
                $token = bin2hex(random_bytes(16));
                $_SESSION['token'] = $token;
                $usuario->setToken($token);
                $usuarioDao->atualizarUsuario($usuario);
            }
        }
        return false;
    }

}