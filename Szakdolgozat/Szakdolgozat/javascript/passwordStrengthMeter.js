
/*
	version: 1.0.0
	date: 2018.01.22.
	author: Hegedűs Viktor
*/


var shortPass = 'Minimum 8 karakter'
var shortPassColor = shortPass.fontcolor("red")
var longPass = 'Maximum 32 karakter'
var longPassColor = longPass.fontcolor("red")
var badPass = 'Gyenge jelszó'
var badPassColor = badPass.fontcolor("red")
var goodPass = 'Közepes jelszó'
var goodPassColor = goodPass.fontcolor("yellow")
var strongPass = 'Jó jelszó'
var strongPassColor = strongPass.fontcolor("yellow")
var vstrongPass = 'Erős jelszó'
var vstrongPassColor = vstrongPass.fontcolor("green")
var estrongPass = 'Nagyon erős jelszó'
var estrongPassColor = estrongPass.fontcolor("green")
var sameAsUsername = 'Ugyanaz, mint a felhasználónév!'
var sameAsUsernameColor = sameAsUsername.fontcolor("red")

function passwordStrength(password,username)
{
    score = 0 
	
    //password < 8
    if (password.length < 8 ) { return shortPassColor }
	
	//password > 32
	if (password.length > 32 ) { 
		return longPassColor
	}
    //password == username
    if (password.toLowerCase() == username.toLowerCase()) return sameAsUsernameColor
	
    //password length
    score += password.length * 4
    score += ( checkRepetition(1,password).length - password.length ) * 1
    score += ( checkRepetition(2,password).length - password.length ) * 1
    score += ( checkRepetition(3,password).length - password.length ) * 1
    score += ( checkRepetition(4,password).length - password.length ) * 1

    //password has 3 numbers
    if (password.match(/(.*[0-9].*[0-9].*[0-9])/))  score += 3
    
    //password has 2 sybols
    if (password.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) score += 3
    
    //password has Upper and Lower chars
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  score += 6
    
    //password has number and chars
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  score += 6
    //
    //password has number and symbol
    if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && password.match(/([0-9])/))  score += 6
    
    //password has char and symbol
    if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && password.match(/([a-zA-Z])/))  score += 6
    
    //password is just a nubers or chars
    if (password.match(/^\w+$/) || password.match(/^\d+$/) )  score -= 10 
    
    //verifing 0 < score < 100
    if ( score < 0 )  score = 0 
    if ( score > 100 )  score = 100 
    
    if (score < 34 )  return badPassColor
    if (score < 68 )  return goodPassColor
	if (score < 85 )  return strongPassColor
	if (score < 95 )  return vstrongPassColor
	
    return estrongPassColor
}



function passwordStrengthPercent(password,username)
{
    score = 0 
    
    //password < 4
    if (password.length < 8 ) { return 0 }
    
	
	if (password.length > 32 ) { 
		return 0
	}
	
    //password == username
    if (password.toLowerCase()== username.toLowerCase()) return 0
    
    //password length
    score += password.length * 4
    score += ( checkRepetition(1,password).length - password.length ) * 1
    score += ( checkRepetition(2,password).length - password.length ) * 1
    score += ( checkRepetition(3,password).length - password.length ) * 1
    score += ( checkRepetition(4,password).length - password.length ) * 1

    //password has 3 numbers
    if (password.match(/(.*[0-9].*[0-9].*[0-9])/))  score += 3
    
    //password has 2 sybols
    if (password.match(/(.*[!,@,#,$,%,^,&,*,?,_,~,<,>].*[!,@,#,$,%,^,&,*,?,_,~,<,>])/)) score += 3
    
    //password has Upper and Lower chars
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  score += 6
    
    //password has number and chars
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  score += 6
    //
    //password has number and symbol
    if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && password.match(/([0-9])/))  score += 6
    
    //password has char and symbol
    if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && password.match(/([a-zA-Z])/))  score += 6
    
    //password is just a nubers or chars
    if (password.match(/^\w+$/) || password.match(/^\d+$/) )  score -= 10
	
	
    if (score > 100) return 100
  return (score)
 
}

// checkRepetition(1,'aaaaaaabcbc')   = 'abcbc'
// checkRepetition(2,'aaaaaaabcbc')   = 'aabc'
// checkRepetition(2,'aaaaaaabcdbcd') = 'aabcd'

function checkRepetition(pLen,str) {
    res = ""
    for ( i=0; i<str.length ; i++ ) {
        repeated=true
        for (j=0;j < pLen && (j+i+pLen) < str.length;j++)
            repeated=repeated && (str.charAt(j+i)==str.charAt(j+i+pLen))
        if (j<pLen) repeated=false
        if (repeated) {
            i+=pLen-1
            repeated=false
        }
        else {
            res+=str.charAt(i)
        }
    }
    return res
}


jQuery(document).ready(function()
{
  var bpos = "";
  var perc = 0 ;
  var minperc = 0 ;
  $('#password').css( {backgroundPosition: "0 0"} );
  $('#username').keyup(function(){
		$('#result').html(passwordStrength($('#password').val(),$('#username').val())) ;
		perc = passwordStrengthPercent($('#password').val(),$('#username').val());

		bpos=" $('#colorbar').css( {backgroundPosition: \"0px -" ;
		bpos = bpos + perc + "px";
		bpos = bpos + "\" } );";
		bpos=bpos +" $('#colorbar').css( {width: \"" ;
		bpos = bpos + (perc * 2) + "px";
		bpos = bpos + "\" } );";
		eval(bpos);
	    	$('#percent').html(" " + perc  + "% ");
	              })
  $('#password').keyup(function(){
		$('#result').html(passwordStrength($('#password').val(),$('#username').val())) ; 
		perc = passwordStrengthPercent($('#password').val(),$('#username').val());
		
		bpos=" $('#colorbar').css( {backgroundPosition: \"10px -" ;
		bpos = bpos + perc + "px";
		bpos = bpos + "\" } );";
		bpos=bpos +" $('#colorbar').css( {width: \"" ;
		bpos = bpos + (perc * 3.9) + "px";
		bpos = bpos + "\" } );";
		eval(bpos);
	    	$('#percent').html(" " + perc  + "% ");
  })
})