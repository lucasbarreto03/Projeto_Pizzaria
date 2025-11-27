# 🍕 Barretos Pizza System

O **Barretos Pizza System** é uma evolução completa do projeto original da Concessionária, desenvolvido na disciplina de **Programação WEB – A2**.  
A partir dessa base acadêmica, o sistema foi **refatorado**, **modernizado** e **expandido** para atender às necessidades reais de uma **Pizzaria Delivery**, incluindo novas lógicas de negócio, banco de dados avançado e interface personalizada.

---

## 🔄 Diferenciais e Evolução do Projeto

Embora tenha sido inspirado em um projeto acadêmico, esta nova versão apresenta melhorias significativas implementadas individualmente, tanto na arquitetura quanto na experiência do usuário.

### 1️⃣ Novo Modelo de Regra de Negócio — Relacionamento N:M

Diferente da estrutura simples 1:N da concessionária, este sistema utiliza **Relacionamentos Muitos-para-Muitos (N:M)**, essenciais para operações reais de delivery:

- **Pizza ↔ Ingredientes:**  
  Uma pizza possui vários ingredientes, e um ingrediente pode estar presente em várias pizzas.

- **Pedidos ↔ Itens:**  
  Um pedido pode conter múltiplas pizzas diferentes.

---

### 2️⃣ Funcionalidades Avançadas Implementadas

- **🛒 Carrinho de Compras (JavaScript)**  
  Cálculo automático do valor total em tempo real.

- **📦 Gestão de Estoque**  
  Cadastro de ingredientes com unidades de medida (kg, g, un, L).

- **📡 Rastreamento de Status do Pedido**  
  Estados configuráveis: *Pendente → Em Preparo → Saiu para Entrega*.

- **🚚 Lógica de Logística**  
  Cadastro completo de entregadores e clientes, incluindo endereço com complemento.

---

### 3️⃣ Interface Personalizada (UI/UX)

- Paleta inspirada em pizzarias (Vermelho Tomate + Creme).  
- Ícones e feedback visuais para cada módulo (Estoque, Cardápio, Delivery).  
- Layout mais limpo, organizado e amigável ao usuário.  

---

## 🛠️ Tecnologias Utilizadas

- **PHP 8+** — Regras de negócio e back-end  
- **MySQL** — Banco relacional com tabelas pivô e relacionamentos N:M  
- **JavaScript** — Cálculos e interatividade no front-end  
- **Bootstrap 5** — Interface responsiva e moderna  

---

## 🗄️ Estrutura do Banco de Dados

O sistema utiliza tabelas normalizadas com relacionamentos N:M através de tabelas associativas (pivô):

cliente
entregador
pizza
ingrediente
pedido
pizza_ingrediente (tabela pivô N:M)
item_pedido (tabela pivô N:M)

yaml
Copiar código

---

## 🚀 Como Executar o Projeto

1. Certifique-se de que o **XAMPP** está rodando (Apache + MySQL).  
2. Coloque o projeto em:  
C:\xampp\htdocs\

markdown
Copiar código
3. Acesse o **phpMyAdmin** e crie o banco:  
barretospizza

markdown
Copiar código
4. Importe o arquivo **.sql** disponível no repositório.  
5. No navegador, abra:  
http://localhost/Projeto_Pizzaria/index.php


---

## 📄 Observações

Projeto construído com base na atividade acadêmica A2, porém **fortemente aprimorado** com:

- novas lógicas de negócio,  
- banco de dados mais completo,  
- design personalizado  
- e funcionalidades reais de um sistema de pizzaria.
