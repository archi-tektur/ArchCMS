<template>
     <div class="container">
       <header class="editor-cms-header">
         <h1>ArchCMS</h1>
       </header>
        <main class="editor-cms-main">
          <div class="editor">
          <vue-ckeditor :config="editorConfig" type="classic" v-model="htmlContent"></vue-ckeditor>
          <div class="rawHTML" v-html="htmlContent"></div>
        </div>
        <div class="editor-cms-main_aside-bar">
          <div class="postAttr">
            <h2>Post Attributes</h2>
             <div class="dropzone">
                <div class="info"></div>
            </div>
            <p v-for="item in postAttr" v-bind:key="item.id">
              <label>{{item.title}}:<br /> 
                <input :id="item.inputId" :type="item.type" :name="item.name" v-bind:placeholder="item.placeholder" v-model="item.content" />
                <p v-if="item.content != ''">{{item.content}}</p>
                <p v-else>{{item.alertmsg}}</p>
              </label>
            </p>
            <button type="submit" v-on:click="sendPost">Send</button>
            
          </div>
            <div class="editPost">
              <h2>Post Managening</h2>
              <button v-on:click="newPost">New Post</button>
              <div v-for="item in posts" :key="item.id">
                <button v-text="item.title" :value="item.id" v-on:click="getPostToEdit(item.id)"></button>
                <span v-text="item.time" />
            </div>
            <button v-on:click="getEditorContent">Show the fucking code</button>
          </div>
        </div>
          
        </main>
          

        </div>
</template>

<style>

</style>


<script>
import Vue from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import VueCkeditor from 'vue-ckeditor5'
import axios from 'axios'
import qs from 'qs'

var content = ``;

Vue.use(VueCkeditor.plugin, {
  editors: {
    'classic': ClassicEditor,
  }
})

    export default {
  name: 'Ckeditor',
  data: function () {
    return {
      postAttr: [
        {id: 0, inputId: "title", title: "Title", type: "text", name: "title", placeholder: "Type a title", content: ""},
        {id: 1, inputId: "meta_tags", title: "Meta Tags", type: "text", name: "meta_tags", placeholder: "Type meta tags", content: ""}
      ],
      displayPostView: true,
      posts: '',
      
      instance: null,
      htmlContent: content,
      editorConfig: {
          toolbar: ['heading',
      '|',
      // 'fontSize', 
      // 'fontFamily', 
      // '|',
      'bold', 
      'italic', 
      // 'underline', 
      // 'strikethrough',
      // 'code',
      // 'highlight', 
      // '|',
      // 'alignment', 
      '|',
      'bulletedList', 
      'numberedList', 
      '|',
      'link',
      'blockQuote',
      'imageUpload',
      'insertTable',
      '|',
      'undo',
      'redo'],
        ckfinder: {
            uploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        },
        heading: {
                options: [
                    { model: 'paragraph', title: 'Akapit', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h2', title: 'Duży nagłówek', class: 'ck-heading_heading2' },
                    { model: 'heading2', view: 'h3', title: 'Średni nagłówek', class: 'ck-heading_heading3' },
                    { model: 'heading3', view: 'h4', title: 'Mały nagłówek', class: 'ck-heading_heading4' }
                ]
        },
        image: {
                styles: [
                    {name: 'full', icon: 'full'}, 
                    {name: 'alignCenter', icon: 'center'}, 
                    {name: 'alignLeft', icon: 'left'}, 
                    {name: 'side', icon: 'right'}
                ],
                toolbar: [ 'imageTextAlternative', '|',
                'imageStyle:full', 
                'imageStyle:alignLeft',
                'imageStyle:alignCenter',
                'imageStyle:side'
                ]
        }
          
        }
    }
  },
  props: ['value'],
  mounted(){
    axios
          .post("api/cms", qs.stringify({data: {operation: "get"}}))
          .then(response => {this.posts = JSON.parse( response.data )})
          .catch(error => console.log(error))
  },
  methods: {
    sendPost: function(){
      var checker = false
      for(let item of this.postAttr){
        if(item.content == ''){ checker = false; break;}
        else checker = true;
      }
      
      if(checker == true){
        var postData = {};
        for(let item of this.postAttr){
          postData[item.name] = item.content;
        }
        postData["editorContent"] = this.htmlContent;
        postData["operation"] = 'add';
        postData["imgSrc"] = document.getElementById("image-url").value;

          axios
            .post("api/cms", qs.stringify({data: postData}))
            .then(response => console.log(response))
            .catch(error => console.log(error))

      }
      
      else alert("Wypełnij wszystkie pola... debilu")
    },
    showImg: function(data){
      this.postImg.src = data.value;
    },
    getPostToEdit: function(id){
      var postData = {"operation": "getEdited", "id": id};
      axios
      .post("api/cms", qs.stringify({data: postData}))
      .then(response => {
        let post = JSON.parse(response.data);
        console.log(post[0].content);
        this.htmlContent = post[0].content;
        this.postAttr[0].content = post[0].title;
        this.postAttr[1].content = post[0].meta_tags;
        document.querySelector('.status').classList.add('bg-success');
        document.querySelector('.status').innerHTML =
        'Image : ' + '<br><input class="image-url" id="image-url" value=\"' + post[0].header_img + '\"/>' + '<img class="img" alt="Imgur-Upload" src=\"' + post[0].header_img + '\"/>';
        })
      .catch(error => console.log(error))
    },
    newPost: function(){
      this.htmlContent = '<p>&nbsp;</p>';
      this.postAttr[0].content = '';
      this.postAttr[1].content = '';
      document.querySelector('.status').classList.remove('bg-success');
      document.querySelector('.status').innerHTML = '';
    },
    getEditorContent: function(){
      alert(this.htmlContent+"<br />"+"P.S Chuj Ci w dupę Oskarku. Twój CKEditor5 :)")
    }
  }
}

</script>
