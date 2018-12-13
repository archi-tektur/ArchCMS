<template>
    <section>
        <h2>Hello!</h2>
        <article>
            <p>You are using ArchCMS {{ cmsVersion }}. Have fun, and make your dream site.</p>
        </article>
        <article class="flex-div">
            <div v-for="item in whyCms" :key="item.id"
                :class="item.className" class="flex-div_item">
                <h3 v-text="item.header"></h3>
                <ul>
                    <li v-for="itemA in item.array" :key="itemA.id" v-text="itemA.content"></li>    
                </ul>    
            </div>
        </article>
    </section>
</template>

<script>
export default {
    name: 'start',
    data(){
        return {
            cmsVersion: '1.0.0',
            whyCms: [
                {id: 0, className: 'why-cms', header: "Why ArchCMS?", array: [
                    {id: 0, content: "Minimum content, Maximum possibilities"},
                    {id: 1, content: "Adding what you want"},
                    {id: 2, content: "Generating the lightest websites"},
                    {id: 3, content: "Step by step documentation"},
                    {id: 4, content: "Authors always can help you with all your problems"}
                ]},
                {id: 1, className: 'changeLog', header: "Change Log", array: [
                    {id: 0, content: "1.0.0 - First version of CMS"},
                    {id: 1, content: "2.0.0 - Many, many more bugs added"}
                ]} 
            ]
        }
    }
}
</script>

