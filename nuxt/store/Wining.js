import router from '../pages'

export const state  = () => ({
    level: 0,
    status: 0, // 0→回答選択、1→解答ページ、2→結果ページへ
    questions: [],
    answers: [],
    question_now_cnt: 1,
    question_amt: 3,
    correct: [],
    ans_num: [],
    ans_picked: 0,
    error: '',
    timer_flg: false,
    timerId: null,
    counter: '',
})

// mutations
export const mutations = {
    setLevel (state, level) {
        state.level = level
    },
    changeStatus (state) {
        if (state.status === 0) {
            if (state.question_amt !== state.question_now_cnt) {
                state.status = 1
            } else {
                state.status = 2
            }
        } else {
            state.status = 0
        }
    },
    setQuestions (state, questions) {
        state.questions = questions
    },
    incrimentQuestionCnt (state){
        state.question_now_cnt++
    },
    setQuestionAmt(state, n) {
        state.question_amt = n
    },
    setAnswerNum(state, ans_num) {
        state.ans_num.push(ans_num)
    },
    setCorrect(state) {
        state.correct.push(true)
    },
    setIncorrect(state) {
        state.correct.push(false)
    },
    setAnswers(state, answers) {
        state.answers = answers
    },
    setAnsPicked(state, pick_val) {
        state.ans_picked = pick_val
    },
    clearAnsPicked(state) {
        state.ans_picked = 0
    },
    setError(state, error) {
        state.error = error
    },
    setCounterTime(state, time) {
        state.counter = time
    },
    decrementCounter(state) {
        state.counter--
    },
    clearCounter(state) {
        state.counter = 0
        clearInterval(state.timerId)
    },
    initialState(state) {
            state.level = 0
            state.status =  0
            state.questions = []
            state.answers = []
            state.question_now_cnt = 1
            state.question_amt = 3
            state.correct = []
            state.ans_num = []
            state.ans_picked= 0
            state.timer_flg = false
            state.timerId = null
            state.counter = ''
    }

}

// getters
export const getters = {
    splitTiles(state) {
        if (state.questions.length > 0 && state.questions[state.question_now_cnt - 1] !== undefined) {
            return state.questions[state.question_now_cnt - 1].question.split('.')
        }
    },

    createAnswersTiles(state) {
        if (state.answers.length > 0 && state.answers[state.question_now_cnt - 1] !== undefined) {
            let answers =  state.answers[state.question_now_cnt - 1]
            let answers_tiles = []

            for (var i = 0; i < answers.length; i++) {
                answers_tiles.push(answers[i].answer.split('.'))
            }

            return answers_tiles
        }
    },

    getAllQuestionTiles(state) {
        let AllQuestions = []

        for (let i = 0; i < state.questions.length;i++) {
            AllQuestions.push(state.questions[i].question.split('.'))
        }

        return AllQuestions
    },

    getCorrectAmount(state) {
        let Corrects = state.correct.filter((v) => v)
        return Corrects.length
    },

    getCorrectWiningTiles(state) {
        let CorrectWiningTiles = []
        for (var i = 0; i < state.answers.length; i++) {
            for (var j = 0; j < state.answers[i].length; j++) {
                if (state.answers[i][j].correct === 1) {
                    CorrectWiningTiles.push(state.answers[i][j].answer.split('.'))
                }
            }
        }



        return CorrectWiningTiles
    }
}

// actions
export const actions = {
    letsWiningTile({ commit,state }, payload) {
        commit('setLevel', payload)
        this.$router.push({name: 'wining-id', params: {level: payload}})
    },

    async createWiningQuestions({ commit,state }, payload) {
         await this.$axios.$get(process.env.AXIOS_URL + '/get_wining_qa/' + state.level + '/' + state.question_amt).then(function(response) {
            if (Array.isArray(response)) {
                // 正常
                let QA = response
                let questions = []
                let answers = []

                // apiで取得したデータをquestionと問題に対するanswerに分けて、それぞれの配列を作成し、stateへ
                for (var i = 0; i < Object.keys(QA).length; i++) {
                    var tmp_ans = []
                    if (QA[i].answer  === "" || QA[i].answer  === null || QA[i].answer === undefined) {
                        continue
                    }
                    questions.push(QA[i].question)

                    for (var j = 0;j < Object.keys(QA[i].answer).length; j++) {
                        if (QA[i].question.question_key == QA[i].answer[j].question_key) {
                            // 問題に対する答えの番号を保持
                            if (QA[i].answer[j].correct === 1) commit('setAnswerNum', j+1)
                            tmp_ans.push(QA[i].answer[j])
                        }
                    }
                    answers.push(tmp_ans)
                }

                commit('setQuestions',  questions)
                commit('setAnswers',  answers)
            } else {
                console.log(response.data)
                // URLパラメータエラー
                commit('setError', response)
                this.$router.push({name: 'index'})
            }
        }.bind(this))
        .catch(function (error) {
            // 異常
            console.log('ERROR!! occurred in Backend.')
            console.log(error)
        }.bind(this))
    },

    setQuestionAmt({ commit, state }) {
        commit('setQuestionAmt', router.currentRoute.params.id)
    },

    pickedAns({ commit,state }, payload) {
        commit('setAnsPicked', payload)
    },

    answerAction ({ commit,state,dispatch }) {
        if (state.level === 2) {
            commit('clearCounter')
        }
        dispatch('clearSelected')
        let correct_flg = false
        if (state.ans_picked !== 0) {
            var Answers = state.answers[state.question_now_cnt - 1]
            for(var i = 0; i < Answers.length; i++) {
                if (i === state.ans_picked - 1) {
                    if (Answers[i].correct === 1) {
                        correct_flg = true
                        commit('setCorrect')
                    }

                    break
                }
            }

            if (!correct_flg) {
                commit('setIncorrect')
            }

            commit('changeStatus')
        } else {
            alert('選択されていません')
        }
    },

    clearSelected() {
        // 選択時の.selectedを消す
        var selected_element = $(".selected")
        selected_element.each(function () {
            $(this).removeClass("selected")
        })
    },

    setNextQuestion ({ commit,state,dispatch }) {
        commit('incrimentQuestionCnt')
        commit('changeStatus')
        commit('clearAnsPicked')
        if (state.level === 2) {
            dispatch('setTimer')
        }
    },

    moveResult () {
        this.$router.push({name: 'wining-result'})
    },

    setTimer({ commit,state,dispatch }) {
        if (state.level === 2) {
            commit('setCounterTime', 3)
        }
        state.timerId = setInterval(function () {
            commit('decrementCounter')

            // 時間切れ処理
            if (state.counter === 0) {
                alert('時間切れ')
                commit('setAnsPicked', 0)
                commit('setIncorrect')
                commit('changeStatus')
                commit('clearCounter')
                dispatch('clearSelected')
            }
        }, 1000)
    },

    destroyTimer({ commit,state }) {
        commit('clearCounter')
    },

    clearState({ commit,state }) {
        commit('initialState')
    }
}

// export default {
//     // state,
//     // getters,
//     actions,
//     mutations
// }
