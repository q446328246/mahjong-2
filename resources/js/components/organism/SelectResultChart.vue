<script>
    import { Bar } from 'vue-chartjs'
    import { mapState } from 'vuex'

    export default {
        name: "SelectResultChart",
        extends: Bar,
        mounted() {
            this.renderBarChart()
        },
        // data() {
        //     return {
        //         chartData: {
        //             labels: this.selectResult.hai,
        //             datasets: [{
        //                 label: 'sample',
        //                 backgroundColor:['rgba(255, 20, 20, 0.3)','#f87979'],
        //                 data: this.selectResult.count
        //             }]
        //         },
        //         options: {
        //             title: {
        //                 display: true,
        //                 text: 'Bar chart'
        //             },
        //             scales: {
        //                 yAxes: [{
        //                     ticks: {
        //                         beginAtZero: true,
        //                     }
        //                 }]
        //             }
        //         }
        //     }
        // },

        computed: {
            ...mapState('Select', [
                'selectResultChart'
            ]),

        },

        methods:　{
            renderBarChart() {
                this.renderChart(
                    {
                        labels: this.selectResultChart.Hais,
                        datasets: [{
                            label: 'sample',
                            backgroundColor: ['rgba(255, 20, 20, 0.3)', '#f87979'],
                            data: this.selectResultChart.Counts
                        }],
                    },
                    {
                        scales: { //軸の設定
                            yAxes: [{ //Y軸の設定
                                ticks: { //目盛りの設定
                                    beginAtZero: true, //開始値を0
                                },
                                scaleLabel: {
                                    display: true, //Y軸ラベルの表示
                                }
                            }]
                        },
                    }
                )
            }
        },
    }
</script>

<style scoped>

</style>
