<template>
<form @submit.prevent="submit" class="form">
    <span class="form-title">Вход в систему</span>
    <div class="form-box">
        <label for="email" class="form-label">Email</label>
        <div class="form-input-wrap">
            <div class="icon svg-big svg-registration"></div>
            <input type="text" id="email" name="email" v-model="form.email" required class="form-input">
        </div>
        <span v-if="errors.email" class="error">{{ errors.email }}</span>
    </div>
    <div class="form-box">
        <label for="password" class="form-label">Password</label>
        <div class="form-input-wrap">
            <div class="icon svg-big svg-login"></div>
            <input type="password" id="password" name="password" v-model="form.password" required class="form-input">
        </div>
        <span v-if="errors.password" class="error">{{ errors.password }}</span>
    </div>

    <div class="form-box">
        <label for="remember" class="form-label-checkbox">
            <span class="label-title-checkbox">Запомнить вас?</span>
            <input type="checkbox" id="remember" name="remember" v-model="form.remember" class="form-input">
        </label>
    </div>

    <!-- <inertia-link :href="route('register')" class="form-link"><span>Хотите зарегистрироваться?</span></inertia-link> -->

    <button type="submit" class="form-button">Войти</button>
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
            remember: false
        })
    }
},

methods: {
    submit() {
        this.form.post("login", this.form);
    }
}

}
</script>

<style lang='scss' scoped>

</style>
