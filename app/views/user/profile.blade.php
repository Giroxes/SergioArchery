@extends("layout")
@section("script")
<script src="https://apis.google.com/js/client:platform.js" async defer></script>
@stop
@section("content")
    <div class="media thumbnail">
        <div class="media-body">
            {{ Form::model(Auth::user(), [
                'url' => 'user/' . Auth::user()->id,
                'method' => 'PATCH',
                'role' => 'form'
            ]) }}
            <div class='form-group'>
                {{ Form::label('username', 'Nombre de usuario') }}
                {{ Form::text('username', null, [
                    'class' => 'form-control',
                    'disabled' => 'disabled'
                ]) }}
            </div>
            <div class='form-group'>
                {{ Form::label('email', 'E-Mail') }}
                {{ Form::text('email', null, [
                    'class' => 'form-control',
                    'disabled' => 'disabled'
                ]) }}
            </div>
            <div class='form-group'>
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', null, [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class='form-group'>
                {{ Form::label('lastName', 'Apellidos') }}
                {{ Form::text('lastName', null, [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class='form-group'>
                {{ Form::submit('Guardar cambios', [
                    'class' => 'btn btn-primary'
                ]) }}
            </div>
            {{ Form::close() }}
            <span id="signinButton">
                <span
                    class="g-signin"
                    data-callback="loginFinishedCallback"
                    data-clientid="770774477781-ij9l2nd57cp58130698fippismo36ao4.apps.googleusercontent.com"
                    data-cookiepolicy="single_host_origin"
                    data-requestvisibleactions="http://schema.org/AddAction"
                    data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me">
                </span>
            </span>
        </div>
    </div>
<script>
    
    function loginFinishedCallback(authResult) {
        if (authResult) {
            if (authResult['error'] == undefined){
                gapi.auth.setToken(authResult);
                getData();
            } else {
                console.log('An error occurred');
            }
        } else {
            console.log('Empty authResult');
        }
    }
    function getData(){
        gapi.client.load('oauth2', 'v2', function() {
            var request = gapi.client.oauth2.userinfo.get();
            request.execute(getDataCallback);
        });
    }

    function getDataCallback(obj){
        if (obj['given_name'] || obj['family_name']) {
            $('#name').val(obj['given_name']);
            $('#lastName').val(obj['family_name']);
        }
    }
</script>
@stop