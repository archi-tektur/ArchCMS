import Vue from 'vue'
import CKEditor5 from './CKEditor5.vue' //FILE 1
import ArchCMSPanel from './cmspanel.vue' //FILE 2
import router from './router' //FILE 2
import Imgur from './imgur.js'

// FILE 1

new Vue({
  el: '#vue-ckeditor',
  render: h => h(CKEditor5)
})

// FILE 2

new Vue(
  {
    el: '#vue-panel-archcms',
    router,
    render: h => h(ArchCMSPanel)
  }
)

var feedback = function(res) {
  if (res.success === true) {
      var get_link = res.data.link.replace(/^http:\/\//i, 'https://');
      document.querySelector('.status').classList.add('bg-success');
      document.querySelector('.status').innerHTML =
          'Image : ' + '<br><input class="image-url" id="image-url" value=\"' + get_link + '\"/>' + '<img class="img" alt="Imgur-Upload" src=\"' + get_link + '\"/>';
  }
};

new Imgur({
  clientid: 'd73fe71adee9c50', //You can change this ClientID
  callback: feedback
});