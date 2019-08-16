<script>
    import { Bar } from 'vue-chartjs'
    import { mapState } from 'vuex'

    export default {
        name: "SelectResultChart",
        extends: Bar,
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
                'selectResult'
            ]),
        },

        mounted: function() {
            // console.log(this.selectResult.hai)
            // this.renderChart(this.chartData, this.options)
            this.renderChart(
                {
                    labels: this.selectResult.hai,
                    datasets: [{
                        label: 'sample',
                        backgroundColor: ['rgba(255, 20, 20, 0.3)', '#f87979'],
                        data: this.selectResult.count
                    }],
                    options: {
                        title: {
                            display: true,
                            text: 'Bar chart'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                }
                            }]
                        }
                    }
                }
            )
        }
    }
</script>

<style scoped>

</style>
