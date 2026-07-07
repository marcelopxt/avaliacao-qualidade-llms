<div align="center">

# 🔬 Avaliação de Desempenho e Aspectos de Qualidade Estrutural de Código PHP Gerado por LLMs

**Um estudo empírico comparativo sobre assertividade lógica, eficiência computacional e aspectos da qualidade estrutural do código produzido por Modelos de Linguagem de Grande Escala (LLMs)**

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![SonarQube](https://img.shields.io/badge/SonarQube-10.6.0%20Community-4E9BCD?style=flat&logo=sonarqube&logoColor=white)](https://www.sonarsource.com/products/sonarqube/)
[![LeetCode](https://img.shields.io/badge/LeetCode-20%20Problemas-FFA116?style=flat&logo=leetcode&logoColor=white)](https://leetcode.com/)
[![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat&logo=docker&logoColor=white)](https://www.docker.com/)
[![License](https://img.shields.io/badge/Licença-Acadêmica-blue?style=flat)](#)
[![Status](https://img.shields.io/badge/Status-Concluído-brightgreen?style=flat)](#)

</div>

---

## Sumário

- [Guia Rápido de Reprodutibilidade](#-guia-rápido-de-reprodutibilidade)
- [Sobre o Projeto](#-sobre-o-projeto)
- [Modelos e Ferramentas Avaliados](#-modelos-e-ferramentas-avaliados)
- [Estrutura do Repositório](#-estrutura-do-repositório)
- [Guia de Reprodução do Estudo](#-guia-de-reprodução-do-estudo)
  - [Etapa 1 — Validação Lógica no LeetCode](#etapa-1--validação-lógica-no-leetcode)
  - [Etapa 2 — Análise Estática no SonarQube](#etapa-2--análise-estática-no-sonarqube)
- [Versões das Ferramentas](#-versões-das-ferramentas)
- [Observações Metodológicas](#-observações-metodológicas)
- [Autor e Contato](#-autor-e-contato)

---

## 🚀 Guia Rápido de Reprodutibilidade

Para reproduzir o ambiente de análise estática utilizado no estudo, utilize o arquivo [`docker-compose.yml`](./docker-compose.yml), que fixa a versão do SonarQube empregada na avaliação.

```bash
# 1. Clonar o repositório
git clone https://github.com/marcelopxt/avaliacao-qualidade-llms.git
cd avaliacao-qualidade-llms

# 2. Subir o SonarQube com versão fixa
docker compose up -d

# 3. Acessar o SonarQube
# http://localhost:9000
```

Após configurar o projeto no SonarQube e gerar o token de autenticação, copie o arquivo de exemplo:

```bash
cp sonar-project.properties.example sonar-project.properties
```

Em seguida, edite o arquivo `sonar-project.properties`, insira o token local e execute:

```bash
sonar-scanner
```

> ⚠️ O arquivo `sonar-project.properties` não deve ser versionado, pois pode conter token local de autenticação. Por isso, o repositório mantém apenas o arquivo `sonar-project.properties.example`.

---

## 📖 Sobre o Projeto

Este repositório documenta a pesquisa **“Avaliação de Desempenho e Aspectos de Qualidade Estrutural de Código PHP Gerado por LLMs”**, desenvolvida por **Marcelo Peixoto de Souza**, estudante do curso de **Bacharelado em Sistemas de Informação** no **Instituto Federal do Sudeste de Minas Gerais (IF Sudeste MG) — Campus Manhuaçu**.

O estudo avalia, de forma empírica e descritiva, o desempenho de três Modelos de Linguagem de Grande Escala (LLMs) na geração de código PHP para problemas algorítmicos, considerando quatro dimensões principais:

| Dimensão | O que mede |
|---|---|
| ✅ **Assertividade lógica** | Se o código gerado resolve corretamente o problema proposto. |
| ⏱️ **Tempo de execução** | O tempo reportado pela plataforma LeetCode para as soluções aceitas. |
| 💾 **Consumo de memória** | O uso de memória reportado pela plataforma LeetCode para as soluções aceitas. |
| 🧩 **Aspectos de qualidade estrutural** | Complexidade Ciclomática e Complexidade Cognitiva extraídas via SonarQube. |

Foram selecionados **20 problemas algorítmicos da plataforma LeetCode**, resolvidos por cada LLM utilizando a técnica de **Zero-Shot Prompting**, isto é, sem exemplos prévios, sem *fine-tuning* e sem tentativas sucessivas de correção manual.

> 💡 O foco do estudo não é apenas verificar se o código funciona, mas também observar como as soluções se comportam em termos de complexidade estrutural, tempo de execução e consumo de memória dentro da amostra analisada.

---

## 🤖 Modelos e Ferramentas Avaliados

### Modelos de IA avaliados

| Modelo | Provedor | Fonte oficial |
|---|---|---|
| 🟣 **Claude Sonnet 5** | Anthropic | [Anthropic](https://www.anthropic.com/) |
| 🔵 **Gemini 3.5 Flash** | Google | [Google AI for Developers](https://ai.google.dev/) |
| 🟢 **GPT-5.5 Instant** | OpenAI | [OpenAI](https://openai.com/) |

> Os nomes dos modelos correspondem às versões gratuitas disponíveis no período de realização do estudo. Como interfaces públicas podem ser atualizadas pelos provedores, recomenda-se registrar a data de acesso ao reproduzir o experimento.

### Ferramentas utilizadas

| Ferramenta | Finalidade |
|---|---|
| **PHP** | Linguagem-alvo da geração de código. |
| **LeetCode** | Validação lógica e funcional das soluções. |
| **SonarQube** | Extração das métricas de Complexidade Ciclomática e Complexidade Cognitiva. |
| **SonarScanner CLI** | Execução da varredura local e envio dos dados ao SonarQube. |
| **Docker Compose** | Provisionamento reprodutível do ambiente do SonarQube com versão fixa. |

> As versões exatas de cada ferramenta usadas na pesquisa estão documentadas em [`VERSIONS.md`](./VERSIONS.md).

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
├── prompts/                            # Enunciados exatos enviados às IAs
│
├── docker-compose.yml                  # Ambiente reprodutível do SonarQube com versão fixa
├── .gitignore                          # Regras de exclusão de versionamento
├── sonar-project.properties.example    # Modelo de configuração do SonarScanner
├── VERSIONS.md                         # Versões das ferramentas utilizadas
└── README.md                           # Documentação principal do projeto
```

### Detalhamento das pastas e arquivos

- **`codigos_gerados/`** — contém a saída bruta de cada LLM para os 20 problemas avaliados, organizada por modelo (`claude/`, `gemini/`, `gpt/`). Os arquivos devem permanecer sem edição para preservar a rastreabilidade do experimento.
- **`prompts/`** — armazena os enunciados enviados às IAs, permitindo a reprodução dos estímulos utilizados durante a coleta.
- **`docker-compose.yml`** — define o serviço do SonarQube com imagem versionada, evitando dependência de imagens flutuantes como `latest`.
- **`sonar-project.properties.example`** — arquivo de referência para configuração do SonarScanner. Deve ser copiado localmente para `sonar-project.properties` antes da execução.
- **`VERSIONS.md`** — registra as versões das ferramentas utilizadas, como PHP, SonarQube, SonarScanner CLI e Docker.

---

## 🧪 Guia de Reprodução do Estudo

Esta seção descreve o procedimento necessário para que professores, avaliadores ou outros pesquisadores possam reproduzir os resultados do estudo a partir dos artefatos disponibilizados no repositório.

### Etapa 1 — Validação Lógica no LeetCode

A verificação da corretude funcional de cada solução é feita diretamente na plataforma LeetCode:

1. Acesse o problema correspondente na plataforma [LeetCode](https://leetcode.com/).
2. Copie o conteúdo do arquivo `.php` correspondente, localizado em `codigos_gerados/<claude|gemini|gpt>/`.
3. Cole o código no editor da questão correspondente.
4. Execute o *submit*.
5. Registre o status obtido, o número de testes aprovados, o tempo de execução e o consumo de memória reportados pela plataforma.

> ⚠️ Nenhuma alteração deve ser feita no código gerado pelas IAs. A submissão deve utilizar a saída bruta exatamente como consta no repositório.

---

### Etapa 2 — Análise Estática no SonarQube

A análise estática foi utilizada para obter as métricas de **Complexidade Ciclomática** e **Complexidade Cognitiva** dos códigos gerados.

#### Passo 1 — Subir o ambiente com Docker Compose

Com o terminal aberto na raiz do repositório, execute:

```bash
docker compose up -d
```

Esse comando utiliza o arquivo [`docker-compose.yml`](./docker-compose.yml), que fixa a imagem do SonarQube usada no estudo.

#### Passo 2 — Instalar o SonarScanner CLI

Instale o **SonarScanner CLI** na versão indicada em [`VERSIONS.md`](./VERSIONS.md) e garanta que o comando `sonar-scanner` esteja disponível na variável de ambiente `PATH`.

#### Passo 3 — Configurar o projeto no SonarQube

1. Acesse `http://localhost:9000` no navegador.
2. Faça login com as credenciais iniciais padrão do SonarQube (`admin` / `admin`) e altere a senha quando solicitado.
3. Crie um projeto manual com o nome:

   ```text
   avaliacao-llms
   ```

4. Gere um token de acesso local para autenticar a análise via linha de comando.

#### Passo 4 — Configurar o arquivo de propriedades

Copie o arquivo de exemplo:

```bash
cp sonar-project.properties.example sonar-project.properties
```

Em seguida, edite o arquivo `sonar-project.properties` e insira o token gerado na propriedade correspondente, por exemplo:

```properties
sonar.login=SEU_TOKEN_AQUI
```

> Dependendo da versão do SonarScanner, a propriedade de autenticação também pode ser configurada como `sonar.token`. Para manter compatibilidade com o arquivo de exemplo do repositório, utilize a propriedade indicada nele.

#### Passo 5 — Executar a análise

Com o terminal aberto na raiz do projeto, execute:

```bash
sonar-scanner
```

#### Passo 6 — Consultar os resultados

Após a conclusão da varredura, acesse novamente `http://localhost:9000`, selecione o projeto `avaliacao-llms` e consulte a aba **Measures** para verificar as métricas de:

- Complexidade Ciclomática;
- Complexidade Cognitiva;
- Demais indicadores reportados pelo SonarQube.

---

## 🧾 Versões das Ferramentas

As versões exatas das ferramentas usadas na pesquisa estão documentadas em [`VERSIONS.md`](./VERSIONS.md). Esse arquivo deve ser consultado antes de qualquer tentativa de reprodução do estudo.

A existência de versões fixas é importante porque alterações em ferramentas externas, imagens Docker ou ambientes de execução podem modificar parcialmente os resultados obtidos, especialmente nas métricas de análise estática.

---

## ⚠️ Observações Metodológicas

- O estudo possui caráter **exploratório e descritivo**, com amostra de 20 problemas e uma rodada de geração por modelo.
- As métricas de tempo e memória são reportadas pelo LeetCode e podem sofrer variações conforme a carga da plataforma no momento da submissão.
- As médias de tempo e memória devem considerar apenas soluções com status `Accepted`, pois soluções com `Wrong Answer` ou `Time Limit Exceeded` não apresentam métricas comparáveis.
- A expressão **aspectos de qualidade estrutural** refere-se, neste estudo, especificamente às métricas de Complexidade Ciclomática e Complexidade Cognitiva. O estudo não mede diretamente duplicação, acoplamento, coesão, *code smells* ou manutenibilidade percebida por desenvolvedores.
- Os códigos gerados pelas LLMs devem ser analisados como saídas brutas. Correções manuais posteriores descaracterizariam o protocolo de avaliação em *zero-shot*.

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