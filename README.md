# BookHub: Sistema de Reservas de Biblioteca

O BookHub é um sistema de reserva de biblioteca que gerencia usuários, bibliotecários, livros e reservas. Abaixo estão as entidades principais e seus atributos.

## Tecnologias Utilizadas

<html>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
        <div>
            <h3>Framework</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/Laravel-10-orange?style=flat-square&logo=laravel&logoColor=white" alt="Laravel">
            </p>
        </div>
        <div>
            <h3>Banco de Dados</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/PostgreSQL-15-blue?style=flat-square&logo=postgresql&logoColor=white" alt="PostgreSQL">
            </p>
        </div>
        <div>
            <h3>Cache</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/Redis-Alpine-red?style=flat-square&logo=redis&logoColor=white" alt="Redis">
            </p>
        </div>
        <div>
            <h3>Serviço de Teste de Email</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/Mailtrap-00cc99?style=flat-square&logo=mailtrap&logoColor=white" alt="Mailtrap">
            </p>
        </div>
        <div>
            <h3>Ambiente de Desenvolvimento</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/Docker-2496ED?style=flat-square&logo=docker&logoColor=white" alt="Docker">
                <img src="https://img.shields.io/badge/Sail-black?style=flat-square&logo=laravel&logoColor=white" alt="Sail">
            </p>
        </div>
        <div>
            <h3>Gerenciador de Pacotes</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/Composer-885630?style=flat-square&logo=composer&logoColor=white" alt="Composer">
            </p>
        </div>
        <div>
            <h3>Ferramentas de Implantação</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/Passport-6DB33F?style=flat-square&logo=laravel&logoColor=white" alt="Passport">
            </p>
        </div>
                <h3>Swoole</h3>
        <p align="center">
            <img src="https://img.shields.io/badge/Swoole-8.5.1-blue?style=flat-square&logo=swoole&logoColor=white" alt="Swoole">
        </p>
    </div>
    <div>
        <h3>Laravel Horizon</h3>
        <p align="center">
            <img src="https://img.shields.io/badge/Laravel%20Horizon-4.5.0-ff69b4?style=flat-square&logo=laravel&logoColor=white" alt="Laravel Horizon">
        </p>
    </div>
        <div>
            <h3>Outros</h3>
            <p align="center">
                <img src="https://img.shields.io/badge/PHPUnit-555?style=flat-square&logo=phpunit&logoColor=white" alt="PHPUnit">
                <img src="https://img.shields.io/badge/Git-F05032?style=flat-square&logo=git&logoColor=white" alt="Git">
                <img src="https://img.shields.io/badge/PHPDoc-8892BF?style=flat-square&logo=php&logoColor=white" alt="PHPDoc">
                <img src="https://img.shields.io/badge/Insomnia-5849BE?style=flat-square&logo=insomnia&logoColor=white" alt="Insomnia">
                <img src="https://img.shields.io/badge/GitHub%20Actions-2088FF?style=flat-square&logo=githubactions&logoColor=white" alt="GitHub Actions">
            </p>
        </div>
    </div>
</html>

## Primeiros passos:

### Inicialização:

```
./vendor/bin/sail up
```

-   Após isso, execute:

```
composer install
```

-   Você pode instalar as dependências localmente ou utilizar o Docker com o seguinte comando:

```
docker run --rm --interactive --tty \
 --volume $PWD:/app \
 composer install --ignore-platforms-req
```

-   Depois, ative o Passport:

```
./vendor/bin/sail artisan passport:install --force
```

O uso do Passport é fundamental para a autenticação OAuth2 no BookHub. OAuth2 é um protocolo de autorização amplamente utilizado para permitir que aplicativos obtenham acesso a recursos em nome de usuários. Com o Passport, o BookHub pode garantir uma autenticação segura, permitindo que usuários se cadastrem e acessem o sistema de forma protegida.

## Usando Mailtrap:

Você pode verificar o envio de e-mail ao registrar um usuário com:

```
./vendor/bin/sail artisan queue:work
```

E acesse: http://localhost:8025

Particularmente, prefiro usar o Mailtrap. Para isso, acesse Mailtrap, faça login, vá em 'Email Testing', crie uma nova Inbox, acesse-a e em integrações, selecione 'PHP 9+'. Em seguida, adapte as credenciais no seu arquivo .env.

## Gerenciamento de Jobs:

Para otimizar e gerenciar a execução de jobs na aplicação, adotei o Laravel Horizon. Essa ferramenta proporciona:

<html>
    <div
        style="
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        "
    >
        <h2>Laravel Horizon</h2>
        <div style="padding: 16px; text-align: center">
            <img
                src="img-doc/LaravelHorizon.png"
                alt="LaravelHorizon"
                style="max-width: 88%; border-radius: 8px"
            />
        </div>
    </div>
</html>

-   `Visualização Intuitiva`: Tenha uma visão clara e intuitiva do desempenho de suas filas de jobs por meio do painel de controle do Horizon.

-   `Monitoramento em Tempo Real`: Acompanhe em tempo real a execução de jobs, identificando gargalos e otimizando o desempenho do seu sistema.

