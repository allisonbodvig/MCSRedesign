
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

