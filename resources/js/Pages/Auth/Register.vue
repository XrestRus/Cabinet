<template>
<form @submit.prevent="submit" action="" class="form">
    <span class="form-title">Регистрация</span>
    <div class="form-box">
        <label for="email" class="form-label">Email</label>
        <div class="form-input-wrap">
            <div class="icon svg-big svg-registration"></div>
            <input type="text" id="email" name="email" v-model="form.email" autocomplete="on" required class="form-input">
        </div>
        <span v-if="errors.email" class="error">{{ errors.email }}</span>
    </div>
    <div class="form-box">
        <label for="password" class="form-label">Password</label>
        <div class="form-input-wrap">
            <div class="icon svg-big svg-login"></div>
            <input type="password" id="password" name="password" v-model="form.password" autocomplete="on" required class="form-input">
        </div>
        <span v-if="errors.password" class="error">{{ errors.password }}</span>
    </div>
    <div class="form-box">
        <label for="surname" class="form-label">Surname</label>
        <div class="form-input-wrap">
            <div class="icon svg-big svg-registration"></div>
            <input type="text" id="surname" name="surname" v-model="form.surname" autocomplete="on" required class="form-input">
        </div>
        <span v-if="errors.surname" class="error">{{ errors.surname }}</span>
    </div>
    <div class="form-box">
        <label for="name" class="form-label">Name</label>
        <div class="form-input-wrap">
            <div class="icon svg-big svg-login"></div>
            <input type="text" id="name" name="name" v-model="form.name" autocomplete="on" required class="form-input">
        </div>
        <span v-if="errors.name" class="error">{{ errors.name }}</span>
    </div>
       <div class="form-box">
        <label for="patronymic" class="form-label">Patronymic</label>
        <div class="form-input-wrap">
            <div class="icon svg-big svg-registration"></div>
            <input type="text" id="patronymic" name="patronymic" v-model="form.patronymic" autocomplete="on" required  class="form-input">
        </div>
        <span v-if="errors.patronymic" class="error">{{ errors.patronymic }}</span>
    </div>

    <inertia-link :href="route('login')" class="form-link"><span>Хотите войти?</span></inertia-link>

    <button type="submit" class="form-button">Регистрация</button>
</form>
</template>

<script>
import AuthLayout from "@/Layouts/AuthLayout"

export default {

layout: AuthLayout,

components: {
    AuthLayout
},

props: {
    errors: Object
},

data() {
    return {
        form: this.$inertia.form({
            email: "",
            password: "",
            surname: "",
            name: "",
            patronymic: "",
        })
    }
},

methods: {
    submit() {
        this.form.post(this.route("register"));
    }
}

}
</script>

<style lang='scss' scoped>

</style>