-   `Gerenciamento Eficiente`: Controle o comportamento das filas, suspenda e retome a execução de jobs, e ajuste configurações conforme necessário.

O Laravel Horizon proporciona uma solução robusta para monitorar e otimizar o processamento de jobs, garantindo a eficiência e confiabilidade de sua aplicação Laravel. Para executar use:

```
./vendor/bin/sail artisan horizon
```

Para executar

## Swoole Integration

O Laravel inclui suporte para o Swoole, uma extensão PHP de alto desempenho que melhora a eficiência da aplicação, reduzindo a ociosidade de processos e aumentando a capacidade multitarefas. Isso pode levar a melhorias significativas no desempenho da aplicação.

Para iniciar o servidor Swoole, utilize o seguinte comando no terminal, estando no diretório do seu projeto Laravel:

```
./vendor/bin/sail artisan swoole:http
```

## Filtros

-   Para acessar os livros sem filtros, utilize a URL:

    http://localhost/api/books

-   Para paginação, adicione o parâmetro de consulta, como:

    http://localhost/api/books?page=1

-   Para filtrar, você pode usar:

    `Por título`:
    http://localhost/api/books?title=%Seu%Titulo

    `Por autor`:
    http://localhost/api/books?author=%Seu%Autor

    `Por ISBN`:
    http://localhost/api/books?isbn=97812345%

    `Por livros disponíveis`:
    http://localhost/api/books?availability=1

-   Você também pode combiná-los com '&'

-   Todas as rotas index retornam uma paginação se você adicionar o parâmetro de consulta ?page=`numero-da-pagina`

## Testes:

Para rodar os testes, use:

```
./vendor/bin/sail artisan test
```

Os testes que realizei foram em relação aos controllers, mas é possível aumentar ainda mais a cobertura de testes com o 'coverage'. Ele mostra sobre testes em outras partes como e-mail, consumo de microserviços, listeners, events, notifications, para conferir a cobertura mais abragente use:

```
./vendor/bin/sail artisan test --coverage
```

## (Notificações)

<html>
    <div
        style="
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        "
    >
        <h2>
            Notificações aos usuários com 'role_id' === 2 (Bibliotecários):
            Criação de Reserva
        </h2>
        <div style="padding: 16px; text-align: center">
            <img
                src="img-doc/CreateReservationNotify.png"
                alt="CreateReservationNotify"
                style="max-width: 88%; border-radius: 8px"
            />
        </div>
        <h2>
            Notificações aos usuários com 'role_id' === 2 (Bibliotecários):
            Atualização de Reserva
        </h2>
        <div style="padding: 16px; text-align: center">
            <img
                src="img-doc/UpdateReservationNotify.png"
                alt="UpdateReservationNotify"
                style="max-width: 88%; border-radius: 8px"
            />
        </div>
        <h2>
            Notificações aos usuários com 'role_id' === 2 (Bibliotecários):
            Deleção de Reserva
        </h2>
        <div style="padding: 16px; text-align: center">
            <img
                src="img-doc/DeletedResernationNotify.png"
                alt="DeletedResernationNotify"
                style="max-width: 88%; border-radius: 8px"
            />
        </div>
        <h2>Diagrama do Banco</h2>
        <div style="padding: 16px; text-align: center">
            <img
                src="img-doc/DBDiagram.png"
                alt="DBDiagram"
                style="max-width: 88%; border-radius: 8px"
            />
        </div>
        <h2>Registro de Usuário</h2>
        <div style="padding: 16px; text-align: center">
            <img
                src="img-doc/RegistredMail.png"
                alt="RegistredMail"
                style="max-width: 88%; border-radius: 8px"
            />
        </div>
    </div>
</html>

## Usuários e Bibliotecários (Users):

### Atributos:

-   id: Chave primária, autoincrementada.
-   name: Nome completo do usuário.
-   email: Endereço de e-mail único para login.
-   password: Senha criptografada.
-   role_id: Chave estrangeira para Roles, determinando o tipo de usuário - 'Usuário' ou 'Bibliotecário'.

## Funções (Roles):

### Atributos:

-   id: Chave primária, autoincrementada.
-   name: Nome da função, por exemplo, 'Usuário' ou 'Bibliotecário'.

## Permissões (Permissions):

### Atributos:

-   id: Chave primária, autoincrementada.
-   name: Nome da permissão, por exemplo, 'Pode Reservar', 'Pode Cancelar Reserva'.

## Livros (Books):

### Atributos:

-   id: Chave primária, autoincrementada.
-   title: Título do livro.
-   author: Nome do autor.
-   category: Gênero ou categoria do livro.
-   availability: Booleano indicando se o livro está disponível no momento.

## Reservas (Reservations):

### Atributos:

-   id: Chave primária, autoincrementada.
-   user_id: Chave estrangeira para Users.
-   book_id: Chave estrangeira para Books.
-   reservation_date: Data em que a reserva foi feita.
-   pickup_deadline: Data até a qual o livro deve ser retirado.
-   is_active: Booleano indicando se a reserva está ativa ou não.
