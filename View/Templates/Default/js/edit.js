$(document).ready( function() {
    $("#editForm .submitButton").click( function() {
        usernameSet = parseInt($(".username").val().length);
        commentSet  = parseInt($(".comment").val().length);

        var errorText = null;
        if(usernameSet == 0 && commentSet == 0) {
            errorText = "Lütfen adınızı ve yorumunuzu yazın";
        }
        else if(usernameSet == 0) {
            errorText = "Lütfen kullanıcı adınızı yazın";
        }
        else if(commentSet == 0) {
            errorText = "Lütfen bir yorum yazın";
        }

        if( errorText ) {
            alert(errorText);
            return false;
        }
    });
});

