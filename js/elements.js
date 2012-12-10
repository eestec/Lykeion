/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
	$("#messages_send_to").autocomplete("get_course_list.php", {
		width: 400,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#st_search_u").autocomplete("get_search_u.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});



	$("#st_search_country").autocomplete("get_search_country.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#st_search_city").autocomplete("get_search_city.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#country").autocomplete("get_search_country.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#city").autocomplete("get_search_city.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#company").autocomplete("get_search_company.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});



	$("#st_search_duration").autocomplete("get_search_duration.php", {
		width: 377,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#article_topic").autocomplete("get_search_article.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#job_country_t").autocomplete("get_search_country.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#job_city_t").autocomplete("get_search_city.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#job_company_t").autocomplete("get_search_company.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#st_search_academic").autocomplete("get_search_academic.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#stud_cv_Country").autocomplete("countries.php", {
		width: 272,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#users_Country").autocomplete("countries.php", {
		width: 377,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#un_Country").autocomplete("countries.php", {
		width: 377,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
         $("#cm_Country").autocomplete("countries.php", {
		width: 377,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});

$("#whati").click(function(e) {
        e.preventDefault();
        var loginBox = $("#what");
        loginBox.slideToggle("slow");
        
        
        
    });

function Export(format){
    
    jQuery.get("work.php?format="+format, function(info){
        jQuery("#nesto").html(info);

            });
}

function init() {

	calendar.set("published_start");
        calendar.set("published_end");
        calendar.set("stud_cv_Date_of_birth");


        }
		function errorhide(){
				$("#error_message").hide();
}
var hide=0;
function showhide(object,id){
    if(id==0 || id==-1){
        if(hide%2==0){;
            $("div#"+object).slideUp(function() {});hide++;
        }
        else {$("div#"+object).slideDown();hide++;}
    }
    else{
        if(object.search("work")!=-1){
            jQuery.get("elements.php?type=delete_work&br="+id, function(info){
                $("div#"+object).slideUp();
                var pic="pic"+object;
                $("#"+pic).slideUp();

            });
        }
        else if(object.search("education")!=-1){
            jQuery.get("elements.php?type=delete_education&br="+id, function(info){
                $("div#"+object).slideUp();
                var pic="pic"+object;
                $("#"+pic).slideUp();
            });
        }
        else if(object.search("language")!=-1){
            jQuery.get("elements.php?type=delete_language&br="+id, function(info){
                $("div#"+object).slideUp();
                var pic="pic"+object;
                $("#"+pic).slideUp();
            });
        }
    }
}
var im=0;
function ImportCV(){
    if(im==0){
        var file=document.createElement("input");
        file.setAttribute("type", "file");
        file.setAttribute("name", "xml_cv");
        file.setAttribute("id","xml_cv");
        var submit=document.createElement("input");
        submit.setAttribute("type", "submit");
        submit.setAttribute("name", "readxml");
        submit.setAttribute("value", "Submit");
        var text=document.createElement("span");
        text.innerHTML="Add XML CV file:";
        var upload=document.getElementById("xmlcv");
        upload.appendChild(text);
        upload.appendChild(file);
        upload.appendChild(submit);
        im++;
    }

}
function Show(type){
    var html1="<center><img src='images/loading29.gif' width='25'></center>";
//$("#load").slideUp();
        $("#load").slideDown('slow', function(){
            jQuery("#load").html(html1);
        });


        jQuery.get("wall.php?to="+type,function(info){
       jQuery("#place").html(info);
 


    });
    $("#load").slideUp();



}

function AddElement(type){
    //Create an input type dynamically.
    var br;
    if(type=="work") br=document.form.work_number.value;
    if(type=="education") br=document.form.education_number.value;
    if(type=="language") br=document.form.language_number.value;

    jQuery.get("elements.php?type="+type+"&br="+br, function(info){
    var element = document.createElement("div");
    var foo;
    //Assign different attributes to the element.
    if(type=="work"){
        foo = document.getElementById("new_work");
        element.innerHTML=info;
    }
    if(type=="education"){
        foo = document.getElementById("new_education");
        element.innerHTML=info;
    }
    if(type=="language"){
        foo = document.getElementById("new_language");
        element.innerHTML=info;
    }

    //Append the element in page (in span).
    foo.appendChild(element);
    //jQuery("#new_work").html(info);
  });
  br++;
  if(type=="work") document.form.work_number.value=br;
  if(type=="education") document.form.education_number.value=br;
  if(type=="language") document.form.language_number.value=br;

}

function AddtoFavorites(uid,pid,table){

    if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {

            	document.getElementById("nesto").innerHTML=xmlhttp.responseText;

            }
          }

        xmlhttp.open("GET","favorites.php?user_id="+uid+"&post_id="+pid+"&table="+table);
        xmlhttp.send();


}


