# MHFOOD

Bem-vindo ao projeto MHFOOD! Aqui você encontrará todas as informações necessárias para entender e executar este projeto.

## Descrição

O MHFOOD é uma plataforma de delivery que permite aos clientes realizar pedidos de produtos disponíveis no sistema.

## Endpoints

### Clientes

**GET /api/clients**

Endpoint responsável por retornar todos os clientes cadastrados no sistema.

### Pedidos

**GET /api/orders**

Endpoint para obter todos os pedidos registrados no sistema.

### Produtos

**GET /api/products**

Este endpoint retorna todos os produtos disponíveis no sistema.

## Especificações dos Campos

### Clientes

- **name**: obrigatório, máximo de 255 caracteres.
- **email**: não obrigatório, deve seguir o formato de e-mail.
- **phone**: não obrigatório.
- **address**: não obrigatório.

### Produtos

- **name**: nome do produto.
- **description**: descrição do produto, incluindo os ingredientes.
- **price**: preço do produto, obrigatório.
- **stock**: quantidade disponível em estoque (opcional).

### Relacionamentos

- **client_id**: identificador do cliente associado ao pedido.
- **product_id**: identificador do produto associado ao pedido.
- **order_number**: número do pedido.
- **quantity**: quantidade do produto no pedido.
- **total_price**: preço total do pedido.
- **status**: status do pedido.

## Executando o Projeto

Para executar este projeto em Laravel, siga as instruções abaixo:

1. Clone o repositório para sua máquina local.
2. Certifique-se de ter o ambiente Laravel configurado corretamente.
3. Configure o arquivo `.env` com suas credenciais de banco de dados.
4. Execute `composer install` para instalar as dependências do Laravel.
5. Execute `php artisan migrate` para criar as tabelas no banco de dados.
6. Inicie o servidor com `php artisan serve`.
7. Acesse o projeto em seu navegador utilizando o endereço local fornecido pelo Laravel.

Agora você está pronto para começar a utilizar o MHFOOD! Divirta-se explorando as funcionalidades deste sistema de delivery.

Deploys:

**https://delivery.uners.com.br/api/clients**

**https://delivery.uners.com.br/api/orders**

**https://delivery.uners.com.br/api/products**
