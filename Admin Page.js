// JavaScript Document
hello( "google" ).api("me").then(function(json){
        alert("Your name is "+ json.name);
}, function(e){
        alert("Whoops! " + e.error.message );
});
