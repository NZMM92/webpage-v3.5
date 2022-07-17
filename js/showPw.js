function showPw(){
    var i = document.getElementById("Newpw");
    if (i.type === "password"){
        i.type = "text";
    }else{
        i.type = "password";
    }
}