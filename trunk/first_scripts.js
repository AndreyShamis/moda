//################################################################
//##        Author Andrey Shamis
//##
//##        Script for brade system 2.3 version
//##
//##        Ajax , win functions , method get(with get function),
//##        timers.
//##
//##
//##        E-MAIL:     lolnik@gmail.com
//################################################################

//################################################################
//##
//################################################################
var reqTimeout;    // Timer for reguest
//################################################################
//##    var time_downloada = 90 ; // time_download * sec ; = 90 000
//##    var status_obj = document.getElementById("status");
//################################################################
function stat(n){
    switch (n) {
        case 0: return "Disabled";      break;
        case 1: return "Loading...";    break;
        case 2: return "Loaded";        break;
        case 3: return "In process..."; break;
        case 4: return "Ready";         break;
        default:return "Unknown status";
    }
}

function createRequest() {
print_status("Start",1);
    request = null;
    try {   request = new XMLHttpRequest();
    } catch (trymicrosoft) {
    try {   request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (othermicrosoft) {
    try {   request = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (failed) {
            request = null;
    } } }
    if (request == null) {alert("Error creating request object! ");}
	return request;
}

function post(url_need, span_need,post) {
    // post used for form and sending information
    var params = new Array();
        for (i=0;i<document.getElementById(post).elements.length;i++){
            var fieldNameVal = encodeURIComponent(document.getElementById(post).elements[i].name)+'='+
                                           encodeURIComponent(document.getElementById(post).elements[i].value);
            params[i] = fieldNameVal;
        }

    post = null;
    post = params.join('&');
    request = createRequest();
    try {
        request.open("POST", url_need, true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
        request.setRequestHeader("Content-Length", post.length);

		request.onreadystatechange  =
            function() {
		        try{
                    print_status(request.statusText + " - " + stat(request.readyState));
		        }catch(err){
                    print_status("Can`t get information " + err.description);
                }
		        if (request.readyState == 4) {
			        document.getElementById(span_need).innerHTML = request.responseText;
			        clearTimeout(reqTimeout);

		        }
		    }
        request.send(post);
		reqTimeout = setTimeout("request.abort();", 20000);
        setTimeout(
            function(){
                print_status(stat(request.readyState));
            }, 100);
    }
	catch (err) {
		document.getElementById(span_need).innerHTML = "URL:" + url_need + "\n<br />Error Desc: " + err.description + "\n";
	}
}

function get(url_need, span_need) {

    request = createRequest();
    try {
        request.open("GET", url_need, false);
		request.onreadystatechange  =
            function() {
		        try{
		    	    print_status("[" + request.statusText + "]:" + stat(request.readyState));
		        }catch(err){
                    print_status("Can`t get information " + err.description);
                }
		        if (request.readyState == 4) {
			        document.getElementById(span_need).innerHTML = request.responseText;
			        clearTimeout(reqTimeout);
		        }
		    }
        request.send(null);
		reqTimeout = setTimeout("request.abort();", 20000);
        setTimeout(
            function(){
                print_status(stat(request.readyState) + "<br />");
        }, 100);
    }
	catch (err) {
		document.getElementById(span_need).innerHTML = "URL:" + url_need + "\n<br />Error Desc: " + err.description + "\n";
	}
}
var Index_Span_Text = {
    Message: "",
    Print_Mess: function( ) {
        //this.result = this.Message;
        document.getElementById("big_win_span").innerHTML = this.Message;
    }
};

function Print_Index_Span_Text(str){

}

function enable_ajax(){

}
function desable_ajax(){

}

function update_value(id,w){
if(w == 1){
document.getElementById('ball'+ id).innerHTML = parseFloat(document.getElementById('ball'+ id).innerHTML) + 1;
}else{
document.getElementById('ball'+ id).innerHTML = parseFloat(document.getElementById('ball'+ id).innerHTML) - 1;
}
document.getElementById('up'+ id).enabled = false;
}

function print_status(err,ful){
	try{
    if(ful==1){
        document.getElementById("status").innerHTML = '<img src="media/round-progress-bar.gif" title="Loading" /><br />' + err;
    }else{
        document.getElementById("status").innerHTML = err + "<br />" + document.getElementById("status").innerHTML;
    }
	}
	catch(err){
	  //	alert (err.description);
      return 0;
	}
}