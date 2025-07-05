# 💰 FinPlan – Planejador Financeiro Simples e Inteligente

## 🎯 Visão Geral

**FinPlan** é uma aplicação web responsiva desenvolvida para ajudar usuários a **organizar suas finanças pessoais** de forma simples, prática e inteligente. A plataforma permite o controle de gastos, planejamento financeiro, geração de alertas e **recomendações personalizadas** com base nos hábitos do usuário.

Além disso, a aplicação conta com o **FinBot**, um chatbot interativo que responde dúvidas financeiras em tempo real, tornando a experiência mais acessível mesmo para quem não possui conhecimentos aprofundados sobre finanças.

---

## 🌟 Funcionalidades Principais

* ✅ Controle de receitas e despesas
* ✅ Planejamento de metas financeiras
* ✅ Alertas personalizados por notificações internas e e-mail
* ✅ Sugestões inteligentes de economia baseadas no tipo de usuario
* ✅ **FinBot** – Chatbot de dúvidas financeiras
* ✅ Relatórios e projeções com visualização clara
* ✅ Interface 100% responsiva
* ✅ Visualização em gráficos dinamicos

---

## ⚙️ Tecnologias Utilizadas

| Camada         | Tecnologia                  |
| -------------- | --------------------------- |
| Back-end       | PHP com Laravel Blade       |
| Front-end      | Tailwind CSS + JavaScript   |
| Banco de Dados | MySQL                       |
| Notificações   | Laravel Notifications       |
| E-mails        | Laravel Mail (usando Brevo) |
| Agendamentos   | Laravel Jobs                |

---

## 📧 Envio de E-mails

O serviço utilizado atualmente é o **Brevo** (antigo Sendinblue), escolhido por ser gratuito e eficiente. Pode ser trocado futuramente conforme a necessidade do projeto.

---

## 🔧 Como Configurar o Projeto Localmente

### ✅ Pré-requisitos

Antes de começar, você precisa ter instalado:

* PHP >= 8.1
* Laravel >= 11
* Composer
* MySQL
* Node.js e NPM
* Git

---

### 🚀 Passo a Passo de Instalação

1. **Clone o repositório:**

```bash
git clone https://github.com/seu-usuario/finplan.git
cd finplan
```

2. **Instale as dependências do Laravel:**

```bash
composer install
```

3. **Copie o arquivo `.env.example` e configure:**

```bash
cp .env.example .env
```

> Altere as configurações do banco de dados e do serviço de e-mail no arquivo `.env`:

```env
DB_DATABASE=finplan_db
DB_USERNAME=root
DB_PASSWORD=sua_senha

MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=seu_usuario_brevo
MAIL_PASSWORD=sua_senha_brevo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu_email@dominio.com
MAIL_FROM_NAME="FinPlan"
```

4. **Gere a chave da aplicação:**

```bash
php artisan key:generate
```

5. **Crie as tabelas no banco de dados:**

```bash
php artisan migrate
```

6. **Instale dependências front-end e compile o CSS com Tailwind:**

```bash
npm install
npm run dev
```

7. **(Opcional) Popule o banco com dados com as sugestões de investimentos:**

```bash
php artisan db:seed
```

8. **Execute o servidor de desenvolvimento:**

```bash
php artisan serve
```

Acesse a aplicação em: [http://localhost:8000](http://localhost:8000)

---

### 🔔 E-mails e Notificações

Para que o envio de e-mails e as notificações internas funcionem corretamente, é necessário executar os seguintes comandos em terminais separados (ou configurar como serviços no servidor de produção):

```bash
php artisan queue:work
```

```bash
php artisan schedule:work
```

Esses comandos garantem que **tarefas agendadas** e **filas de envio** funcionem corretamente em tempo real.

---

## 🤖 Como usar o FinBot?

O FinBot pode ser acessado através de qualquer pagina da aplicação, representado por um icone posicionado no canto inferior direito. Basta digitar sua pergunta relacionada a finanças pessoais (ex: "Como economizar no cartão de crédito?") e o assistente responderá com dicas automatizadas baseadas em regras simples de educação financeira.

---

## 📌 Conclusão

A **FinPlan** vai além de um simples controle de gastos: ela é um **planejador financeiro inteligente** que aprende com você, evolui com seus hábitos e **te ajuda a economizar de verdade**. Com design intuitivo, foco na experiência do usuário e funcionalidades práticas, é uma ferramenta ideal para transformar o modo como você lida com seu dinheiro.

