


# Ambulatorial-CSMO <img align="right" src="https://github.com/MarcosJuunioor/ambulatorial-csmo/blob/master/scriptcase.jpg" width="70px" heitgh="70px" /> 

## Descrição
Trata-se de um sistema de prontuário eletrônico desenvolvido para informatizar o trabalho
executado pelos servidores do Centro de Saúde Médico Odontológico- CSMO, IFPE. O mesmo é composto por cerca de 70
aplicações, que estão organizadas em 8 grupos: consulta para atualização de cadastro de pacientes e
servidores da saúde, controle de atendimentos, emissão de documentos (receitas etc.), formulários
de cadastro, login, menu, odontograma e prontuário. As aplicações estão distribuídas em pastas
contendo o nome do seu respectivo grupo.

## Propósito
O ambulatório do IFPE, há muito tempo, estava com a necessidade de um sistema para informatizar as suas tarefas, por vários motivos: 
diminuir o uso de papéis, aumentar a rapidez no atendimento, melhorar a segurança das informações etc. Visando sanar este problema,
o Departamento de Gestão de Tecnologia da Informação - DGTI, com sua equipe de desenvolvimento, surgiu com a ideia de criação de um 
sistema de prontuário e odontograma. 

## Ferramentas e Linguagens Utilizadas 
A principal ferramenta usada no projeto foi o ScriptCase, que permite o desenvolvimento de sistemas web completos em PHP, HTML, JavaScript, Ajax e CSS. No quesito banco de dados, o sgbd utilizado foi o MySql. Algumas outras ferramentas também auxiliaram o desenvolvimento do projeto, tais quais: WorkBench, Visual Studio Code e NotePad.

## Modelo Relacional
Abaixo está o modelo relacional da base de dados, onde se tem uma visão geral do sistema, as relações entre as tabelas/entidades e os seus respectivos campos.
![](https://github.com/MarcosJuunioor/ambulatorial-csmo/blob/master/MR%20atual.png)

## Aplicações e Funcionalidades
Neste tópico, cada grupo de aplicação será explanado de maneira resumida, indicando as
funcionalidades de suas respectivas aplicações.
- Consulta para atualização de cadastro de pacientes
Contém uma aplicação de controle (por meio da qual o paciente pode ser pesquisado pelo nome) e
cinco formulários de atualização dos dados do paciente, sendo um formulário pai (paciente) e
quatro filhos (servidor, terceirizado, aluno e visitante).
- Consulta para atualização de cadastro de servidores da saúde
Contém uma aplicação de controle (por meio da qual o servidor da saúde pode ser pesquisado pelo
nome ou siape) e um formulário de atualização dos dados do servidor.
- Controle de Atendimentos
Possui um formulário e uma grid. O primeiro serve para cadastrar atendimentos realizados por
médicos, enfermeiros ou dentistas, onde se define o tipo de atendimento, o procedimento realizado
e o tipo de paciente atendido. Já a grid é útil para se fazer consultas e relatórios relacionados aos
atendimentos realizados. Por exemplo, é possível obter-se o número de alunos que fizeram aferição
de pressão arterial em um determinado intervalo de tempo.
- Emissão de Documentos
Contém aplicações de controle e pdf report usadas para criação de diversos documentos decorrentes
do serviço médico/odontológico, tais quais: atestados, declarações, licenças, receituários e ficha de
acompanhamento.
- Formulários de Cadastro
Possui os formulários para cadastro dos pacientes (servidor, aluno, terceirizado e visitante) e dos
servidores da saúde (usuários).
- Login
Tem a aplicação de login e mais outras quatro referentes à atualização de senha, que são:
blank_envio, control_email, control_codigo e control_atualizar_senha.
blank_envio: possui o código php executado para que um token seja enviado ao e-mail do usuário.
control_email: aplicação de controle que recebe o e-mail para onde o código de recuperação de
senha será enviado. Obs: É verificado se o e-mail está cadastrado no sistema.
control_codigo: após enviado o e-mail com o token de recuperação da senha, o mesmo será
solicidado nesta aplicação de controle. Também é feita a verificação se o código é válido.
control_atualizar_senha: nesta aplicação de controle, o usuário deve digitar sua nova senha para
que ocorra a atualização (após os passos anteriores).
- Menu
Possui a aplicação de menu (que contém os botões para acesso a todas as outras aplicações) e duas
aplicações de controle usadas para alteração do e-mail do usuário.
- Odontograma
Contém uma aplicação de controle (para pesquisar o odontograma do paciente através do seu nome)
e duas blanks: odontograma_back_end e odontograma_inclusao. A primeira possui o código php
que realiza as transações com o banco de dados e operações relacionadas ao modelo de negócio, e
também recebe as requisições para criação de novos registros relacionados ao paciente. Já a
segunda tem o código de front-end, que é responsável por criar o odontograma dinamicamente,
assim como os botões, tabelas e outros elementos apresentados ao usuário.
OBS: Para entender o código tanto de front quanto de back-end, é necessário saber como funciona
um odontograma. Por isso, para uma possível manutenção futura, o programador deve procurar se
informar a respeito do assunto. Toda a codificação está comentada.
- Prontuário
Agrupa as aplicações que compõem o prontuário de um paciente. Tem-se a aplicação principal
“form_prontuario”, que é o mestre, e várias outras que são filhas ou detalhes dessa aplicação. O
mestre contém as informações gerais do paciente (como nome, data de nascimento etc.), e o seu
primeiro detalhe é um formulário com os dados específicos do mesmo (podendo ser um servidor,
terceirizado, aluno ou visitante). Depois disso, vem as outras aplicações que também são filhas do
“form_prontuario”: triagem, conduta médica/odontológica, evolução médica/odontológica,
prescrição e registro de enfermagem.

## Conclusão
Todo o período do processo de desenvolvimento do sistema durou cerca de 8 meses, onde seguimos todas as etapas do modelo tradicional: documentação, planejamento, implementação, testes e manutenção. Após esse prazo, entregamos o sistema aos usuários e o mesmo está sendo utilizado até a atualidade. Trago meus agradecimentos a toda equipe que participou do projeto, direta ou indiretamente:
Chefe do Setor: Tárcio Luna.
Coordenador da equipe de desenvolvimento: Victor Monte.
Desenvolvedores: Guilherme Wolner Dias Monte, Eduardo Pinto Feitosa da Silva e Marcos Antonio Ferreira da Silva Junior.
E toda a equipe de suporte e manutenção do departamento.
