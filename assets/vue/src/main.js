import Vue from 'vue'
import CKEditor5 from './CKEditor5.vue' //FILE 1
import ArchCMSPanel from './cmspanel.vue' //FILE 2
import router from './router' //FILE 2

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