
function creer()
{
    window.location = 'inscription';
}

function login()
{
    email=document.getElementById("email").value;
    password=document.getElementById("password").value;
    $.post('./controllers/users.php', {"service":"login","email":email,"password":password}, function(response) {
        if(response != '')
        {
            console.log(response);
            window.location = 'acceuil';
        }
        else
        {
            console.log("makaynch");
        }
   });
}


window.onload = function()
{
     document.getElementById("creer").addEventListener("click",creer);
     document.getElementById("login").addEventListener("click",login);
}