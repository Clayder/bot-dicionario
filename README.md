## README ##

Nesse projeto eu desenvolvi um formulário e um bot para o telegram, com o intuito de me ajudar no estudo do inglês.

A função do formulário, é cadastrar palavras e frases em inglês, com as suas respectivas traduções.

O objetivo do bot, é enviar uma mensagem com alguma palavra/frase aleatória, para o chat do telegram. 

A ideia é ficar sempre revisando palavras/frases em inglês. 

### Configurações  ###

* Instalar o banco de dados ( banco-de-dados.sql está na raiz do projeto )
* Configurar o banco de dados no arquivo config/database.php
* Configurar os dados do telegram config/telegram_config.php

### Como obter o token do telegram ? ###

https://luizmarcus.com/php/como-criar-um-bot-para-o-telegram-em-php-parte-1/

### Como obter o id do chat ? ###

Depois que você configurou o seu bot e adicionou ele nos seus contatos, envie uma mensagem para ele.

O bot não vai responder !!

Acesse o link: http//www.sua_url.com.br/?rota=getMensagens

Nesse link, você consegue acessar todas as mensagens enviadas para o seu bot.

Obs.: Essas mensagens são arrays.

 Como obter o token do telegram ?

https://luizmarcus.com/php/como-criar-um-bot-para-o-telegram-em-php-parte-1/

Como obter o id do chat ?

	Depois que você configurou o seu bot e adicionou ele nos seus contatos, envie uma mensagem para ele.
	O bot não vai responder !!
	Acesse o link  sua_url.com.br/?rota=getMensagens
           Nesse link, você consegue acessar todas as mensagens enviadas para o seu bot.

 Obs.: Essas mensagens são arrays. Array
    (
        [update_id] => 1111111
        [message] => Array
            (
                [message_id] => 2222
                [from] => Array
                    (
                        [id] => 4444444
                        [first_name] => Fulana
                        [last_name] => Tal
                        [username] => fulana-tal
                        [language_code] => pt-BR
                    )

                [chat] => Array
                    (
                        [id] => 555555 // É ESSE ID QUE VOCÊ QUER !!!!!!!!!!!!! 
                        [first_name] => Fulana
                        [last_name] => Tal
                        [username] => fulana-tal
                        [type] => private
                    )

                [date] => 1500240993
                [text] => A mensagem …….
        )

)


