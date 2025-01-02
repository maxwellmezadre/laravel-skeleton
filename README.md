# Laravel Skeleton

Bem-vindo(a) ao **Laravel Skeleton**! Este projeto foi criado para agilizar a configuração inicial de qualquer aplicação Laravel, incluindo ferramentas de qualidade de código, formatação, testes e git hooks via Captain Hook. Além disso, o projeto conta com traduções para PT-BR nativas do Laravel, facilitando a internacionalização.

---

## Descrição

Este repositório oferece uma estrutura sólida para desenvolvimento em Laravel com:

- **Rector** e **Laravel Pint** para padronização de código e formatação;
- **PHPStan** para análise estática (types) do código;
- **Pest** para testes unitários e cobertura de tipos;
- Paralelização de alguns processos para maior velocidade de execução;
- **Captain Hook** para gerenciar automaticamente scripts de validação no fluxo de commits;
- Traduções para PT-BR já prontas, bastando configurar o locale desejado.

O foco é permitir que você inicie o desenvolvimento com um ambiente de qualidade, pronto para CI/CD, minimizando problemas de estilo, potenciais bugs e garantindo boas práticas de versionamento.

---

## Requisitos

| Tecnologia   | Versão Mínima |
|--------------|---------------|
| **PHP**      | 8.2+          |
| **Composer** | -             |
| **Node.js** & **npm** | Opcional (para assets e front-end) |

---

## Instalação

Siga os passos abaixo para configurar o projeto:

1. **Clone o repositório ou faça o download do ZIP**:
   ```bash
   git clone https://github.com/seu-usuario/seu-template-laravel.git
   cd seu-template-laravel
   ```

2. **Instale as dependências PHP**:
   ```bash
   composer install
   ```

3. *(Opcional)* **Instale as dependências Node caso utilize front-end**:
   ```bash
   npm install
   npm run dev
   ```

4. **Configuração do arquivo `.env`**:
   No repositório, já existe um arquivo de exemplo `.env.example`. Copie e ajuste as variáveis de ambiente conforme necessário:
   ```bash
   cp .env.example .env
   ```
   Por padrão, o timezone e locale já estão ajustados para `pt_BR`:
   ```env
   APP_LOCALE=pt_BR
   APP_FALLBACK_LOCALE=pt_BR
   APP_FAKER_LOCALE=pt_BR
   ```

    - Altere o banco de dados para SQLite ou outro de sua preferência.
    - Ajuste configurações de e-mail, cache, filas, etc.

5. **Gere a key da aplicação**:
   ```bash
   php artisan key:generate
   ```

Pronto! Agora você está com o ambiente Laravel configurado.

---

## Configurando as Traduções PT-BR

Este projeto já inclui o pacote de traduções em Português do Brasil. Para utilizá-las:

1. Abra o arquivo `config/app.php`.
2. Altere a linha:
   ```php
   'locale' => 'en',
   ```
   para:
   ```php
   'locale' => 'pt_BR',
   ```
3. *(Opcional)* Defina também:
   ```php
   'fallback_locale' => 'pt_BR',
   ```
   para garantir o PT-BR como idioma de fallback.

---

## Integração com Captain Hook

O **Captain Hook** auxilia no gerenciamento de git hooks, automatizando processos antes de commits e pushes. Configuração inicial:

- **Validação de mensagens de commit** (`commit-msg`) com o padrão **Conventional Commits**.
- **Testes antes do commit** (`pre-commit`) para evitar envio de código quebrado.

### Configuração

Exemplo do arquivo `captainhook.json`:

```json
{
  "commit-msg": {
    "enabled": true,
    "actions": [
      {
        "action": "\\Ramsey\\CaptainHook\\ValidateConventionalCommit"
      }
    ]
  },
  "pre-commit": {
    "enabled": true,
    "actions": [
      {
        "action": "composer test:parallel"
      }
    ]
  }
}
```

### Descrição dos Hooks

| Hook         | Descrição                                                                             |
|--------------|---------------------------------------------------------------------------------------|
| **commit-msg** | Valida o formato da mensagem de commit usando `ValidateConventionalCommit`.         |
| **pre-commit** | Executa `composer test:parallel` antes do commit, rodando testes em paralelo.       |

---

## Comandos Disponíveis

Os scripts mais importantes para qualidade de código e testes estão no `composer.json`.

### **Formatação**

| Comando               | Descrição                                                            | Uso                            |
|-----------------------|----------------------------------------------------------------------|--------------------------------|
| **format:rectify**    | Executa o Rector para refatorar o código, aplicando ajustes.         | `composer format:rectify`     |
| **format:code-style** | Garante estilo de código uniforme com Laravel Pint.                 | `composer format:code-style`  |
| **format**            | Executa `format:rectify` e `format:code-style`.                     | `composer format`             |

### **Testes**

| Comando               | Descrição                                                             | Uso                             |
|-----------------------|-----------------------------------------------------------------------|---------------------------------|
| **test:rectify**      | Verifica possíveis ajustes com o Rector em modo dry-run.             | `composer test:rectify`        |
| **test:code-style**   | Verifica o estilo do código com Laravel Pint.                        | `composer test:code-style`     |
| **test:types**        | Realiza análise estática do código com PHPStan.                      | `composer test:types`          |
| **test:arch**         | Roda testes Pest de arquitetura com `--filter=arch`.                | `composer test:arch`           |
| **test:type-coverage**| Verifica cobertura de tipos (100%) com Pest.                         | `composer test:type-coverage`  |
| **test:unit**         | Executa todos os testes unitários com Pest em paralelo.              | `composer test:unit`           |
| **test**              | Roda todos os testes e verificações de qualidade de código.          | `composer test`                |
| **test:parallel**     | Executa testes em paralelo (exceto formatação).                      | `composer test:parallel`       |

### **Formatação e Testes Combinados**

| Comando               | Descrição                                                             | Uso                             |
|-----------------------|-----------------------------------------------------------------------|---------------------------------|
| **format-and-test**   | Executa formatação e depois parte dos testes em paralelo.            | `composer format-and-test`     |

---

## Contribuição

Sinta-se à vontade para abrir **Issues** e enviar **Pull Requests** com melhorias, correções ou sugestões. Toda contribuição é bem-vinda!
