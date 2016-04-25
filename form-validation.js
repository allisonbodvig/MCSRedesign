
function addReq ( req, type )
{
    var obj = document.getElementById(req);
    
    if (type == "pre" )
    {
        obj.innerHTML = obj.innerHTML + "<div><br><select name=\"pre\"> <option value=\"NONE\" selected>NONE</option> <option value=\"CSC\">CSC</option><option value=\"MATH\" >MATH</option> </select> <input type=\"text\" name=\"number\" onblur=\"validateCourseNumber(this, 'numberError')\" size=\"5\" value=\" \" /><input type=\"text\" name=\"info\" size=\"45\" value=\"\" />  <button onclick=\"removeReq(this)\">Remove</button><br></div>";
    }
    else 
    {
        obj.innerHTML = obj.innerHTML + "<div><br><select name=\"co\"> <option value=\"NONE\" selected>NONE</option> <option value=\"CSC\">CSC</option><option value=\"MATH\" >MATH</option> </select> <input type=\"text\" name=\"number\" onblur=\"validateCourseNumber(this, 'numberError')\" size=\"5\" value=\" \" /><input type=\"text\" name=\"info\" size=\"45\" value=\"\" /> <button onclick=\"removeReq(this)\">Remove</button><br></div>";
    }

}

function removeReq ( elem )
{
    elem.parentNode.parentNode.removeChild(elem.parentNode);
}

function validateName(elem, error)
{
   var obj = document.getElementById(error);

   if(elem.value == "")
   {
     obj.innerHTML = "* You need to provide a course name";
     obj.style.visibility = "visible";
   }
   else
   {
     obj.style.visibility = "hidden";
   }
}

function validateCourseNumber(elem, error)
{
   var obj = document.getElementById(error);
   var isnum = /^[0-9L]+$/.test(elem.value);
   var number = parseInt(elem.value);

   if(elem.value == "")
   {
     obj.innerHTML = "* Course number cannot be empty";
     obj.style.visibility = "visible";
   }
   else if(!isnum)
   {
     obj.innerHTML = "* Course number can only contain digits 0-9";
     obj.style.visibility = "visible";
   }
   else if(number < 1 || number > 999)
   {
     obj.innerHTML = "* Course number must be lower than 1000";
     obj.style.visibility = "visible";
   }
   else
   {
     obj.style.visibility = "hidden";
   }
}

function validateCredits(elem, error)
{
   var obj = document.getElementById(error);

   if(elem.value == "")
   {
     obj.innerHTML = "* You need to provide the number of credits";
     obj.style.visibility = "visible";
   }
   else
   {
     obj.style.visibility = "hidden";
   }
}

