# CRUD de Produtos — PHP + MySQL + Tailwind CSS

Sistema de cadastro de produtos com operações completas de Create, Read, Update e Delete.

## Tecnologias

- PHP 8+ com PDO
- MySQL
- HTML5 + Tailwind CSS (via CDN)
- XAMPP (ambiente local)

## Pré-requisitos

- [XAMPP](https://www.apachefriends.org/) instalado e rodando (Apache + MySQL)

## Como executar localmente

### 1. Clone o repositório dentro do htdocs

```bash
cd C:/xampp/htdocs
git clone https://github.com/SEU_USUARIO/crud-produtos.git
```

### 2. Crie o banco de dados

Acesse **http://localhost/phpmyadmin**, clique em **SQL** e execute:

```sql
CREATE DATABASE crud_produtos;

USE crud_produtos;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 3. Verifique as credenciais

Abra o arquivo `config.php` e confirme:

```php
$host   = 'localhost';
$dbname = 'crud_produtos';
$user   = 'root';
$pass   = ''; // padrão XAMPP
```

### 4. Acesse no navegador

```
http://localhost/crud-produtos/index.php
```

## Funcionalidades

- Listar todos os produtos cadastrados
- Cadastrar novo produto com validação de campos obrigatórios
- Editar produto existente
- Excluir produto com confirmação

## Estrutura de arquivos

```
crud-produtos/
├── config.php   → Conexão com o banco de dados
├── index.php    → Listagem de produtos
├── create.php   → Cadastro de produto
├── edit.php     → Edição de produto
└── delete.php   → Exclusão de produto
```