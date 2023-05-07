<?php 

declare(strict_types=1);

namespace src\models;

use src\dao\UsuarioDaoMySql;

class Auth
{
    private $pdo;
    private $usuarioDao;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->usuarioDao = new UsuarioDaoMySql($this->pdo);
    }

    // se o token da sessão pertence a algum usuário, retorna o usuário logado.
    // Senão, volta para o a página de login login:
    public static function checkToken()
    {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            // cria nova instância e usa o método findByToken para procurar o usuário pelo token:
            $usuario = self::$usuarioDao->findByToken($token);
            if($usuario){
                return $usuario;
            }
        }
        else {
            // Se não tiver token, volta para a página de login:
            header('Location:'.$_ENV['BASE_URL'].'/login.php');
            exit;
        }
    }
        
    public static function validateLogin($email, $senha)
    {
        // verifica se existe usuário com o e-mail:
        $usuario = self::$usuarioDao->findByEmail($email);

        if($usuario){
            // verifica se a senha está correta:
            if(password_verify($senha, $usuario->getSenha())){
                // gera um token e salva no banco de dados e na sessão:
                $token = bin2hex(random_bytes(16));
                $_SESSION['token'] = $token;
                $usuario->setToken($token);
                self::$usuarioDao->atualizarUsuario($usuario);
            }
        }
        return false;
    }

}