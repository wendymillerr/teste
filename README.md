 Blog Laravel Interativo

## Descrição

Um blog simples em Laravel que consome dados da API DummyJSON, permitindo visualização de posts, comentários sem necessidade de login.

## Tecnologias Utilizadas

- Laravel 10.x
- PHP 8.1+
- MySQL (ou outro banco suportado pelo Laravel)
- TailwindCSS

## Instalação

### Pré-requisitos

- PHP 8.1+
- Composer
- MySQL ou outro banco de dados
- Node.js e npm 

### Passos

```bash
# 1. Clone o repositório:
git clone https://github.com/wendymillerr/teste

# 2. Instale as dependências PHP:
composer install

# 3.crie um arquivo .env na raiz, depois
copie os dados do arquivo .env.exemple para ".env"

# 4. crie seu banco de dados e configure-o no .env:

# Exemplo:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=nome_do_banco
# DB_USERNAME=usuario
# DB_PASSWORD=


# 6. Execute as migrations:
php artisan migrate

# 7. rode o comando:
php artisan sync:dummyjson

# 8. Rode o servidor:
php artisan serve

# 9.Inicie o servidor Vite:
npm install
npm run dev 


Link do vídeo 
https://www.canva.com/design/DAG6hc3pjE8/TrpOuFZjxQK5xvas6K9M_Q/edit?utm_content=DAG6hc3pjE8&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton

