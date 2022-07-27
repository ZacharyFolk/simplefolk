////////////////////////////////////
//                                //
//    Light Dark Mode switcher    //
//                                //
////////////////////////////////////
/* Observes click of checkbox label and adds/removes a body class and cookie */

document.addEventListener('DOMContentLoaded', function () {
  const modebutton = document.querySelector('.mode-button');
  const modetoggle = document.getElementById('mode-toggle');

  if (modetoggle) {
    modebutton.addEventListener('click', function (event) {
      switchModes();
    });
  }
  function switchModes() {
    modetoggle.addEventListener('change', (e) => {
      if (e.target.checked === true) {
        document.body.classList.add('lightmode');
        document.cookie = `mode=light; path=/; max-age=${60 * 60 * 24 * 14};`;
      }
      if (e.target.checked === false) {
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
  function getCookie(name) {
    let value = `; ${document.cookie}`;
    let parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
  }

  // load this early?
  function cookieCheck() {
    let mode = getCookie('mode');
    if (mode == 'light') {
      modetoggle.checked = true;
      document.body.classList.add('lightmode');
    }
  }

  cookieCheck();
});
