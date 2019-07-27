<template>
    <div class="container">
        <h2>test</h2>
        <div class="row">

            <div class="col-md6 col-sm-6 col-xs-12 offset-3">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bookmarks</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mx-auto">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa fa-star-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">93,139</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-3">
                <p>家賃を入力してください</p>
                <input type="number" v-model="house_rent">
            </div>

            <div class="col-6 offset-3">
                <p>敷金</p>
                <select v-model="deposit_seledted">
                    <option disabled value="" selected>〇か月分</option>
                    <option v-for="(month, index) in months" :key="index" v-bind:value="index">{{ month }}</option>
                </select>
                <!--input v-model="deposit" placeholder="を入力" value=""-->
                <div>{{ depositVal }}</div>
            </div>

            <div class="col-6 offset-3">
                <p>礼金</p>
                <select v-model="reward_selected">
                    <option disabled value="" selected>〇か月分</option>
                    <option v-for="(month, index) in months" :key="index" v-bind:value="index">{{ month }}</option>
                </select>
                <!-- input v-model="reward" placeholder="を入力" value=""-->
                <div>{{ rewardVal }}</div>
            </div>
        </div>
        <hr>

        <div style="margin-top: 20px">
            <p>前家賃:{{ house_rent }}</p>
        </div>
        <hr>

        <div style="margin-top: 20px">
            <p>仲介手数料</p>
            <input v-model="agent_charge">
        </div>
        <hr>

        <div style="margin-top: 20px">
            <p>火災保険</p>
            <input v-model="fire_insurance_fee">
        </div>
        <hr>

        <div style="margin-top: 20px">
            <p>鍵交換</p>
            <input v-model="key_change">
        </div>
        <hr>

        <div style="margin-top: 20px">
            <button @click="sum">合計</button>
            <p>{{ sumValue }}{{ zeikomi }}</p>
        </div>
    </div>
</template>

<style lang="scss">
</style>

<script>

    import 'es6-promise/auto'
    // import BootstrapVue from 'bootstrap-vue'
    import axios from 'axios';

    export default {
        data: function () {
            return {
                months: [],
                deposit: 0,
                reward: 0,
                house_rent: 0,
                deposit_seledted: "",
                reward_selected: "",
                agent_charge: 0,
                fire_insurance_fee: 8000,
                key_change: 35000,
                sumValue: 0,
                zeikomi: "",
            }
        },
        created: function () {
            axios.get('/api/house_rent.json').then(function(response) {
                this.months = response.data.month;
            }.bind(this))
            .catch(function(error) {
                this.message = 'ERROR!! occurred in Backend.';
                console.log('ERROR!! occurred in Backend.');
            }.bind(this));
        },
        computed: {
            depositVal: function() {
                return this.house_rent * this.deposit_seledted
            },
            rewardVal: function() {
                return this.house_rent * this.reward_selected
            },

        },
        methods: {
            sum: function() {
                if (this.house_rent != 0) {
                    var deposit = this.depositVal;
                    var reward = this.rewardVal;
                    var before_rent = parseInt(this.house_rent);
                    var agent = parseInt(this.agent_charge);
                    var fire_insurance = parseInt(this.fire_insurance_fee);
                    var key_change = parseInt(this.key_change);
                    this.sumValue = ((deposit + reward + before_rent + agent + fire_insurance + key_change) * 1.08).toLocaleString();
                    this.zeikomi = '(税込)';
                } else {
                    alert('家賃を入力してください');
                }
            }
        }
    }
</script>

