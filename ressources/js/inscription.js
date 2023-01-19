



function inscrire()
{
    var nom=document.getElementById("nom").value;
    var nickname=document.getElementById("prenom").value;
    var email=document.getElementById("email").value;
    var password=document.getElementById("password").value;
    var years=document.getElementById("years").value;
    var month=document.getElementById("month").value;
    var day=document.getElementById("day").value;
    var naissance=day+"/"+month+"/"+years;
    var gender=document.getElementsByName("gender");
    for (let i = 0; i < gender.length; i++) {
        if(gender[i].checked)
        gender=gender[i];
    }
    gender=gender.value;
    $.post('./controllers/users.php', {"service":"inscription","nom":nom,"prenom":nickname,"email":email,"password":password,"naissance":naissance,"gender":gender}, function(response) {
        document.getElementById("nom1").innerHTML="";
        document.getElementById("prenom1").innerHTML="";
        document.getElementById("email"+1).innerHTML="";
        document.getElementById("password1").innerHTML="";
        if(response==1)
         {
            console.log("your inscription est reussis");
            document.getElementById("message").style.color="green"
            document.getElementById("message").innerHTML = "ton inscription a ete bien ajouter."
            setTimeout(function(){ window.location = "login"; }, 3000);
            document.getElementById("nom").value="";
            document.getElementById("prenom").value="";
            document.getElementById("email").value="";
            document.getElementById("password").value="";
            document.getElementById("years").selectedIndex=0;
            document.getElementById("month").selectedIndex=0;
            document.getElementById("day").selectedIndex=0;
            document.getElementById("gender").checked=true;
         }
        else if(response==0)
        {
            console.log("erreur in database");
            document.getElementById("message").style.color="red"
            document.getElementById("message").innerHTML = "une erreur a coté de back-end."
        }
        else
        var obj = JSON.parse(response);
        for (x in obj) {
            document.getElementById(x+"1").innerHTML=obj[x];
          }
   });
    }

function log()
{
    window.location = "login"
}

window.onload=function()
{
    document.getElementById("login").addEventListener("click",log);
    document.getElementById("form").addEventListener("click",inscrire);
}