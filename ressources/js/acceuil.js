var t;
var n;

function destroy()
{
    $.post('./controllers/users.php', {"service":"destroy"}, function(response) {
        console.log(response);
        if(response == 1)
        {
            window.location = 'login';
        }
   });
}

function addphotos()
{
    t=[];
    n=0;
    var b=0;
    var files = document.getElementById("files").files;
    b=files.length;
    
        if(files.length==0)
        {
            text=document.getElementById("publish").value;
            $.post('./controllers/users.php', {"service":"pub","text":text}, function(response) {
                if(response == '1')
                {
                    document.getElementById("publish").value='';
                    console.log(response);
                }
                else if(response == '0')
                {
                    console.log("erreur de 2eme table");
                }
                else if(response == '00')
                {
                    console.log("erreur de 1eme table");
                }
                else
                {
                    console.log("makaynch");
                }
           });
        }
        else
        {
        for (var i = 0; i < files.length; i++)
        {
        var A=files[i].name;
        var sp=A.split("\\");
    var sp1=sp[sp.length-1].split(".")
    console.log(sp1[0])
  var name = files[i].name;
  console.log(name)
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  console.log(ext);
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("files").files[0]);
  var f = document.getElementById("files").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
     form_data.append("file", document.getElementById('files').files[i]);
     form_data.append("i", i);
     form_data.append("max", files.length);
    var l=i;
    console.log(i)
     $.ajax({
        url:"./controllers/upload.php",
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend:function(){
         $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
        },   
        success:function(response)
        {
            console.log("n:"+n)
            t[n]=response;
         console.log("t["+n+"]="+t[n]);
         document.getElementById("hide").textContent =  t[n];
         n++;
         
        }
       });
       
    //   if(parseInt(i)==0)
    //   form_data.append("file0", document.getElementById('files').files[0]);
    //   else if(i==1)
    //   form_data.append("file1", document.getElementById('files').files[i]);
    //   else if(i==2)
    //   form_data.append("file2", document.getElementById('files').files[i]);
    //   else if(i==3)
    //   form_data.append("file3", document.getElementById('files').files[i]);
    //   else if(i==4)
    //   form_data.append("file4", document.getElementById('files').files[i]);
    //   else if(i==5)
    //   form_data.append("file5", document.getElementById('files').files[i]);
    //   else if(i==6)
    //   form_data.append("file6", document.getElementById('files').files[i]);
    //   else if(i==7)
    //   form_data.append("file7", document.getElementById('files').files[i]);
    //   else if(i==8)
    //   form_data.append("file8", document.getElementById('files').files[i]);
    //   else if(i==9)
    //   form_data.append("file9", document.getElementById('files').files[i]);
  }
  console.log(document.getElementById("hide").textContent);
        }
        var files = document.getElementById("files").files;
        console.log(files.length);
        text=document.getElementById("publish").value;
       $.post('./controllers/users.php', {"service":"pubwithfiles","text":text,"len":parseInt(b)}, function(response) {
            
                console.log(response);

                if(response==1)
                {
                    document.getElementById("publish").value='';
                    document.getElementById("tofs").innerHTML='';
                }
            
      });
    }
    //    $res = connect::query("INSERT INTO `post`(`comment`, `fichier`) VALUES ('haytem wa3er','$location')");
}

function publier()
{
   
   addphotos();
}

function show()
{
    document.getElementById("tofs").innerHTML="";
    var file = document.getElementById("files").files;
        if (file.length > 0) {
            for (let i = 0; i < file.length; i++) {
                var fileReader = new FileReader();
 
            fileReader.onload = function (event) {
                document.getElementById("tofs").innerHTML+="<img src='"+event.target.result+"'style='height: 136px;width: 187px;margin-top: 5px;margin-right:5px'>";
            };
 
            fileReader.readAsDataURL(file[i]);
            }
        }
}

function files()
{
    document.getElementById("files").click();
}

function like()
{
    var A=this.parentElement.parentElement.children[0].textContent;
    var B=this.parentElement.children[0];
    $.post('./controllers/users.php', {"service":"like","idp":A,"type":"1"}, function(response) {
            
        console.log(response);

        if(response==1)
        {
            B.classList.remove("fa-thumbs-o-up");
            B.classList.add("fa-thumbs-up");
        }
        if(response == 3)
        {
            console.log("deja existe")
        }
    
});
}

function dislike()
{
    var A=this.parentElement.parentElement.children[0].textContent;
    var B=this.parentElement.children[0];
    $.post('./controllers/users.php', {"service":"like","idp":A,"type":"2"}, function(response) {
            
        console.log(response);

        if(response==1)
        {
            B.classList.remove("fa-thumbs-o-down");
            B.classList.add("fa-thumbs-down");
        }
        if(response == 3)
        {
            console.log("deja existe")
        }
    
});
}

window.onload = function()
{
    document.getElementById("destroy").addEventListener("click",destroy);
    document.getElementById("pub").addEventListener("click",publier);
    document.getElementById("icp").addEventListener("click",publier);
    document.getElementById("photo").addEventListener("click",files);
    document.getElementById("iph").addEventListener("click",files);
    document.getElementById("files").addEventListener("change",show);
    var a=document.getElementsByClassName("like");
    for (let i = 0; i < a.length; i++) {
        a[i].addEventListener("click",like);
    }
    var a=document.getElementsByClassName("lika");
    for (let i = 0; i < a.length; i++) {
        a[i].addEventListener("click",like);
    }
    var a=document.getElementsByClassName("dislike");
    for (let i = 0; i < a.length; i++) {
        a[i].addEventListener("click",dislike);
    }
    var a=document.getElementsByClassName("dislika");
    for (let i = 0; i < a.length; i++) {
        a[i].addEventListener("click",dislike);
    }
}