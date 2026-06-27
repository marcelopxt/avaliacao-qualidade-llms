# Avaliação de Qualidade de Código gerado por LLMs

Repositório contendo os artefatos do estudo empírico sobre a qualidade de códigos gerados por IAs (ChatGPT, Gemini e DeepSeek) a partir de problemas do LeetCode.

## Reprodutibilidade do Ambiente (SonarQube)

Para garantir a extração correta das métricas de Complexidade e Code Smells, a análise estática foi realizada utilizando a versão Community do SonarQube via container. 

Para reproduzir o ambiente localmente, execute o seguinte comando:

```bash
docker run -d --name sonarqube -e SONAR_ES_BOOTSTRAP_CHECKS_DISABLE=true -p 9000:9000 sonarqube:community