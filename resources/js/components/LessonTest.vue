<template>
    <div class="testing">
        <div class="testing-body">
<!--            <div class="timer">-->
                <div class="title">
                    <p>
                    {{ text_title ? text_title : 'Сіз тест тапсырудасыз' }}
                    </p>
                </div>
<!--            </div>-->

            <div class="course-questions-block">
                <div class="questions-block-left">
                    <div class="questions">
                        <div class="questions-item" v-show="current_question_number === (index +1)"
                             v-for="(user_answer,index) in test.user_answers">
                            <div class="question-text">
                                {{ index + 1 }}.&nbsp;
                                <div v-html="user_answer.question.text"/>
                            </div>
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
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.0901 4.07998L8.57009 10.6C7.80009 11.37 7.80009 12.63 8.57009 13.4L15.0901 19.92" stroke="#35263D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>

                        <div class="center">
                            <span id="current_question_number">{{ current_question_number }}</span>/
                            {{ test.user_answers.length }}
                        </div>
                        <div class="right" @click.prevent="next()" :class="{'prev-next-btn-disabled': current_question_number >= test.user_answers.length}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.91016 19.92L15.4302 13.4C16.2002 12.63 16.2002 11.37 15.4302 10.6L8.91016 4.08002" stroke="#35263D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="questions-block-right">
                    <div class="title">
                        {{ text_right_title ? text_right_title : 'Сұрақтар тізімі' }}
                    </div>
                    <div class="answer-numbers">
                        <div class="answer-number"
                             @click.prevent="setCurrentQuestionNumber(index+1)"
                             :class="{'answered' : current_question_number === index+1 || user_answer.answer_number }"
                             v-for="(user_answer, index) in test.user_answers">{{ index + 1 }}
                        </div>
                    </div>
                    <button class="btn default-btn" @click.prevent="saveFinishTest">
                        {{ text_right_button ? text_right_button : 'Тестті аяқтау' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "LessonTest",
    props: [
        'test_data', 'text_title', 'text_right_title', 'text_right_button'
    ],
    data() {
        return {
            current_question_number: 1,
            test: this.cloneObj(this.test_data),
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


            let base_url = process.env.NODE_ENV == 'production' ? process.env.MIX_APP_URL :  process.env.MIX_APP_LOCAL_URL 
            // axios.baseURL = base_url;

            console.log('base', base_url, process.env.NODE_ENV)
            // axios.post(`/${this.test.uuid}/finish`, data).then(res => {
            axios.post(`/courses/${this.test.lesson.course_id}/lessons/${this.test.lesson.id}/test/${this.test.uuid}/finish`, data, { baseUrl: base_url}).then(res => {
            // axios.post(`/courses/${this.test.lesson.module.course_id}/test/${this.test.uuid}/finish`, data).then(res => {
                let data = res.data;
                // if (data)
                console.log('data.success', data.success)
                console.log('process.env.NODE_ENV', process.env.NODE_ENV)
                console.log('process.env.NODE_ENV', process.env.NODE_ENV)
                if (data.data.success) {
                    location.href = `${base_url}courses/${this.test.lesson.module.course_id}/lessons/${this.test.lesson.id}/test/${this.test.uuid}/result`
                    // location.replace(`${base_url}courses/${this.test.course_id}/test/${this.test.uuid}/result`)
                } else {
                    location.href = data.data.route_result
                }
                console.log('res', res)
            }).catch(err => {
                console.log('err', err)
            })
        },
    },
}
</script>

<style scoped>

</style>
