<template>
  <div>
    <form-auth v-if="!$auth.loggedIn" />
    <div v-else>
      <ul class="nav mt-3 mb-5 nav-tabs justify-content-center justify-content-md-start">
        <b-nav-item v-for="item in items" :key="item.to" :to="{name: item.to}">
          {{ item.title }}
        </b-nav-item>
      </ul>
      <div class="mt-3">
        <p v-if="$route.name == 'admin'" class="text-center">
          This is admins-only section. Please, select any menu item above.
        </p>
        <nuxt-child />
      </div>
    </div>
  </div>
</template>

<script>
import FormAuth from '../components/form-auth'

export default {
  auth: false,
  validate(app) {
    return !app.$auth.loggedIn || app.$auth.hasScope('users') || app.$auth.hasScope('users/get')
  },
  components: {FormAuth},
  data() {
    const items = []

    if (this.$auth.hasScope('users') || this.$auth.hasScope('users/get')) {
      items.push({to: 'admin-users', title: 'Users'})
      items.push({to: 'admin-user-roles', title: 'User Roles'})
    }

    return {
      loading: false,
      form: {
        username: null,
        password: null,
      },
      items,
    }
  },
  created() {
    if (this.$route.name === 'admin' && this.items.length) {
      this.$router.replace({name: this.items[0].to})
    }
  },
}
</script>
