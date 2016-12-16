
// First level of edition - menu categories 
function editSubsiteName(categoryName)
{
    var prefix="menuLink_";
    var editedDiv=document.getElementById(prefix+categoryName);
    
    editedDiv.innerHTML="<i onclick='location.reload()' class='icon-cancel-circled'></i><input class='editSubsiteName' id='edit_"+categoryName+"' placeholder='"+categoryName+"' type='text'></input><i onclick=\"confirmChangeSubsite('"+categoryName+"')\" class='icon-ok-circled'><div id='editLinkDiv_"+categoryName+"'> <span onclick=\"editLink('"+categoryName+"')\">LINK</span></div><span id='deleteCategory_"+categoryName+"' onclick=\"deleteCategory('"+categoryName+"')\">USUŃ</span></i>";
}


function editLink(name)
{
    var prefix="editLinkDiv_";
    var editedDiv=document.getElementById(prefix+name);
    editedDiv.innerHTML="<i onclick='location.reload()' class='icon-cancel-circled'></i><input class='editSubsiteName' id='editLinkInput_"+name+"' placeholder='nazwa pliku' type='text'></input><i onclick=\"confirmChangeCategoryLink('"+name+"')\" class='icon-ok-circled'></i>";
}


function confirmChangeSubsite(categoryName)
{
    var inputId="edit_"+categoryName;
    var divId="menuLink_"+categoryName;
    var newName=document.getElementById(inputId).value;
    
    if (newName.length == 0)
    {
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(divId).innerHTML = this.responseText+'<i onclick="editSubsiteName(\''+newName+'\');" class="editIcon  icon-pencil"></div></i>';
                document.getElementById(divId).id="menuLink_"+newName;
            }
        };
        xmlhttp.open("GET", "changeSubsiteName.php?new_name="+newName+"&old_name="+categoryName, true);
        xmlhttp.send();
    }
}


function confirmChangeCategoryLink(name)
{
     var inputId="editLinkInput_"+name;
    var divId="editLinkDiv_"+name;
    var newLink=document.getElementById(inputId).value;
          
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(newLink=="")var message="Usunięto link";
                else var message="Zmieniono link na: "+this.responseText;
                document.getElementById(divId).innerHTML = message
            }
        };
        xmlhttp.open("GET", "changeCategoryLink.php?new_link="+newLink+"&name="+name, true);
        xmlhttp.send();
    
}

function deleteCategory(name)
{
        var divId="deleteCategory_"+name;
  if(name==0)
  {
      return;
  }else
  {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
        {
                document.getElementById(divId).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","deleteCategory.php?name="+name,true);
    xmlhttp.send();
  }
    
//Second level of edition - menu subsite 
function editSubSubsiteName(subsiteName)
{
        var prefix="subsiteLink_";
        var editedDiv=document.getElementById(prefix+subsiteName);
        
         editedDiv.innerHTML="<i onclick='location.reload()' class='icon-cancel-circled'></i><input class='editSubsiteName' id='editSubsite_"+subsiteName+"' placeholder='"+subsiteName+"' type='text'></input><i onclick=\"confirmChangeSubSubsite('"+subsiteName+"')\" class='icon-ok-circled'><div id='editLinkDivSubsite_"+subsiteName+"'> <span onclick=\"editLinkSubsite('"+subsiteName+"')\">LINK</span></div><span id='deleteSubsite_"+subsiteName+"' onclick=\"deleteSubsite('"+subsiteName+"')\">USUŃ</span></i>";
}

function editLinkSubsite(name)
{
    var prefix="editLinkDivSubsite_";
    var editedDiv=document.getElementById(prefix+name);
    editedDiv.innerHTML="<i onclick='location.reload()' class='icon-cancel-circled'></i><input class='editSubsiteName' id='editLinkInputSubsite_"+name+"' placeholder='nazwa pliku' type='text'></input><i onclick=\"confirmChangeSubsiteLink('"+name+"')\" class='icon-ok-circled'></i>";
}

function confirmChangeSubSubsite(subsiteName)
{
    var inputId="editSubsite_"+subsiteName;
    var divId="subsiteLink_"+subsiteName;
    var newName=document.getElementById(inputId).value;
    
    if (newName.length == 0)
    {
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(divId).innerHTML = this.responseText+'<i onclick="editSubSubsiteName(\''+newName+'\');" class="editIcon  icon-pencil"></div></i>';
                document.getElementById(divId).id="subsiteLink_"+newName;
            }
        };
        xmlhttp.open("GET", "changeSubSubsiteName.php?new_name="+newName+"&old_name="+subsiteName, true);
        xmlhttp.send();
    }
}

function confirmChangeSubsiteLink(name)
{
     var inputId="editLinkInputSubsite_"+name;
    var divId="editLinkDivSubsite_"+name;
    var newLink=document.getElementById(inputId).value;
          
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(newLink=="")var message="Usunięto link";
                else var message="Zmieniono link na: "+this.responseText;
                document.getElementById(divId).innerHTML = message
            }
        };
        xmlhttp.open("GET", "changeSubsiteLink.php?new_link="+newLink+"&name="+name, true);
        xmlhttp.send();
    
}

function editGreeting()
{
    var text=document.getElementById('content').innerHTML;
 document.getElementById('content').innerHTML="<textarea name=\"editor1\" id=\"editor1\" rows=\"10\" cols=\"80\">"+text+"</textarea><i onclick='location.reload()' class='icon-cancel-circled'><i onclick=\"confirmChangeGreeting()\" class='icon-ok-circled'>";
  CKEDITOR.replace('editor1');  
}

function confirmChangeGreeting()
{
        var newGreeting=CKEDITOR.instances['editor1'].getData();
          
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById('editor1').innerHTML=this.responseText;
            }
        };
        xmlhttp.open("GET", "changeGreeting.php?new_greeting="+newGreeting, true);
        xmlhttp.send();
}
