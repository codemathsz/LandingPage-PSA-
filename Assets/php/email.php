<!-- MODIFICADORES die() e exit()

    Primeiro, você deve usar os modificadores die() ou exit() toda vez que usar um redirecionamento. Em resumo, o problema é que os rastreadores e robôs podem ignorar os cabeçalho e, então, a página que você estava redirecionando é totalmente acessível a eles.
    Se, em outras palavras, você está usando um redirecionamento de cabeçalho para proteger uma página em particular, ela não oferece proteção nenhuma.

É por isso que você precisa desligar o redirecionamento se ele for ignorado. A maneira de fazer isso é anexar die() ou exit() após o seu redirecionamento:

-->


<?php
/*     header('Location: '.$form.php);
    die();
 */
    

    /*  acessando os arquivos */
    require_once('src/Exception.php');
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');

    /*  importando as classes */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    /*  instanciando a clssse phpmailer*/
    $mail =  new PHPMailer(true); /* true para habilitar o modo debug */
    $emailCadastrado= addslashes($_POST['email']);
    $nome = addslashes($_POST['nome']);
    $propostas = addslashes($_POST['ideias-propostas']);

try {


    /*  consiguração de servidor */
    
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; /*  habilitando o modo debug, não é obrigatório */
    $mail->isSMTP();/*  habilitar o SMPT */
    $mail->Host = 'smtp.gmail.com';/*  variável para o host,no caso do gmail */
    $mail->SMTPAuth = true;/* falando para a biblioteca que queremos trabalhar com o modo smtp ativo   */
    $mail->Username= 'mo284891@gmail.com';
    $mail->Password = 'matheus05092204';
    $mail->Port = 587; /*  porta que o gmail utiliza */

    /*   configurando o email que será o nosso from */
    $mail->setFrom('mo284891@gmail.com');
    $mail->addAddress($emailCadastrado);/*  para qual enail vamos enviar, obs* podemos enviar mais de um */
    /* $mail->addAddress('Bruno.corporativo@outlook.com'); */

    $mail->isHTML(true);/*  habilitando o modo html */
    $mail->Subject = 'Teste de email via gmail PHP'; /*  definindo assunto */
    $mail->Body = 'Olá,'. $nome. '\n'.
                            '
                            Muito Obrigado por enviar as suas propostas! '.'\n'. 
                            '
                            Assim, juntos podemos fazer de nossa escola um lufar maravilhoso!
                            '
                            .'\n'.
                            $propostas                            
                            
    ; /*  corpo do nosso email, o gmail aceita tag HTML */


    $mail->AltBody = 'Chegou o email teste'; /*  caso o cliente que esteja recebendo não aceite HTML */


    /*  se o email for enviado */
    if ($mail->send()) {
        echo "<script language='javascript'> window.alert('Email cadastrado com sucesso!');</script>";
        

        /*  Avisando que o email foi enviado com sucesso */
      

    }else{

        echo "Falha ao enviar o email";
        echo "<script language='javascript'> window.alert('Falha ao cadastrar o email!');</script>";
    }

} catch (Exception $e) {
    
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";/*  capturando Erro {$mail->ErrorInfo} */
}

echo "<script language='javascript'> window.location.replace('http://localhost:550/index.html');</script>";
?>