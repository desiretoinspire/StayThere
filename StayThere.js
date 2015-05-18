/*hello.on('auth.login', function(auth){

// call user information, for the given network
hello( auth.network ).api( '/me' ).success(function(r){
 var $target = $("#profile_"+ auth.network );
if($target.length==0){
$target = $("<divid='profile_"+auth.network+"'></div>").appendTo("#profile");
}
$target.html('<img src="'+r.thumbnail+'" /> Hey'+r.name).attr('title',r.name + " on "+auth.network);
});
});*/

hello.init({ 
        google : '339205709123-oc6o7slpkoteuad3dffk8uhre4uh4if4.apps.googleusercontent.com'
},
{redirect_uri:'http://www.athena.nitc.ac.in/francis_b120459cs/AdminPage.html'}
);

// JavaScript Document
hello( "google" ).api("me").then(function(json){
        alert("Your name is "+ json.name);
}, function(e){
        alert("Whoops! " + e.error.message );
});
