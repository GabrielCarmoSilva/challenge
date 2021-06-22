# Desafio Backend

Este projeto consiste em uma API em Laravel para criação de usuários, contas e transações da idez. 

Todo o processo começa com a criação de um Usuário. Um usuário pode ter mais de um tipo de conta vinculada a ele. 
De um **Usuário (User)**, deve ser digitado seu `Nome Completo`, `CPF`, `Número de Telefone`, `e-mail` e `Senha`. 

Os tipos de conta que existem na idez são **Empresarial (Company)** e **Pessoal (Person)**. Todas as contas sempre estarão vinculadas a um usuário e possuem alguns dados em comum: `Id da Conta`, `Agência`, `Número` e `Dígito`. 
De uma conta empresarial queremos saber a `Razão Social`, o `Nome Fantasia`, o `CNPJ`, além do `id de Usuário` que será dono dessa conta. 
De uma conta pessoal, queremos saber apenas seu `Nome` e `CPF`, além do `id de Usuário` que será dono dessa conta. 

Cada transação deverá ter um valor, positivo ou negativo, além de um dos cinco `Tipos` de operação que fazemos: 
- Pagamento de Conta
- Depósito
- Transferência
- Recarga de Celular
- Compra (Crédito)

## Instruções
A tecnologia usada no projeto foi a **mysql**, então o `docker-compose.yml` possui um serviço configurado para tal. Para rodar na sua máquina, basta substituir `{yourpassword}` por sua senha de root do seu banco de dados no arquivo.

Copie o arquivo `.env.example` e salve como `.env`.

Rode os comandos `docker-compose up --build`, `docker-compose up -d`, `docker-compose run web composer install` e `docker-compose run web php artisan key:generate` para iniciar o projeto.

## Rotas
Para testar a API, usei o cliente REST Insomnia. É importante que as rotas **POST** e **PATCH** tenham como corpo da requisição **Form URL Encoded** e como cabeçalho **accept: application/json**, devido à validação da request do Laravel. As rotas da aplicação são:

### Usuários
`/usuarios`, como rota GET, para listar todos os usuários cadastrados. É possível filtrar por nome ou documento, como por exemplo: `/usuarios?q=Joao`

`/usuarios`, como rota POST, para cadastrar um usuário. As informações como `name`, `cpf`, `password`, `email`, `phone` devem ser providas no corpo da requisição.

`/usuarios/{id}`, como rota PATCH, para editar um usuário. O id dele deve ser informado na rota.

`/usuarios/{id}`, como rota DELETE, para deletar um usuário.

`/usuarios/{id}`, como rota GET, para mostrar todas as informaçṍes de um determinado usuário.

A API não permite que dois usuários com o mesmo cpf e email sejam cadastrados.

### Contas
`/contas`, como rota GET, para listar todos os usuários cadastrados.

`/contas/pessoal`, como rota POST, para cadastrar uma conta pessoal. As informações como `name`, `cpf` e `user_id` devem ser providas na requisição.

`/contas/empresarial`, como rota POST, para cadastrar uma conta empresarial. As informações como `social_reason`, `fantasy_name`, `cnpj` e `user_id` devem ser providas na requisição.

`/contas/pessoal/{id}`, como rota PATCH, para editar uma conta pessoal. Caso seja informado o id de uma conta empresarial, aparecerá uma mensagem de erro. Mesma coisa para o inverso.

`/contas/empresarial/{id}`, como rota PATCH, para editar uma conta empresarial.

`/contas/{id}`, como rota GET, para visualizar todas as informações de uma conta.

`/contas/{id}`, como rota DELETE, para deletar uma conta.

A API não permite que um usuário tenha mais de uma conta de cada tipo.

### Transações

`/transacoes`, como rota GET, para listar todas as transações do sistema.

`/transacoes`, como rota POST, para fazer uma transação. As informações como `type`, `value` e `account_id` devem ser providas na requisição. Se o tipo informado for diferente dos tipos já citados acima, o sistema retornará uma mensagem de erro. Além disso, os tipos *Pagamento de Conta*, *Recarga de Celular* e *Compra (Crédito)*, o sistema sempre entenderá o valor como negativo, e descontará esse valor do saldo da conta correspondente. Os outros tipos de transação, ele descontará ou somará de acordo com o sinal do valor.

### Testes

Para testar o banco de dados, criei factories e seeders. Rode o comando `docker-compose run web php artisan migrate:fresh --seed` para migrar o banco de dados com os dados auto-generados.
