<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Password Reset</h1>
        To reset your password, complete this form:
        {{ HTML::link('user/reset'. "?token=" . $token, 'CLICK') }}
    </body>
</html>