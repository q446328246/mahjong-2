export const state  = () => ({
    question_id: 0,
    status: 0, // 0→回答選択、1→解答ページ、2→結果ページへ
    questions: [],
    ans_cnt: [],
    selectQuestion: '',
    selectResults: [],
    selectQuestionDetail: '',
})

// mutations
export const mutations = {
    setSelectQuestionId (state, question_id) {
        state.question_id = question_id
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
    setAnswerCnt (state, ans_cnt){
        state.ans_cnt = ans_cnt
    },
    setSelectQuestion (state, Question){
        state.selectQuestion = Question
    },
    setSelectResults (state, Results){
        state.selectResults = Results
    },
    setSelectQuestionDetail (state, QuestionDetail){
        state.selectQuestionDetail = QuestionDetail
    },
}

// actions
export const actions = {
    async getSelectTopQuestions({ commit }) {
        await axios.get('/get_select_questions').then(function(response) {
            if (Array.isArray(response.data)) {
                // 正常
                let SelectTileQuestions = response.data
                let questions = []
                let answer_cnt = []

                // apiで取得したデータをquestionと問題に対するresultに分けて、それぞれの配列を作成し、stateへ
                for (var i = 0; i < Object.keys(SelectTileQuestions).length; i++) {
                    questions.push(SelectTileQuestions[i].question.Question)
                    answer_cnt.push(SelectTileQuestions[i].question.ans_cnt)
                }

                commit('setQuestions',  questions)
                commit('setAnswerCnt',  answer_cnt)
            } else {
                // URLパラメータエラー
                commit('setError', response.data)
                router.push({name: 'Top'})
            }
        }.bind(this))
        .catch(function (error) {
            // 異常
            console.log('ERROR!! occurred in Backend.')
            console.log(error)
        }.bind(this))
    },

    async letsSelectTiles({ commit,state }, payload) {
        commit('setSelectQuestionId', payload)
        
        for (var i = 0; i < state.questions.length; i++) {
            if (state.questions[i].id === payload) {
                commit('setSelectQuestion', state.questions[i])
                commit('setSelectResults', state.questions[i].select_tile_results)
                break
            }
        }

        await axios.get('/get_select_question_detail/' + state.question_id).then(function(response) {
            if (Array.isArray(response.data)) {
                // 正常
                commit('setSelectQuestionDetail',  response.data[0])
            } else {
                // URLパラメータエラー
                commit('setError', response.data)
                router.push({name: 'Top'})
            }
        }.bind(this))
            .catch(function (error) {
                // 異常
                console.log('ERROR!! occurred in Backend.')
                console.log(error)
            }.bind(this))

        router.push({name: 'Select', params: {id: payload}})
    },

    async setSelectQuestionAndResults({ commit,state }, payload) {
        await axios.get('/get_wining_qa/' + state.level).then(function(response) {

            if (Array.isArray(response.data)) {
                // 正常
                let QA = response.data
                let questions = []
                let answers = []

                // apiで取得したデータをquestionと問題に対するanswerに分けて、それぞれの配列を作成し、stateへ
                for (var i = 0; i < Object.keys(QA).length; i++) {
                    var tmp_ans = []
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
                // URLパラメータエラー
                commit('setError', response.data)
                router.push({name: 'Top'})
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
        router.push({name: 'Wining_Result'})
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
    }
}


// getters
export const getters = {
    splitTiles: state => key =>  {
        if (eval('state.selectQuestionDetail.' + key) !== null) {
            return eval('state.selectQuestionDetail.' + key).split('.')
        }
    },

    // splitTehaiTiles: (state, getters) => key =>  {
    //     let arrTiles = getters.splitTiles('tehai')
    //     let tumo_hai = arrTiles[arrTiles.length-1].split(' ')
    //     console.log(tumo_hai[1])
    //     console.log(arrTiles)
    //     let tehai_tiles = arrTiles.push(tumo_hai[1])
    //
    //     console.log(tehai_tiles)
    //
    //     return tehai_tiles
    //
    // },

    getPlaceAndStation(state)  {
        if (state.selectQuestionDetail !== undefined && state.selectQuestionDetail !== '') {
            let place = ''
            if (state.selectQuestionDetail.place === 'ton') {
                place = '東'
            } else if (state.selectQuestionDetail.place === 'nan') {
                place = '南'
            } else if (state.selectQuestionDetail.place === 'sya') {
                place = '西'
            } else if (state.selectQuestionDetail.place === 'pei') {
                place = '北'
            } else {
                place = state.selectQuestionDetail.place
            }

            let arrStation = state.selectQuestionDetail.stations.split('.')

            return place + arrStation[0] + '局' + arrStation[1] + '本場'
        }

    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
