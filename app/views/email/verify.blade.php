<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Password Reset</h1>
        <p>Haga click en el siguiente enlace para confirmar su correo electrónico:</p>
        {{ HTML::link('account/verify/'. "?confirmation_code=" . $confirmation_code, 'Confirmar correo') }}
    </body>
</html>

