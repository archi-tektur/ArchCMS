<template>
    <section>
        <h2>Hello!</h2>
        <article>
            <p>You are using ArchCMS {{ cmsVersion }}. Have fun, and make your dream site.</p>
        </article>
    </section>
</template>

<script>
export default {
    name: 'start',
    data(){
        return {
            cmsVersion: '1.0.0'
        }
    }
}
</script>

