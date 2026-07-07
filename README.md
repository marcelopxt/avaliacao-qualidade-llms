<div align="center">

# 🔬 Avaliação de Desempenho e Qualidade Estrutural de Código PHP Gerado por LLMs

**Um estudo empírico comparativo sobre a assertividade lógica e a qualidade estrutural do código produzido por Modelos de Linguagem de Grande Escala (LLMs)**

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![SonarQube](https://img.shields.io/badge/SonarQube-10.6%20LTS-4E9BCD?style=flat&logo=sonarqube&logoColor=white)](https://www.sonarsource.com/products/sonarqube/)
[![LeetCode](https://img.shields.io/badge/LeetCode-20%20Problemas-FFA116?style=flat&logo=leetcode&logoColor=white)](https://leetcode.com/)
[![License](https://img.shields.io/badge/Licença-Acadêmica-blue?style=flat)](#)
[![Status](https://img.shields.io/badge/Status-Concluído-brightgreen?style=flat)](#)

</div>

---

## Sumário

- [Sobre o Projeto](#-sobre-o-projeto)
- [Modelos e Ferramentas Avaliados](#-modelos-e-ferramentas-avaliados)
- [Estrutura do Repositório](#-estrutura-do-repositório)
- [Guia de Reprodução do Estudo](#-guia-de-reprodução-do-estudo)
  - [Etapa 1 — Validação Lógica (LeetCode)](#etapa-1--validação-lógica-leetcode)
  - [Etapa 2 — Análise Estática de Qualidade (SonarQube)](#etapa-2--análise-estática-de-qualidade-sonarqube)
- [Versões das Ferramentas](#-versões-das-ferramentas)
- [Autor e Contato](#-autor-e-contato)

---

## 📖 Sobre o Projeto

Este repositório documenta a pesquisa **"Avaliação de Desempenho e Qualidade Estrutural de Código PHP Gerado por LLMs"**, desenvolvida por **Marcelo Peixoto de Souza**, estudante do curso de **Bacharelado em Sistemas de Informação** no **Instituto Federal do Sudeste de Minas Gerais (IF Sudeste MG) — Campus Manhuaçu**.

O estudo avalia, de forma sistemática e reprodutível, o desempenho de três Modelos de Linguagem de Grande Escala (LLMs) na geração nativa de código PHP, considerando quatro dimensões principais:

| Dimensão | O que mede |
|---|---|
| ✅ **Assertividade Lógica** | O código resolve corretamente o problema proposto? |
| ⏱️ **Tempo de Execução** | Desempenho em tempo de processamento (*runtime*). |
| 💾 **Consumo de Memória** | Eficiência no uso de recursos computacionais. |
| 🧩 **Qualidade Estrutural** | Complexidade Ciclomática e Complexidade Cognitiva. |

Foram selecionados **20 problemas algorítmicos da plataforma LeetCode**, resolvidos por cada LLM utilizando a técnica de **Zero-Shot Prompting** — ou seja, sem exemplos prévios, *fine-tuning* ou engenharia de prompt avançada, refletindo o comportamento "puro" de cada modelo em suas versões gratuitas.

> 💡 O foco da pesquisa não é apenas verificar *se o código funciona*, mas sim **como ele é construído estruturalmente** — um aspecto frequentemente negligenciado em avaliações de LLMs voltadas à geração de código.

---

## 🤖 Modelos e Ferramentas Avaliados

### Modelos de IA (versões gratuitas)

| Modelo | Provedor |
|---|---|
| 🟣 **Claude Sonnet 5** | Anthropic |
| 🔵 **Gemini 3.5 Flash** | Google |
| 🟢 **GPT-5.5 Instant** | OpenAI |

### Ferramentas Utilizadas

| Ferramenta | Finalidade |
|---|---|
| **PHP** | Linguagem-alvo da geração de código |
| **LeetCode** | Validação lógica e funcional das soluções |
| **SonarQube** | Análise estática de qualidade de código |
| **SonarScanner CLI** | Execução da varredura e envio dos dados ao SonarQube |
| **Docker** | Provisionamento do ambiente do SonarQube |

> As versões exatas de cada ferramenta usadas na pesquisa estão em **[`VERSIONS.md`](./VERSIONS.md)**.

---

## 📁 Estrutura do Repositório

```text
avaliacao-qualidade-llms/
│
├── codigos_gerados/                    # Saídas brutas geradas pelas IAs
│   ├── claude/                         # 20 arquivos .php gerados pelo Claude Sonnet 5
│   ├── gemini/                         # 20 arquivos .php gerados pelo Gemini 3.5 Flash
│   └── gpt/                            # 20 arquivos .php gerados pelo GPT-5.5 Instant
│
├── prompts/                            # Enunciados exatos enviados às IAs (sem extensão)
│
├── .gitignore                          # Regras de exclusão de versionamento
├── sonar-project.properties.example    # Modelo de configuração do SonarScanner
├── VERSIONS.md                         # Versões exatas de todas as ferramentas utilizadas
└── README.md                           # Documentação principal do projeto
```

### Detalhamento das pastas

- **`codigos_gerados/`** — Contém a saída **exata e sem edições** de cada LLM para os 20 problemas propostos, organizada em subpastas por modelo (`claude/`, `gemini/`, `gpt/`), garantindo total rastreabilidade e reprodutibilidade da análise.
- **`prompts/`** — Armazena os textos originais dos enunciados enviados a cada IA, permitindo que qualquer pesquisador reproduza exatamente os mesmos estímulos utilizados no estudo.
- **`sonar-project.properties.example`** — Arquivo de referência para configuração do SonarScanner, que deve ser copiado e personalizado localmente por quem for reproduzir a análise.

---

## 🧪 Guia de Reprodução do Estudo

Esta seção descreve o passo a passo completo para que **professores, avaliadores ou outros pesquisadores** possam reproduzir integralmente os resultados obtidos.

### Etapa 1 — Validação Lógica (LeetCode)

A verificação da corretude funcional de cada solução é feita diretamente na plataforma LeetCode:

1. Acesse o problema correspondente na plataforma [LeetCode](https://leetcode.com/).
2. Copie o conteúdo do arquivo `.php` correspondente, localizado em `codigos_gerados/<claude|gemini|gpt>/`.
3. Cole o código no editor da questão respectiva.
4. Execute o *submit* e registre o resultado (Aceito / Rejeitado), o tempo de execução e o consumo de memória reportados pela plataforma.

> ⚠️ Não é feita nenhuma alteração no código gerado pelas IAs — a submissão deve ser feita com a saída bruta, exatamente como consta no repositório.

---

### Etapa 2 — Análise Estática de Qualidade (SonarQube)

A qualidade estrutural do código (Complexidade Ciclomática e Complexidade Cognitiva) é obtida por meio do **SonarQube**. Siga os passos abaixo (as versões exatas de cada ferramenta estão em [`VERSIONS.md`](./VERSIONS.md)):

#### Passo 1 — Subir o container do SonarQube

Execute um container do SonarQube exposto na porta `9000`:

```bash
docker run -d --name sonarqube -p 9000:9000 sonarqube:10.6.0-community
```

#### Passo 2 — Instalar o SonarScanner CLI

Instale o **SonarScanner CLI** (versão indicada em `VERSIONS.md`) em sua máquina e garanta que o executável `sonar-scanner` esteja disponível na variável de ambiente `PATH`.

#### Passo 3 — Configurar o projeto no SonarQube

1. Acesse `http://localhost:9000` no navegador.
2. Faça login (usuário/senha padrão inicial: `admin` / `admin`).
3. Crie um **projeto manual** com o nome:

   ```
   avaliacao-llms
   ```

4. Gere um **Token de acesso local**, que será utilizado para autenticar a análise via linha de comando.

#### Passo 4 — Configurar o arquivo de propriedades

1. Renomeie o arquivo `sonar-project.properties.example` para:

   ```
   sonar-project.properties
   ```

2. Insira o Token gerado na propriedade `sonar.login`:

   ```properties
   sonar.login=SEU_TOKEN_AQUI
   ```

#### Passo 5 — Executar a análise

Com o terminal aberto na **raiz do projeto**, execute:

```bash
sonar-scanner
```

#### Passo 6 — Consultar os resultados

Após a conclusão da varredura, acesse novamente `http://localhost:9000`, selecione o projeto `avaliacao-llms` e navegue até a aba **Measures**, onde estarão consolidadas as métricas de:

- Complexidade Ciclomática
- Complexidade Cognitiva
- Demais indicadores de qualidade estrutural

---

## 🧾 Versões das Ferramentas

As versões exatas de cada ferramenta usada na pesquisa — necessárias para que a reprodução gere resultados comparáveis aos relatados no estudo — estão documentadas em **[`VERSIONS.md`](./VERSIONS.md)**.

---

## 👨‍💻 Autor e Contato

**Marcelo Peixoto de Souza**
Estudante de Bacharelado em Sistemas de Informação
Instituto Federal do Sudeste de Minas Gerais (IF Sudeste MG) — *Campus Manhuaçu*

[![GitHub](https://img.shields.io/badge/GitHub-marcelopxt-181717?style=flat&logo=github&logoColor=white)](https://github.com/marcelopxt)

---

<div align="center">

*Este repositório é parte de um estudo acadêmico e possui fins exclusivamente educacionais e científicos.*

</div>