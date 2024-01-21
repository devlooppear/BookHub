 # BookHub: Sistema de Reservas de Biblioteca

O BookHub é um sistema de reserva de biblioteca que gerencia usuários, bibliotecários, livros e reservas. Abaixo estão as entidades principais e seus atributos.

# Usuários e Bibliotecários (Users):

 ### Atributos:

    - id: Chave primária, autoincrementada.
    - name: Nome completo do usuário.
    - email: Endereço de e-mail único para login.
    - password: Senha criptografada.
    - role_id: Chave estrangeira para Roles, determinando o tipo de usuário - 'Usuário' ou 'Bibliotecário'.

# Funções (Roles):

 ### Atributos:

    - id: Chave primária, autoincrementada.
    - name: Nome da função, por exemplo, 'Usuário' ou 'Bibliotecário'.

# Permissões (Permissions):

 ### Atributos:

    - id: Chave primária, autoincrementada.
    - name: Nome da permissão, por exemplo, 'Pode Reservar', 'Pode Cancelar Reserva'.

# Livros (Books):

 ### Atributos:

    - id: Chave primária, autoincrementada.
    - title: Título do livro.
    - author: Nome do autor.
    - category: Gênero ou categoria do livro.
    - availability: Booleano indicando se o livro está disponível no momento.

# Reservas (Reservations):

 ### Atributos:

    - id: Chave primária, autoincrementada.
    - user_id: Chave estrangeira para Users.
    - book_id: Chave estrangeira para Books.
    - reservation_date: Data em que a reserva foi feita.
    - pickup_deadline: Data até a qual o livro deve ser retirado.
    - is_active: Booleano indicando se a reserva está ativa ou não.