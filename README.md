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

- [Sobre o Projeto](#-sobre-o-projeto)
- [Modelos e Ferramentas Avaliados](#-modelos-e-ferramentas-avaliados)
- [Estrutura do Repositório](#-estrutura-do-repositório)
- [Guia de Reprodução do Estudo](#-guia-de-reprodução-do-estudo)
  - [Pré-requisitos](#pré-requisitos)
  - [Instalação (Windows)](#instalação-windows)
  - [Etapa 1 — Validação Lógica no LeetCode](#etapa-1--validação-lógica-no-leetcode)
  - [Etapa 2 — Análise Estática no SonarQube](#etapa-2--análise-estática-no-sonarqube)
  - [Resolução de Problemas](#resolução-de-problemas)
- [Versões das Ferramentas](#-versões-das-ferramentas)
- [Observações Metodológicas](#-observações-metodológicas)
- [Autor e Contato](#-autor-e-contato)

---

## 📖 Sobre o Projeto

Este repositório documenta a pesquisa **"Avaliação de Desempenho e Aspectos de Qualidade Estrutural de Código PHP Gerado por LLMs"**, desenvolvida por **Marcelo Peixoto de Souza**, estudante do curso de **Bacharelado em Sistemas de Informação** no **Instituto Federal do Sudeste de Minas Gerais (IF Sudeste MG) — Campus Manhuaçu**.

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
├── analises_sonar/                     # Dados exportados da análise estática
│   ├── avaliacao-llms.zip              # Exportação completa do projeto no SonarQube
│   └── metricas_consolidadas.csv       # Métricas consolidadas em formato tabular
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
- **`analises_sonar/`** — contém os dados exportados da análise estática realizada no SonarQube, incluindo o arquivo `.zip` de exportação do projeto e o CSV com as métricas consolidadas.
- **`docker-compose.yml`** — define o serviço do SonarQube com imagem versionada, evitando dependência de imagens flutuantes como `latest`.
- **`sonar-project.properties.example`** — arquivo de referência para configuração do SonarScanner. Deve ser copiado localmente para `sonar-project.properties` antes da execução.
- **`VERSIONS.md`** — registra as versões das ferramentas utilizadas, como PHP, SonarQube, SonarScanner CLI e Docker.

---

## 🧪 Guia de Reprodução do Estudo

Esta seção descreve o procedimento completo — desde a instalação das ferramentas necessárias até a execução da análise — para que professores, avaliadores ou outros pesquisadores possam reproduzir os resultados do estudo a partir dos artefatos disponibilizados no repositório.

### Pré-requisitos

| Ferramenta | Finalidade |
|---|---|
| **Git** | Clonar o repositório. |
| **Docker Desktop** | Executar o container do SonarQube (já inclui Docker Compose). |
| **Node.js / npm** | Instalar o SonarScanner CLI. |
| **Navegador web** | Acessar a interface do SonarQube e o LeetCode. |
| **Conta no LeetCode** | Submeter as soluções para validação lógica (apenas Etapa 1). |

---

### Instalação (Windows)

#### 1. Git

Baixe e instale pelo site oficial: [git-scm.com/download/win](https://git-scm.com/download/win), seguindo o assistente com as opções padrão.

#### 2. Docker Desktop

Baixe e instale pelo site oficial: [docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop/).

Após a instalação:

1. Habilite o backend **WSL 2** quando solicitado (recomendado).
2. Reinicie o computador se necessário.
3. Abra o Docker Desktop e aguarde a inicialização completa (ícone na bandeja do sistema ficará estável).

> O Docker Compose v2 já vem incluído no Docker Desktop.

#### 3. Node.js

Baixe e instale a versão **LTS** pelo site oficial: [nodejs.org](https://nodejs.org/). O npm será instalado automaticamente junto com o Node.js.

#### 4. SonarScanner CLI

Com o Node.js e npm já instalados, execute no terminal:

```bash
npm install -g sonar-scanner
```

#### Verificação

Abra o **PowerShell** e execute os comandos abaixo para confirmar que tudo está instalado:

```powershell
git --version
docker --version
docker compose version
node --version
sonar-scanner --version
```

> ✅ Se todos os comandos retornarem versões válidas, o ambiente está pronto para uso.

---

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

#### Passo 1 — Clonar o repositório

```bash
git clone https://github.com/marcelopxt/avaliacao-qualidade-llms.git
cd avaliacao-qualidade-llms
```

#### Passo 2 — Subir o ambiente com Docker Compose

Certifique-se de que o Docker está em execução e execute:

```bash
docker compose up -d
```

Esse comando utiliza o arquivo [`docker-compose.yml`](./docker-compose.yml), que provisiona o SonarQube na versão `10.6.0-community` com as seguintes configurações:

- **Porta exposta:** `9000` (acesso em `http://localhost:9000`)
- **Volumes persistentes:** dados, extensões e logs são armazenados em volumes Docker nomeados, evitando perda de dados entre reinicializações.
- **Verificação de bootstrap desabilitada:** a variável `SONAR_ES_BOOTSTRAP_CHECKS_DISABLE=true` permite a execução em ambientes de desenvolvimento sem as checagens de produção do Elasticsearch.

Aguarde cerca de **1 a 2 minutos** para que o SonarQube esteja totalmente operacional. Acompanhe os logs com:

```bash
docker compose logs -f sonarqube
```

Quando a mensagem `SonarQube is operational` aparecer nos logs, prossiga para o próximo passo.

#### Passo 3 — Configurar o projeto no SonarQube

1. Acesse `http://localhost:9000` no navegador.
2. Faça login com as credenciais iniciais padrão do SonarQube (`admin` / `admin`) e altere a senha quando solicitado.
3. Crie um projeto manual com o nome:

   ```text
   avaliacao-llms
   ```

4. Gere um token de acesso local para autenticar a análise via linha de comando:
   - Acesse **My Account** (ícone de usuário no canto superior direito) → **Security** → **Generate Tokens**.
   - Defina um nome para o token (ex.: `scanner-local`) e clique em **Generate**.
   - **Copie o token gerado** — ele será exibido apenas uma vez.

#### Passo 4 — Configurar o arquivo de propriedades

Copie o arquivo de exemplo:

```bash
cp sonar-project.properties.example sonar-project.properties
```

Em seguida, edite o arquivo `sonar-project.properties` e insira o token gerado na propriedade correspondente:

```properties
sonar.projectKey=avaliacao-llms
sonar.projectName=Avaliação LLMs
sonar.sources=codigos_gerados
sonar.host.url=http://localhost:9000
sonar.login=SEU_TOKEN_AQUI          # ← substitua pelo token gerado
sonar.php.file.suffixes=php
```

> ⚠️ O arquivo `sonar-project.properties` **não deve ser versionado**, pois contém o token local de autenticação. Ele já está incluído no `.gitignore` do repositório.

> Dependendo da versão do SonarScanner, a propriedade de autenticação também pode ser configurada como `sonar.token`. Para manter compatibilidade com o arquivo de exemplo do repositório, utilize a propriedade indicada nele.

#### Passo 5 — Executar a análise

Com o terminal aberto na raiz do projeto, execute:

```bash
sonar-scanner
```

A saída esperada deve incluir mensagens como:

```text
INFO: Scanner configuration file: .../sonar-scanner.properties
INFO: Project root configuration file: .../sonar-project.properties
INFO: SonarScanner CLI 6.2.1
...
INFO: ANALYSIS SUCCESSFUL
INFO: Note that you will be able to access the updated dashboard once the server has processed the submitted analysis report.
```

#### Passo 6 — Consultar os resultados

Após a conclusão da varredura, acesse novamente `http://localhost:9000`, selecione o projeto `avaliacao-llms` e consulte a aba **Measures** para verificar as métricas de:

- Complexidade Ciclomática;
- Complexidade Cognitiva;
- Demais indicadores reportados pelo SonarQube.

---

### Resolução de Problemas

| Problema | Causa provável | Solução |
|---|---|---|
| `docker: command not found` | Docker não instalado ou não adicionado ao PATH. | Instale o Docker Desktop conforme as instruções acima. |
| `Cannot connect to the Docker daemon` | O serviço do Docker não está em execução. | Abra o Docker Desktop e aguarde a inicialização. |
| SonarQube não abre em `localhost:9000` | O container ainda está inicializando. | Aguarde 1–2 minutos e verifique os logs com `docker compose logs -f sonarqube`. |
| `sonar-scanner: command not found` | SonarScanner não foi instalado via npm. | Execute `npm install -g sonar-scanner` e reabra o terminal. |
| `Not authorized. Analyzing this project requires authentication.` | Token inválido ou ausente no arquivo de propriedades. | Verifique se o token foi copiado corretamente para `sonar.login` no arquivo `sonar-project.properties`. |
| `Project not found. Key: avaliacao-llms` | O projeto não foi criado no SonarQube. | Crie o projeto manualmente na interface web com a chave `avaliacao-llms`. |

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
