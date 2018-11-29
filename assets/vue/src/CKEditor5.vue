<template>
     <div class="container">
       <header>
         <h1 v-on:click="changeDisplayingOfPostView">ArchCMS</h1>
       </header>
        <div class="editor" :style="{width: styles.editorWidth}">
          <vue-ckeditor :config="editorConfig" type="classic" v-model="htmlContent"></vue-ckeditor><br /><br />
        </div>
          <div :style="{width: styles.postViewWidth, display: styles.postViewDisplay}" class="rawHTML" v-html="htmlContent"></div><br /><br />

          <div class="postAttr" :style="{width: styles.postAttrWidth}">
            <img :src="postImg.src" id="postImg" alt="Main image of this post">
            <input :accept="postImg.accept" :type="postImg.type" :name="postImg.name" :id="postImg.inputId">
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
              <div v-for="item in posts" :key="item.id">
                <button v-text="item.title" :value="item.id" v-on:click="getPostToEdit(item.id)"></button>
                <span v-text="item.time" />
            </div>
            <button v-on:click="getEditorContent">Show the fucking code</button>
          </div>

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
      styles: {
        editorWidth: '40%',
        postViewWidth: '40%',
        postAttrWidth: '20%',
        postViewDisplay: 'initial'
      },
      postImg: {
        inputId: "postImg", 
        title: "Post Image", 
        type: "file", 
        name: "postImg",  
        src: '',
        accept: "image/png, image/jpeg"
      },
      posts: '',
      
      instance: null,
      htmlContent: content,
      editorConfig: {
          toolbar: ['heading',
      '|',
      'fontSize', 
      'fontFamily', 
      '|',
      'bold', 
      'italic', 
      'underline', 
      'strikethrough',
      'code',
      'highlight', 
      '|',
      'alignment', 
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

          axios
            .post("api/cms", qs.stringify({data: postData}))
            .then(response => console.log(response))
            .catch(error => console.log(error))

      }
      else alert("Wypełnij wszystkie pola... debilu")
    },
    changeDisplayingOfPostView: function(){
      this.displayPostView == true ? this.displayPostView = false : this.displayPostView = true;
      this.styles.editorWidth == '40%' ? this.styles.editorWidth = '70%' : this.styles.editorWidth = '40%';
      this.styles.postAttrWidth == '20%' ? this.styles.postAttrWidth = '30%' : this.styles.postAttrWidth = '20%';
      this.styles.postViewWidth == '40%' ? this.styles.postViewWidth = '0%' : this.styles.postViewWidth = '40%';
      this.styles.postViewDisplay == 'initial' ? this.styles.postViewDisplay = 'none' : this.styles.postViewDisplay = 'initial';
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
        })
      .catch(error => console.log(error))
    },
    getEditorContent: function(){
      alert(this.htmlContent)//+"<br />"+"P.S Chuj Ci w dupę Oskarku. Twój CKEditor5 :)")
    }
  }
}

</script>
