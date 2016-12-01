function loadStep(stepNumber)
{
        disableButton('dalejAdmin');
        var e = document.getElementById("step"+stepNumber+"Select");
        var text = e.options[e.selectedIndex].text;
        var nextStep=stepNumber+1;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
        {
            if(this.readyState==4 && this.status==200)
            {
                document.getElementById("step"+nextStep).innerHTML=this.responseText;
            }
        };
        
        xmlhttp.open("GET", "adminStep"+nextStep+".php?selectedOption=" + text, true);
        xmlhttp.send();
        
        var e = document.getElementById("step"+nextStep+"Select");
}
 
