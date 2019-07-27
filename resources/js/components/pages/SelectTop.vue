<template>
    <div>
        <Header text="どれを切る？"></Header>
        <div>
            問題を選択してください
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>問題</th>
                    <th>回答数</th>
                    <th>作成日</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(question, index) in questions">
                    <td><span class="text-primary title" @click="letsSelectTiles(question.id)">{{ question.title }}</span></td>
                    <td>{{ ans_cnt[index] }}</td>
                    <td>{{ question.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Header from '../molecules/header'
    import { mapActions,mapState } from 'vuex'

    export default {
        name: "SelectTop",
        components: {
            Header,
        },

        data: function() {
            return {
            }
        },

        async created() {
            await this.getSelectTopQuestions()
        },

        methods: {
            ...mapActions('Select', [
                'getSelectTopQuestions',
                'letsSelectTiles'
            ]),

        },

        computed: {
            ...mapState('Select', [
                'questions','ans_cnt'
            ])
        }
    }
</script>

<style scoped>
    .bg-green {
        background-color: greenyellow;
    }

    .title {
        cursor: pointer;
    }
</style>
