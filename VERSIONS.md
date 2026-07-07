# 🧾 Versões das Ferramentas Utilizadas

Este documento fixa as versões exatas de cada ferramenta usada na pesquisa, para que a reprodução produza resultados comparáveis aos relatados no estudo.

## Ambiente de análise

| Ferramenta           | Versão utilizada         | Observação                                                                 |
| -------------------- | ------------------------ | -------------------------------------------------------------------------- |
| **SonarQube**        | `10.6.0-community` (LTS) | _Community Edition_, com suporte nativo à análise de PHP.                  |
| **SonarScanner CLI** | `6.2.1`                  | Cliente de linha de comando usado para enviar a análise ao SonarQube.      |
| **PHP**              | `8.x`                    | Linguagem-alvo do código gerado pelos LLMs (sintaxe compatível com PHP 8). |
| **Docker Engine**    | `>= 24.0`                | Usado para provisionar o container do SonarQube.                           |

## Modelos de LLM avaliados

| Modelo               | Provedor  | Observação                            |
| -------------------- | --------- | ------------------------------------- |
| **Claude Sonnet 5**  | Anthropic | Versão gratuita, Zero-Shot Prompting. |
| **Gemini 3.5 Flash** | Google    | Versão gratuita, Zero-Shot Prompting. |
| **GPT-5.5 Instant**  | OpenAI    | Versão gratuita, Zero-Shot Prompting. |

> ⚠️ Como se trata de modelos de LLM hospedados (não determinísticos e sujeitos a atualizações silenciosas pelos provedores), a reprodução _exata_ do texto gerado pelos modelos não é garantida — apenas a reprodução da **análise estática** (SonarQube/SonarScanner) sobre o código já coletado em `codigos_gerados/` é determinística.

## Por que fixar versões?

O SonarQube e o SonarScanner têm, historicamente, alterado o cálculo de métricas (por exemplo, as regras de Complexidade Cognitiva) entre versões maiores. Usar sempre a versão mais recente faria os números variarem com o tempo, comprometendo a comparabilidade do estudo — por isso a recomendação é usar exatamente as versões listadas acima ao reproduzir a análise.
