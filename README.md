# 📌 FinPlan – Seu Planejador Financeiro Simples e Inteligente

## 🎯 Objetivo
Criar uma aplicação web responsiva que ajude os usuários a organizarem suas finanças de forma prática, oferecendo controle de gastos, planejamento financeiro, alertas e recomendações personalizadas.

🔥 Algumas das Funcionalidades que a FinPlan irá Possuir...

1️⃣ Cadastro de Usuário
Registro via e-mail e senha.
Definição do perfil financeiro (Básico, Moderado ou Arrojado).

2️⃣ Planejamento Financeiro
Criação de Metas (ex: viagem, reserva de emergência).
Barra de progresso para acompanhar evolução.
Sugestões para alcançar metas rapidamente.

3️⃣ Análise de Gastos
Gráficos interativos com categorias de despesas.
Comparação entre meses anteriores.
Alertas para gastos excessivos.

4️⃣ Notificações e Alertas
Notificações no painel e envio de e-mails.
Lembretes de vencimento de contas e metas financeiras.

5️⃣ Sugestões de Investimentos
Recomendação de investimentos baseada no perfil.

## 🛠 Tecnologias Utilizadas
- **Back-end:** PHP + Laravel Blade
- **Front-end:** Tailwind CSS
- **Banco de Dados:** MySQL
- **Notificações Internas:** Laravel Notifications
- **Envio de E-mails:** Laravel Mail
- **Agendamento de Tarefas:** Laravel Jobs

## 📩 Para o Envio de E-mails
Para evitar custos extras, o serviço que optamos por utilizar foi:
Brevo - É a que esta sendo usada no momento no projeto, mas pode haver troca se houver necessidade.

## 🚀 Conclusão
A FinPlan se diferencia por trazer não apenas um controle financeiro tradicional, mas um **Planejador Inteligente** que aprende com os hábitos do usuário e sugere formas de economizar de maneira dinâmica. Com um metas animadoras e projeções financeiras, ela torna o gerenciamento de dinheiro mais envolvente e eficaz.

---

## 📅 Plano de Desenvolvimento (3 meses)
### 🔥 Mês 1: Estruturação e Back-End
✅ Semana 1:
- [X] Configurar ambiente de desenvolvimento (Laravel, MySQL, Tailwind).
- [X] Criar modelo de banco de dados (tabelas: usuários, despesas, metas, notificações).
- [X] Implementar autenticação de usuários (cadastro e login).

✅ Semana 2:
- [X] Criar sistema de cadastro completo (renda, despesas, perfil).
- [X] Implementar criação e gestão de metas financeiras.
- [X] Criar lógica para cálculos de progresso das metas.

✅ Semana 3:
- [X] Criar sistema de despesas e análise básica de gastos.
- [X] Implementar gráficos interativos com base nos dados financeiros.

✅ Semana 4:
- [X] Criar sistema de notificações internas no painel.
- [X] Implementar envio de e-mails de alerta (obtei por utilizar o brevo, pois o projeto inicialmente não ira precisar de uma quantidade de email muito grande).
- [X] Implementar jobs e queues para envio de emails constante e a longo prazo.

OBS BONUS: Foi implementado um bot inteligente com o easy peasy ai, onde foi preciso configura-lo e alimenta-lo para ele conseguir da dicas financeiras mais dinamicas.

✅ Semana 5:
- [X] Recomendação de investimentos baseada no perfil.
- [X] Implementar possibilidade do usuario gerar PDFs de gastos para ter melhor visao, ele podera selecionar o periodo que deseja gerar.

### 🚀 Mês 2: Front-End e Experiência do Usuário
✅ Semana 6:
- [X] Criar páginas principais (dashboard, metas, despesas, investimentos).
- [X] Criar UI responsiva com Tailwind CSS.

✅ Semana 7:
- [X] Implementar gráficos interativos (Chart.js ou Laravel Charts).
- [X] Melhorar experiência do usuário nas interações.

✅ Semana 8:
- [X] Criar página de notificações e alertas.
- [Cancelado] Implementar cálculos e projeções de gastos futuros.

### 🎯 Mês 3: Testes, Ajustes e Lançamento
✅ Semana 9:
- [X] Revisão geral do código e otimizações.
- [x] Testes de usabilidade e ajustes de UI/UX.

✅ Semana 10:
- [x] Implementação final do Planejador Inteligente(FinBot).
- [X] Melhorias no sistema de sugestões de investimentos.

✅ Semana 11:
- [X] Testes beta com usuários reais(foi realizado testes localmente).
- [ ] Correção de bugs e refinamentos finais.

✅ Semana 12:
- [Cancelado] **Lançamento oficial da versão MVP! 🚀**

