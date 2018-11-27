<template>
    <section>
        <h2>Info</h2>
            <p v-for="item in site" v-bind:key="item.id">
                <label :for="item.name" v-text="item.title"></label>
                <input type="text" :name="item.name" v-model="item.content" />
                {{item.content}}
            </p>
    </section>
</template>

<script>
export default {
    name: 'info',
    data(){
        return {
            site: [
                {id: 0, name: 'pageTitle', title: 'Page Title', content: 'ArchCMS Boilerplate'},
                {id: 1, name: 'pageEncoding', title: 'Page Encoding', content: 'UTF-8'},
                {id: 2, name: 'pageLanguage', title: 'Page Language', content: 'EN_en'},
                {id: 3, name: 'pageDescription', title: 'Page Description', content: 'Boilerplate of ArchCMS#1.0.0'},
                {id: 4, name: 'pageKeywords', title: 'Page Keywords', content: 'boilerplate archcms 1.0.0 archi-tektur mk archi_tektur'},
                {id: 5, name: 'pageAuthor', title: 'Page Author', content: 'archi-tektur Group'}
            ]
        }
    }
}
</script>

