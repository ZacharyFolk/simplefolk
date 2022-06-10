////////////////////////////////////
//                                //
//    Light Dark Mode switcher    //
//                                //
////////////////////////////////////
/* Observes click of checkbox label and adds/removes a body class and cookie */

document.addEventListener("DOMContentLoaded", function() {

const modebutton = document.querySelector('.mode-button');
const modetoggle = document.getElementById('mode-toggle');

if(modetoggle){
    modebutton.addEventListener('click', function(event) {
    switchModes();
});
}
function switchModes(){

    console.log('click');
    modetoggle.addEventListener('change', e => {
      if(e.target.checked === true) {
          document.body.classList.add('lightmode');
          document.cookie = `mode=light; path=/; max-age=${60 * 60 * 24 * 14};`;
         
          console.log("Checkbox is checked - boolean value: ", e.target.checked)
      }
    if(e.target.checked === false) {
        document.body.classList.remove('lightmode');
        document.cookie = `mode=dark; path=/; max-age=${60 * 60 * 24 * 14};`;
        modetoggle.checked = false;
    }
 
    });
}

/**
 * Get the value of a cookie
 * Source: https://gist.github.com/wpsmith/6cf23551dd140fb72ae7
 * @param  {String} name  The name of the cookie
 * @return {String}       The cookie value
 */
 function getCookie (name) {
	let value = `; ${document.cookie}`;
	let parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}


// load this early? 
function cookieCheck(){
    let mode = getCookie('mode');
    if (mode == 'light'){
        modetoggle.checked = true;
        document.body.classList.add('lightmode');
        console.log('lights on');
    } else {
      
        console.log('lights off');
    }
}

cookieCheck();
});


// jQuery(function($) {
//     //Create the cookie object
//     var cookieStorage = {
//         setCookie: function setCookie(key, value, time, path) {
//             var expires = new Date();
//             expires.setTime(expires.getTime() + time);
//             var pathValue = '';
//             if (typeof path !== 'undefined') {
//                 pathValue = 'path=' + path + ';';
//             }
//             document.cookie = key + '=' + value + ';' + pathValue + 'expires=' + expires.toUTCString();
//         },
//         getCookie: function getCookie(key) {
//             var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
//             return keyValue ? keyValue[2] : null;
//         },
//         removeCookie: function removeCookie(key) {
//             document.cookie = key + '=; Max-Age=0; path=/';
//         }
//     };

//     //Click on dark mode icon. Add dark mode classes and wrappers. Store user preference through sessions
//     $('.wpnm-button').click(function() {
//         //Show either moon or sun
//         $('.wpnm-button').toggleClass('active');
//         //If dark mode is selected
//         if ($('.wpnm-button').hasClass('active')) {
//             //Add dark mode class to the body
//             $('body').addClass('dark-mode');
//             cookieStorage.setCookie('yonkovNightMode', 'true', 2628000000, '/');
//         } else {
//             $('body').removeClass('dark-mode');
//             setTimeout(function() {
//                 cookieStorage.removeCookie('yonkovNightMode');
//             }, 100);
//         }
//     })

//     //Check Storage. Display user preference 
//     if (cookieStorage.getCookie('yonkovNightMode')) {
//         $('body').addClass('dark-mode');
//         $('.wpnm-button').addClass('active');
//     }
// })