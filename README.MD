<div style="display: inline_block"><br> 
    
<h2>Tecnologias usadas:</h2>

<img align="center" height="50" width="60" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original-wordmark.svg" />
<img align="center" height="50" width="60" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" />           
<img align="center" height="50" width="60" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original-wordmark.svg" />
<img align="center" height="50" width="60" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/composer/composer-original.svg" />           
<img align="center" height="50" width="60" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-plain-wordmark.svg" />
<img align="center" height="50" width="60" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-plain-wordmark.svg" />
          
</div><br>



DESIGN PATTERN UTILIZADO: DAO (DATA ACCESS OBJECT)
VERSÃO DO PHP UTILIZADA: 8.2.0
VERSÃO DO MYSQL: 8

Dar o comando composer install para baixar as dependências do projeto

Criar um arquivo .env baseando-se pelo exemplo das informações do arquivo .env.example de acordo com nome do seu banco, porta do SGBD, nome do user e senha do mesmo.

DB_NAME=database_name
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=database_password
PORT=3306
BASE_URL=http://localhost/sgs

Criar um banco no MySQL que seja de mesmo nome do DB_NAME setado no .env (essas informações do .env não são fornecidas pelo fato de proteção de segurança dos dados do banco em caso de estar em produção
e também pelo fato que as variáveis de ambiente podem mudar de usuário para usuário)

