@extends("layout")
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
<!--            <span id="signinButton">
                <span
                    class="g-signin"
                    data-callback="loginFinishedCallback"
                    data-clientid="770774477781-ij9l2nd57cp58130698fippismo36ao4.apps.googleusercontent.com"
                    data-cookiepolicy="single_host_origin"
                    data-requestvisibleactions="http://schema.org/AddAction"
                    data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me">
                </span>
            </span>-->
            <div id="gConnect">
                <button class="g-signin"
                    data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me"
                    data-requestvisibleactions="http://schemas.google.com/AddActivity"
                    data-clientId="770774477781-ij9l2nd57cp58130698fippismo36ao4.apps.googleusercontent.com"
                    data-accesstype="offline"
                    data-callback="onSignInCallback"
                    data-theme="dark"
                    data-cookiepolicy="single_host_origin">
                </button>
            </div>
        </div>
    </div>
<script>
//    
//    function loginFinishedCallback(authResult) {
//        if (authResult) {
//            if (authResult['error'] == undefined){
//                gapi.auth.setToken(authResult);
//                getData();
//            } else {
//                console.log('An error occurred');
//            }
//        } else {
//            console.log('Empty authResult');
//        }
//    }
//    function getData(){
//        gapi.client.load('oauth2', 'v2', function() {
//            var request = gapi.client.oauth2.userinfo.get();
//            request.execute(getDataCallback);
//        });
//    }
//
//    function getDataCallback(obj){
//        if (obj['given_name'] || obj['family_name']) {
//            $('#name').val(obj['given_name']);
//            $('#lastName').val(obj['family_name']);
//        }
//    }
    
var helper = (function() {
  var authResult = undefined;

  return {
    /**
     * Hides the sign-in button and connects the server-side app after
     * the user successfully signs in.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      $('#authResult').html('Auth Result:<br/>');
      for (var field in authResult) {
        $('#authResult').append(' ' + field + ': ' + authResult[field] + '<br/>');
      }
      if (authResult['access_token']) {
        // The user is signed in
        this.authResult = authResult;
        helper.connectServer();
        // After we load the Google+ API, render the profile data from Google+.
        gapi.client.load('plus','v1',this.renderProfile);
      } else if (authResult['error']) {
        // There was an error, which means the user is not signed in.
        // As an example, you can troubleshoot by writing to the console:
        console.log('There was an error: ' + authResult['error']);
        $('#authResult').append('Logged out');
        $('#authOps').hide('slow');
        $('#gConnect').show();
      }
      console.log('authResult', authResult);
    },
    /**
     * Retrieves and renders the authenticated user's Google+ profile.
     */
    renderProfile: function() {
      var request = gapi.client.plus.people.get( {'userId' : 'me'} );
      request.execute( function(profile) {
          $('#profile').empty();
          if (profile.error) {
            $('#profile').append(profile.error);
            return;
          }
          $('#profile').append(
              $('<p><img src=\"' + profile.image.url + '\"></p>'));
          $('#profile').append(
              $('<p>Hello ' + profile.displayName + '!<br />Tagline: ' +
              profile.tagline + '<br />About: ' + profile.aboutMe + '</p>'));
          if (profile.cover && profile.coverPhoto) {
            $('#profile').append(
                $('<p><img src=\"' + profile.cover.coverPhoto.url + '\"></p>'));
          }
        });
      $('#authOps').show('slow');
      $('#gConnect').hide();
    },
    /**
     * Calls the server endpoint to disconnect the app for the user.
     */
    disconnectServer: function() {
      // Revoke the server tokens
      $.ajax({
        type: 'POST',
        url: window.location.href + '/disconnect',
        async: false,
        success: function(result) {
          console.log('revoke response: ' + result);
          $('#authOps').hide();
          $('#profile').empty();
          $('#visiblePeople').empty();
          $('#authResult').empty();
          $('#gConnect').show();
        },
        error: function(e) {
          console.log(e);
        }
      });
    },
    /**
     * Calls the server endpoint to connect the app for the user. The client
     * sends the one-time authorization code to the server and the server
     * exchanges the code for its own tokens to use for offline API access.
     * For more information, see:
     *   https://developers.google.com/+/web/signin/server-side-flow
     */
    connectServer: function() {
      console.log(this.authResult.code);
      $.ajax({
        type: 'POST',
        url: window.location.href + "/connect?state={{ Session::get('state') }}&code=" + this.authResult.code,
        contentType: 'application/octet-stream; charset=utf-8',
        success: function(result) {
          console.log(result);
          helper.people();
        },
        processData: false,
        data: this.authResult.code
      });
    },
    /**
     * Calls the server endpoint to get the list of people visible to this app.
     */
    people: function() {
      $.ajax({
        type: 'GET',
        url: window.location.href + '/people',
        contentType: 'application/octet-stream; charset=utf-8',
        success: function(result) {
          helper.appendCircled(result);
        },
        processData: false
      });
    },
    /**
     * Displays visible People retrieved from server.
     *
     * @param {Object} people A list of Google+ Person resources.
     */
    appendCircled: function(people) {
        $('#name').val(people.name.givenName);
        $('#lastName').val(people.name.familyName);
    }
  };
})();

/**
 * Perform jQuery initialization and check to ensure that you updated your
 * client ID.
 */
$(document).ready(function() {
  $('#disconnect').click(helper.disconnectServer);
  if ($('[data-clientid="YOUR_CLIENT_ID"]').length > 0) {
    alert('This sample requires your OAuth credentials (client ID) ' +
        'from the Google APIs console:\n' +
        '    https://code.google.com/apis/console/#:access\n\n' +
        'Find and replace YOUR_CLIENT_ID with your client ID and ' +
        'YOUR_CLIENT_SECRET with your client secret in the project sources.'
    );
  }
});

/**
 * Calls the helper method that handles the authentication flow.
 *
 * @param {Object} authResult An Object which contains the access token and
 *   other authentication information.
 */
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}

function appendScript(src) {
    var scrpt = document.createElement('script');
    scrpt.type = 'text/javascript';
    scrpt.async = true;
    scrpt.src = src;
    $('head').append(scrpt);
    console.log('Script added');
}

$(function() {
    
  appendScript('//apis.google.com/js/client:platform.js');
  appendScript("//plus.google.com/js/client:plusone.js");
  $('#disconnect').click(helper.disconnectServer);
  window.console.log('Script cargado');
  if ($('[data-clientid="YOUR_CLIENT_ID"]').length > 0) {
    alert('This sample requires your OAuth credentials (client ID) ' +
        'from the Google APIs console:\n' +
        '    https://code.google.com/apis/console/#:access\n\n' +
        'Find and replace YOUR_CLIENT_ID with your client ID and ' +
        'YOUR_CLIENT_SECRET with your client secret in the project sources.'
    );
  }
});
</script>
@stop