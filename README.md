# 📌 FinPlan – Seu Planejador Financeiro Simples e Inteligente

## 🎯 Objetivo
Criar uma aplicação web responsiva que ajude os usuários a organizarem suas finanças de forma prática, oferecendo controle de gastos, planejamento financeiro, alertas e recomendações personalizadas.

## 💡 Diferencial Inovador
A FinPlan se destaca no mercado com a funcionalidade exclusiva "Planejador Inteligente", que analisa automaticamente a renda e os gastos do usuário, sugerindo ajustes inteligentes:
- **Desafios Financeiros:** Pequenas missões para incentivar a economia, como "Economize R$50 esta semana evitando compras desnecessárias".
- **Projeção de Gastos Futuros:** Estimativa de gastos baseada nos padrões de consumo, oferecendo dicas personalizadas.
- **Sistema de Recompensas:** Usuários que atingirem metas financeiras recebem badges e dicas exclusivas de investimentos.

## 🔥 Funcionalidades Principais
### 1️⃣ Cadastro de Usuário
- Registro via e-mail e senha.
- Definição do perfil financeiro (Básico, Moderado ou Gastador).
- Cadastro completo: Renda mensal, despesas essenciais e não essenciais.

### 2️⃣ Planejamento Financeiro
- Criação de Metas: Exemplo: viagem, reserva de emergência, compra de um carro.
- Barra de progresso mostrando a evolução.
- Sugestões dinâmicas para alcançar metas mais rapidamente.

### 3️⃣ Análise de Gastos Inteligente
- Gráficos interativos mostrando onde o usuário mais gasta.
- Comparação de gastos entre meses anteriores.
- Sugestões personalizadas: "Você gastou 30% a mais com alimentação este mês".
- Alertas financeiros caso os gastos ultrapassem limites definidos.

### 4️⃣ Notificações e Alertas
- Sistema interno de notificações (barras no topo da tela ou banners visíveis).
- Envio de e-mails automáticos para avisos importantes.
- Alertas sobre vencimento de contas e faturas.
- Notificações sobre metas financeiras e hábitos de consumo.
- Integração opcional com calendários (Google Calendar, Outlook) para lembretes.

### 5️⃣ Sugestões de Investimentos Personalizadas
- Sugestão de investimentos com base no perfil do usuário.
- Integração com dados da Bolsa de Valores em tempo real.
- Exibição de opções de renda fixa e variável.
- Simulação de crescimento do patrimônio com base em aportes mensais.

## 🛠 Tecnologias Utilizadas
- **Back-end:** PHP + Laravel Blade
- **Front-end:** Tailwind CSS
- **Banco de Dados:** MySQL
- **Notificações Internas:** Laravel Notifications
- **Envio de E-mails:** Laravel Mail
- **Agendamento de Tarefas:** Laravel Jobs

## 📩 Para o Envio de E-mails
Para evitar custos extras, as opções recomendadas são:
1. Mailgun (plano gratuito inicial) – Simples de configurar no Laravel.
2. Postmark – Ótimo para e-mails transacionais.
3. Amazon SES (AWS) – Baixo custo e alta confiabilidade.
4. SMTP do Gmail – Pode ser usado com autenticação segura.
5. Brevo - É a que esta sendo usada no momento no projeto, mas pode haver troca se houver necessidade.

## 🚀 Conclusão
A FinPlan se diferencia por trazer não apenas um controle financeiro tradicional, mas um **Planejador Inteligente** que aprende com os hábitos do usuário e sugere formas de economizar de maneira dinâmica. Com um sistema de desafios, metas animadoras e projeções financeiras, ela torna o gerenciamento de dinheiro mais envolvente e eficaz.

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
- [ ] Implementar envio de e-mails de alerta (obtei por utilizar o brevo, pois o projeto inicialmente não ira precisar de uma quantidade de email muito grande).
- [ ] Implementar jobs e queues para envio de emails constante e a longo prazo.

OBS BONUS: Foi implementado um bot inteligente com o easy peasy ai, onde foi preciso configura-lo e alimenta-lo para ele conseguir da dicas financeiras mais dinamicas.

### 🚀 Mês 2: Front-End e Experiência do Usuário
✅ Semana 5:
- [ ] Criar páginas principais (dashboard, metas, despesas, investimentos).
- [ ] Criar UI responsiva com Tailwind CSS.

✅ Semana 6:
- [ ] Implementar gráficos interativos (Chart.js ou Laravel Charts).
- [ ] Melhorar experiência do usuário nas interações.

✅ Semana 7:
- [ ] Criar página de notificações e alertas.
- [ ] Implementar cálculos e projeções de gastos futuros.

✅ Semana 8:
- [ ] Criar sistema de desafios financeiros personalizados.
- [ ] Refinar e testar funcionalidades existentes.

### 🎯 Mês 3: Testes, Ajustes e Lançamento
✅ Semana 9:
- [ ] Revisão geral do código e otimizações.
- [ ] Testes de usabilidade e ajustes de UI/UX.

✅ Semana 10:
- [ ] Implementação final do Planejador Inteligente.
- [ ] Melhorias no sistema de sugestões de investimentos.

✅ Semana 11:
- [ ] Testes beta com usuários reais.
- [ ] Correção de bugs e refinamentos finais.

✅ Semana 12:
- [ ] **Lançamento oficial da versão MVP! 🚀**

