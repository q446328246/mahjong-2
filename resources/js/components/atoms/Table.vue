<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th v-for="(th, index) in ths">{{ th }}</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="(body, index) in bodies">
                <td>{{ question.title }}</td>
                <td>{{ ans_cnt[index] }}</td>
                <td>{{ question.created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "Table",
        props: ['ths', 'bodies'],
    }
</script>

<style scoped>

</style>
