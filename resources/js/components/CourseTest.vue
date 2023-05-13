<template>
    <div class="testing">
        <div class="testing-body">
            <div class="timer">
                <div class="title">
                    Сіз тест тапсырудасыз
                </div>
                <div class="text-time">
                    Қалған уақыт:
                    <span id="time" ref="time">00:00</span>
                </div>
            </div>

            <div class="course-questions-block">
                <div class="questions-block-left">
                    <div class="questions">
                        <div class="questions-item" v-show="current_question_number === (index +1)"
                             v-for="(user_answer,index) in test.user_answers">
                            <div class="question-text" v-html="user_answer.question.text"/>
                            <div class="answers">
                                <div class="answer-item"
                                     :class="{'answered': user_answer.answer_number && (user_answer.answer_number == 1)}"
                                     @click.prevent="selectAnswer(index, 1)">
                                    <div class="answer-var">
                                        A
                                    </div>
                                    <div class="answer-text" v-html="user_answer.question.answer_1"/>
                                </div>
                                <div class="answer-item"
                                     :class="{'answered': user_answer.answer_number && (user_answer.answer_number == 2)}"
                                     @click.prevent="selectAnswer(index, 2)">
                                    <div class="answer-var">
                                        B
                                    </div>
                                    <div class="answer-text" v-html="user_answer.question.answer_2"/>
                                </div>

                                <div class="answer-item"
                                     :class="{'answered': user_answer.answer_number && (user_answer.answer_number == 3)}"
                                     @click.prevent="selectAnswer(index, 3)">
                                    <div class="answer-var">
                                        C
                                    </div>
                                    <div class="answer-text" v-html="user_answer.question.answer_3"/>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="question-footer">
                        <div class="left" @click.prevent="prev()" :class="{'prev-next-btn-disabled': current_question_number === 1}">
                            <svg width="15" height="26" viewBox="0 0 15 26" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect x="15" y="2.66547" width="18" height="3"
                                      transform="rotate(135 15 2.66547)" fill="#C6711A"/>
                                <rect x="12.8789" y="26" width="18" height="3"
                                      transform="rotate(-135 12.8789 26)" fill="#C6711A"/>
                            </svg>
                        </div>

                        <div class="center">
                            <span id="current_question_number">{{ current_question_number }}</span>/
                            {{ test.user_answers.length }}
                        </div>
                        <div class="right" @click.prevent="next()" :class="{'prev-next-btn-disabled': current_question_number >= test.user_answers.length}">
                            <svg width="15" height="26" viewBox="0 0 15 26" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect y="23.3345" width="18" height="3" transform="rotate(-45 0 23.3345)"
                                      fill="#C6711A"/>
                                <rect x="2.12109" width="18" height="3" transform="rotate(45 2.12109 0)"
                                      fill="#C6711A"/>
                            </svg>
                        </div>
                    </div>
                </div>


                <div class="questions-block-right">
                    <div class="title">
                        Сұрақтар тізімі
                    </div>
                    <div class="answer-numbers">
                        <div class="answer-number"
                             @click.prevent="setCurrentQuestionNumber(index+1)"
                             :class="{'answered' : current_question_number === index+1 || user_answer.answer_number }"
                             v-for="(user_answer, index) in test.user_answers">{{ index + 1 }}
                        </div>
                    </div>
                    <button class="btn default-btn" @click.prevent="saveFinishTest">
                        Тестті аяқтау
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from  'axios'
export default {
    name: "CourseTest",
    props: [
        'test_data'
    ],
    data() {
        return {
            current_question_number: 1,
            test_time: 3600,
            test: this.cloneObj(this.test_data),
            timer: null,
            // course_id: this.$router.params.course_id ? this.$route.params.course_id : 1
            course_id: 1
        }
    },
    methods: {
        cloneObj(obj) {
            return  JSON.parse(JSON.stringify(obj));
        },
        prev() {
            if (this.current_question_number > 1) {
                this.current_question_number--
            }
        },
        next() {
            if (this.current_question_number < this.test.user_answers.length) {
                this.current_question_number++
            }
        },
        selectAnswer(index, answer_number) {
            this.test.user_answers[index].answer_number = answer_number
            this.test.user_answers.push()
        },
        setCurrentQuestionNumber(question_number) {
            this.current_question_number = question_number
            this.test.user_answers.push()
        },
        saveFinishTest() {
            let data = {
                'user_answers': this.test.user_answers
            }
            axios.post(`/courses/${this.test.course.id}/test/${this.test.uuid}/finish`, data).then(res => {
                let data = res.data;
                // if (data)
                console.log('data.success', data.success)
                if (data.data.success) {
                    clearInterval(this.timer)
                    let base_url = process.env.NODE_ENV === 'development' ? process.env.MIX_APP_LOCAL_URL : process.env.MIX_APP_URL

                    location.href = `${base_url}courses/${this.test.course_id}/test/${this.test.uuid}/result`
                    // location.replace(`${base_url}courses/${this.test.course_id}/test/${this.test.uuid}/result`)
                } else {
                    location.href = data.data.route_result
                }
                console.log('res', res)
            }).catch(err => {
                console.log('err', err)
            })
        },
        startTimer() {
            this.timer = setInterval(() => {
                if (this.test_time > 1) {
                    this.test_time = this.test_time - 1;
                    var hours = Math.floor(this.test_time /3600)
                    var minu = this.test_time % 3600;
                    var minut = minu / 60;
                    var minute = parseInt(minut);
                    var second = this.test_time % 60;
                    var m0 = '';
                    var s0 = '';
                    if (minute < 10) {
                        m0 = '0';
                    }
                    if (second < 10) {
                        s0 = '0';
                    }

                    this.$refs.time.innerHTML = (hours ? hours + ':' : '') + m0 + minute + ':' + s0 + second
                }else {
                    clearInterval(this.timer)
                    this.$refs.time.innerHTML = '00:00'
                    this.saveFinishTest()
                    // this.$swalWarning('Уақытыңыз бітті')
                }
            }, 1000)
        },
    },
    mounted() {
        this.startTimer()
    }
}
</script>

<style scoped>

</style>
