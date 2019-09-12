import axios from 'axios'
import router from '../../router'
import constant from '../../constants/constant'

export const state = {
    question_id: 0,
    questions: [],
    ans_cnt: [],
    selectQuestion: '',
    selectResults: [],
    selectQuestionDetail: '',
    ans_picked: '',
    selectResultChart: {
        'hai': [
            '1mnz', '3mnz','4mnz','ton'
        ],
        'count': [
            50,3,3,2
        ],
    },
    chart_render: false,
    selectResultComment :[],
    selectResultAnswers: [],
}

// mutations
const mutations = {
    setSelectQuestionId (state, question_id) {
        state.question_id = question_id
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
    setAnsPicked(state, pick_val) {
        state.ans_picked = pick_val
    },
    setSelectResultChart(state, ResultChart) {
        state.selectResultChart = ResultChart
    },
    setChartRender(state, bool) {
        state.chart_render = bool
    },
    setSelectResultAnswer(state, ResultAnswer) {
        state.selectResultAnswers = ResultAnswer
    },
}

// actions
const actions = {
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

    async answerAction ({ commit,state,dispatch,getters }, comment) {
        dispatch('clearSelected')
        if (state.ans_picked !== '') {
            let answer = '';
            // つも牌なら、tumo_tileデータをそのまま
            if (state.ans_picked === 14) {
                answer = state.selectQuestionDetail.tumo_tile
            } else {
                let tehai_tiles = getters.splitTiles('tehai')
                answer = tehai_tiles[state.ans_picked]
            }

            let data = {
                'question': state.selectQuestion,
                'answer': answer,
                'comment': comment
            }

            await axios.post('/post_select', data).then(function(response) {
                if (response.data !== false) {
                    let Hais = []
                    let Counts = []
                    let Answers = response.data

                    // グラフ生成に使用するhaiとcountを保持
                    for (let i = 0;i < Answers.length;i++) {
                        Hais.push(Answers[i].hai)
                        Counts.push(Answers[i].count)
                    }
                    commit('setSelectResultChart',  {Hais, Counts})
                    commit('setSelectResultAnswer',  response.data)
                    commit('setChartRender', true)
                } else {
                    alert('エラーが発生しました。再度、お試しください。')
                }

            }.bind(this))
            .catch(function (error) {
                // 異常
                console.log('ERROR!! post error.')
                console.log(error)
            }.bind(this))
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

    setPickedHaiComment ({ commit,state,dispatch }) {
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
}


// getters
const getters = {
    splitTiles: state => key =>  {
        if (eval('state.selectQuestionDetail.' + key) !== null) {
            return eval('state.selectQuestionDetail.' + key).split('.')
        }
    },

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
