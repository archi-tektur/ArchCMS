<template>
    <div class="panel-cms-container">
        <header class="panel-cms-header">
            <h1 v-html="header_title"></h1>
            <div class="panel-cms-header_user">Unused</div>
            <nav><ul>
                <li v-for="item in header_navbar" v-bind:key="item.id" >
                <router-link
                    :to="item.path" 
                    v-html="item.text">
                </router-link> 
            </li>
            <li><a href="/editor">Posts</a></li>
            </ul></nav>
        </header>
        <main class="panel-cms-main">
            <router-view></router-view>
        </main>
        <aside class="panel-cms-aside">

        </aside>
        <footer class="panel-cms-footer">

        </footer>
    </div>
</template>

<script>
export default {
  name: 'panel-cms',
  data () {
    return {
      header_title: "ArchCMS",
      header_navbar: [
          {id: 0, text: "Hello", path: "/"},
          {id: 1, text: "Info", path: "/info"},
      ]
    }
  }
}
</script>
