<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <v-app-bar-title>Sis Cliente</v-app-bar-title>
      <v-spacer></v-spacer>
      <v-app-bar-nav-icon>
      <v-btn icon href="/logout"><v-icon>mdi-logout</v-icon></v-btn>
      </v-app-bar-nav-icon>
    </v-app-bar>

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
          <slot></slot>
      </v-container>
    </v-main>

    <v-footer app>
      <!-- -->
    </v-footer>
  </v-app>
</template>

<script>
export default {};
</script>

<style>
</style>