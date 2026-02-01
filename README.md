# Venda Truck Finance API

API de backend para o sistema **Venda Truck Finance**, desenvolvida em Laravel. O sistema gerencia empresas, simulações de financiamento, clientes e usuários.

## 🚀 Tecnologias

- **Framework:** Laravel 11.x
- **Autenticação:** Laravel Sanctum
- **Banco de Dados:** MySQL / PostgreSQL
- **Ferramenta de API:** Postman / Insomnia

## 📋 Módulos Principais

### 🏢 Empresas (Companies)
Gerenciamento de lojas e parceiros. Filtro de dados automático por `company_id`.

### 📊 Simulações (Simulations)
Módulo central para cálculos de financiamento e refinanciamento.
- Armazena dados do veículo (placa, marca, valor).
- Snapshots de parcelas (P24, P48, P60).
- Vínculo com clientes e usuários.

### 👤 Clientes (Customers)
Cadastro completo de proponentes.
- Vínculo automático à simulação via `simulation_id`.
- Dados demográficos e financeiros.

### 🔐 Autenticação (Auth)
- Login multiplataforma (Admin / Lojista).
- Redefinição de senha via email.
- Verificação de validade de token (`/verify-token`).

## 🛠️ Configuração do Projeto

1. Clone o repositório
2. Instale as dependências:
   ```bash
   composer install
   npm install
   ```
3. Configure o `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Execute as migrations e seeders:
   ```bash
   php artisan migrate --seed
   ```
5. Inicie o servidor:
   ```bash
   php artisan serve
   ```

## 📡 API Endpoints (v1)

### Auth
- `POST /login` - Autenticação
- `GET /verify-token` - Validação de JWT
- `POST /register` - Cadastro de usuários (Admin apenas)
- `POST /logout` - Revogação de token

### Admin / Painel
- `apiResource('companies', CompanyController)`
- `apiResource('simulations', SimulationController)`
- `apiResource('customers', CustomerController)`
- `GET /simulation-statuses`

## 📂 Estrutura de Banco de Dados

- `users`: Usuários do sistema (admin, lojista).
- `companies`: Empresas registradas.
- `simulations`: Tabela principal de cálculos e propostas.
- `customers`: Dados dos clientes.
- `simulation_types`: Tipos (Financiamento, Refinanciamento).
- `simulation_statuses`: Status (Simulado, Aprovado, Em Análise, etc).

## 📄 Coleção Postman
O arquivo `venda-truck-companies.postman_collection.json` na raiz do projeto contém todas as requisições prontas para uso.
